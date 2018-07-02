<ul class="nav" id="slibar-menu">
    <li>
        <a href="{{route('admin.dashboard')}}" >
            <i class="ti-panel"></i>
            <p>Bảng điều khiển
            </p>
        </a>
		<!--<div class="collapse" id="dashboardOverview">
			<ul class="nav">
				<li>
					<a href="../dashboard/overview.html">
						<span class="sidebar-mini">O</span>
						<span class="sidebar-normal">Trang chính</span>
					</a>
				</li>
				<li>
					<a href="../dashboard/stats.html">
						<span class="sidebar-mini">S</span>
						<span class="sidebar-normal">Stats</span>
					</a>
				</li>
			</ul>
		</div>-->
    </li>
    @can('user-control')
	<li>
		<a data-toggle="collapse" href="#users-viewer" >
			<i class="ti-user"></i>
			<p>Người dùng
			   <b class="caret"></b>
			</p>
		</a>
		<div class="collapse" id="users-viewer">
			<ul class="nav">
				<li>
					<a href="{{ route('admin.user.create') }}">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Tạo tải khoản</span>
					</a>
				</li>
                <li>
					<a href="{{ route('admin.user.index') }}">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Danh sách tài khoản</span>
					</a>
				</li>
				<li>
					<a href="{{ route('admin.role.index') }}">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Nhóm quyền</span>
					</a>
				</li>
            </ul>
		</div>
	</li>
	@endcan
	@can('report-control')
	<li>
		<a data-toggle="collapse" href="#report-viewer" >
			<i class="ti-package"></i>
			<p>Báo cáo
			   <b class="caret"></b>
			</p>
		</a>
		<div class="collapse" id="report-viewer">
			<ul class="nav">
				<li>
					<a href="{{ route('admin.rtype.index') }}">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Loại báo cáo</span>
					</a>
				</li>
                <li>
					<a href="{{ route('admin.report.index') }}">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Danh sách báo cáo</span>
					</a>
				</li>
            </ul>
		</div>
	</li>
	@endcan
	@can('clinic-control')
	<li>
		<a data-toggle="collapse" href="#clinic-viewer" >
			<i class="ti-wheelchair"></i>
			<p>Phòng khám
			   <b class="caret"></b>
			</p>
		</a>
		<div class="collapse" id="clinic-viewer">
			<ul class="nav">
				<li>
					<a href="#">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Danh sách chuyên khoa</span>
					</a>
				</li>
				<li>
					<a href="{{ route('admin.clinic.create') }}">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Tạo phòng khám</span>
					</a>
				</li>
                <li>
					<a href="{{ route('admin.clinic.index') }}">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Quản lý phòng khám</span>
					</a>
				</li>
            </ul>
		</div>
	</li>
	@endcan
</ul>
