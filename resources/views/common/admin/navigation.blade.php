<nav class="comnav_alldatacov">
    <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <!-- <span class="dashboard">Dashboard</span> -->
    </div>

    <div class="serclognotif-cover">
        <div class="serclognotif-iner">
            <!-- <div class="search-box">
						<input type="text" placeholder="Search Here">
						<i class='bx bx-search' ></i>
					</div> -->
            <div class="notifdata_cover">
                <!-- <a href="Javascript:void(0);">
							<span>0</span>
							<img src="{{ asset('public/svg/notification-icon.svg') }}" alt="Notification">
						</a> -->
                <div class="dropdown">
                    <a href="Javascript:void(0);" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{count($notifications)}}</span>
                        <img src="{{ asset('public/svg/notification-icon.svg') }}" alt="Notification">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach($notifications as $notify)
                        <li><a href="<?= url('') ?>/readnotification/<?= $notify->nid ?>">Notification: {{ $notify->description }}</a></li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="logoutbtn-cover">
                <a href="{{ url('logout') }}">
                    <img src="{{ asset('public/images/logout-icon.png') }}" alt="Logout">
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>


</nav>