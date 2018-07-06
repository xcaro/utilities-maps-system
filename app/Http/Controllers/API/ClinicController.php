<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Clinic as ClinicResource;
use App\Http\Resources\ClinicCollection;
use App\Clinic;
use App\Doctor;
use App\Setting;
use r;
use Illuminate\Support\Carbon;
class ClinicController extends Controller
{
    private $expire;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
        $this->expire = Setting::where('key', 'default_clinic_expire')->first()->value;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lấy tất cả
        $result = Clinic::where([
            ['active', '=', true],
            ['confirmed', '=', true],
        ]);
        // Nếu có loại, lọc theo loại
        if (request('type')) {
            $result->where('type', request('type'));
        }
        if (request('district_id')) {
            $result->where('district_id', request('district_id'));
        }
        else if (request('ward_id')) {
            $result->where('ward_id', request('ward_id'));
        }
        if (request('name')) {
            $result->where('name', 'like', '%'.request('name').'%');
        }
        // trả về
        return new ClinicCollection($result->get());
    }

    /**
     * Store a newly created apiource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        
        $district = \App\District::where('name', $request->district)->first();
        $ward = \App\Ward::where('name', $request->ward)->first();
        DB::beginTransaction();

        $item = new Clinic;
        $item->name = $request->name;
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->address = $request->address;
        $item->type = $request->type;
        $item->user_created = auth('api')->user()->id;
        $item->description = $request->description;
        $item->end_date = Carbon::now()->addDay($this->expire);
        $item->district_id = $district->id;
        $item->ward_id = $ward->id;

        if($item->save()){
            $item = Clinic::find($item->id);
            foreach ($request->doctors as $rel) {
                $doctor = new Doctor;
                $doctor->name = $rel['name'];
                $doctor->description = $rel['description'];
                $doctor->title = $rel['title'];
                if ($item->doctors()->save($doctor)) {
                    if ($rel['image'] != null) {
                        $file = $rel['image'];
                        $ext = $file->getClientOriginalExtension();
                        $name = $doctor->id . '.' . $ext;
                        $file->move(public_path('upload/doctors'), $name);
                        Doctor::where('id', $doctor->id)->update(['image' => $name]);
                    }
                }
            }
            DB::commit();

            // add new clinic to rethink
            $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
            $r_result = r\db(env('R_DATABASE'))->table('activeClinics')
                ->insert($item->toArray())
                ->run($r_connect);
            $r_connect->close();

            return response()->json([
                'message' => 'Created successful',
                'data' => new ClinicResource($item),
            ], 201);
        }
        DB::rollBack();
        return response()->json([
            'message' => 'Data can not be processed',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClinicResource(Clinic::findOrFail($id));
    }

    /** Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Clinic::find($id);

        $this->authorize($item, 'update');

        DB::beginTransaction();
        $item->name = $request->name;
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->address = $request->address;
        $item->type = $request->type;
        //$item->confirmed = $request->confirmed;
        $item->description = $request->description;
        
        if($item->save()){
            if ($request->doctors) {
                foreach ($request->doctors as $rel) {
                    $doctor = Doctor::find($rel['id']);
                    $doctor->name = $rel['name'];
                    $doctor->description = $rel['description'];
                    $doctor->title = $rel['title'];
                    if ($rel['image'] != null) {
                        $file = $rel['image'];
                        $ext = $file->getClientOriginalExtension();
                        $name = $doctor->id . '.' . $ext;
                        $file->move(public_path('upload/doctors'), $name);
                        $doctor->image = $image;
                    }
                    $doctor->save();
                }
            }
            
            DB::commit();

            $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
            $r_result = r\db(env('R_DATABASE'))->table('activeClinics')
                ->get((int)$id)->update($item->toArray())
                ->run($r_connect);
            $r_connect->close();

            return response()->json([
                'message' => 'Updated successful',
                'data' => new ClinicResource($item),
            ], 201);
        }
        DB::rollBack();

        return response()->json([
            'message' => 'Data can not be processed',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeClinics')->get((int)$id)->delete()->run($r_connect);
        $r_connect->close();

        $item = Clinic::find($id);
        $item->active = false;
        $item->save();
        return response()->json(null, 204);
    }
    public function myClinic()
    {
        $user = auth('api')->user();
        $clinics = Clinic::where('user_created', $user->id)->get();
        return new ClinicCollection($clinics);
    }
    public function filterByDate($id)
    {
        if (!request('date')) {
            return response()->json([
                'message' => 'Missing parameters \'date\'',
            ], 200);
        }
        $date = request('date');
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $date->hour = 0;
        $date->minute = 0;
        $date->second = 0;
        //$date->timestamp = 0;
        // return $date;
        $result = \App\ClinicShift::whereDate('start_shift', $date)->where('active', true);
        return $result->get();
        return new \App\Http\Resources\ClinicShiftCollection($result->get());
    }
}
