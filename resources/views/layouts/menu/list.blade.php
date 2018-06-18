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
					<a href="#">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Nhóm quyền</span>
					</a>
				</li>
            </ul>
		</div>
	</li>
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
					<a href="{{ route('admin.reports.index') }}">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Danh sách báo cáo</span>
					</a>
				</li>
            </ul>
		</div>
	</li>
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
						<span class="sidebar-normal">Tạo phòng khám</span>
					</a>
				</li>
                <li>
					<a href="#">
						<span class="sidebar-mini">+</span>
						<span class="sidebar-normal">Quản lý phòng khám</span>
					</a>
				</li>
            </ul>
		</div>
	</li>
	<!--</li>
	<li>
		<a data-toggle="collapse" href="#formsExamples">
            <i class="ti-clipboard"></i>
            <p>
				Forms
               <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="formsExamples">
			<ul class="nav">
				<li>
					<a href="../forms/regular.html">
						<span class="sidebar-mini">Rf</span>
						<span class="sidebar-normal">Regular Forms</span>
					</a>
				</li>
				<li>
					<a href="../forms/extended.html">
						<span class="sidebar-mini">Ef</span>
						<span class="sidebar-normal">Extended Forms</span>
					</a>
				</li>
				<li>
					<a href="../forms/validation.html">
						<span class="sidebar-mini">Vf</span>
						<span class="sidebar-normal">Validation Forms</span>
					</a>
				</li>
                <li>
					<a href="../forms/wizard.html">
						<span class="sidebar-mini">W</span>
						<span class="sidebar-normal">Wizard</span>
					</a>
				</li>
            </ul>
        </div>
    </li>
    <li>
		<a data-toggle="collapse" href="#tablesExamples">
            <i class="ti-view-list-alt"></i>
            <p>
				Table list
               <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="tablesExamples">
			<ul class="nav">
				<li>
					<a href="../tables/regular.html">
						<span class="sidebar-mini">RT</span>
						<span class="sidebar-normal">Regular Tables</span>
					</a>
				</li>
				<li>
					<a href="../tables/extended.html">
						<span class="sidebar-mini">ET</span>
						<span class="sidebar-normal">Extended Tables</span>
					</a>
				</li>
				<li>
					<a href="../tables/bootstrap-table.html">
						<span class="sidebar-mini">BT</span>
						<span class="sidebar-normal">Bootstrap Table</span>
					</a>
				</li>
				<li>
					<a href="../tables/datatables.net.html">
						<span class="sidebar-mini">DT</span>
						<span class="sidebar-normal">DataTables.net</span>
					</a>
				</li>
            </ul>
        </div>
    </li>
	<li>
		<a data-toggle="collapse" href="#mapsExamples">
            <i class="ti-map"></i>
            <p>
				Maps
               <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="mapsExamples">
			<ul class="nav">
				<li>
					<a href="../maps/google.html">
						<span class="sidebar-mini">GM</span>
						<span class="sidebar-normal">Google Maps</span>
					</a>
				</li>
				<li>
					<a href="../maps/vector.html">
						<span class="sidebar-mini">VM</span>
						<span class="sidebar-normal">Vector maps</span>
					</a>
				</li>
				<li>
					<a href="../maps/fullscreen.html">
						<span class="sidebar-mini">FSM</span>
						<span class="sidebar-normal">Full Screen Map</span>
					</a>
				</li>
            </ul>
        </div>
    </li>
	<li>
        <a href="../charts.html">
            <i class="ti-bar-chart-alt"></i>
            <p>Charts</p>
        </a>
    </li>
	<li>
        <a href="../calendar.html">
            <i class="ti-calendar"></i>
            <p>Calendar</p>
        </a>
    </li>
	<li>
		<a data-toggle="collapse" href="#pagesExamples">
            <i class="ti-gift"></i>
            <p>
				Pages
               <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="pagesExamples">
			<ul class="nav">
				<li>
					<a href="../pages/timeline.html">
						<span class="sidebar-mini">TP</span>
						<span class="sidebar-normal">Timeline Page</span>
					</a>
				</li>
				<li>
					<a href="../pages/user.html">
						<span class="sidebar-mini">UP</span>
						<span class="sidebar-normal">User Page</span>
					</a>
				</li>
				<li>
					<a href="../pages/login.html">
						<span class="sidebar-mini">LP</span>
						<span class="sidebar-normal">Login Page</span>
					</a>
				</li>
				<li>
					<a href="../pages/register.html">
						<span class="sidebar-mini">RP</span>
						<span class="sidebar-normal">Register Page</span>
					</a>
				</li>
				<li>
					<a href="../pages/lock.html">
						<span class="sidebar-mini">LSP</span>
						<span class="sidebar-normal">Lock Screen Page</span>
					</a>
				</li>
            </ul>
        </div>
    </li>-->
</ul>
