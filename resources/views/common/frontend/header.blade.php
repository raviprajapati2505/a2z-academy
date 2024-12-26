<header class="mainhedpartsetcovdata <?php if (!empty(request()->segment(1))) { ?>allcominer-pages<?php } ?>">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="cover-namenulogonav">
                <div class="left-navmenulogo">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('public/images/logo.png')}}" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse right-hednavmaincov" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- <li class="nav-item dropdown d-menu {{ (request()->segment(1) == 'course_by_class') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Batches<svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <div class="dropdown-menu shadow-sm sm-menu classesnavmainhed" aria-labelledby="dropdown01">
                                <ul class="dropdown-listnav">
                                    @foreach($classes as $class)
                                    <?php
                                    $class_number = explode('-', $class->name);
                                    $class_number = isset($class_number[1]) ? trim($class_number[1]) : 8
                                    ?>
                                    <li>
                                        <a class="dropdown-item classe<?= $class_number ?>" href="{{ url('course_by_class') }}<?= '/' . $class->id ?>">
                                            <p><?= $class_number ?><span></span></p>
                                            <h5>{{ $class->name }}</h5>
                                        </a>
                                    </li>
                                    <hr>
                                    @endforeach

                                </ul>
                            </div>
                        </li> -->
                        <li class="nav-item dropdown d-menu {{ (request()->segment(1) == 'course_by_type') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Course Catalog<svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <div class="dropdown-menu shadow-sm sm-menu classesnavmainhed skilprod-nav1" aria-labelledby="dropdown01">
                                <ul class="dropdown-listnav">
                                    @foreach($course_types as $type)
                                        @if(count($type->course) > 0)
                                            <li>
                                                <a class="dropdown-item" href="{{ url('course_by_type') }}<?= '/' . $type->id ?>">
                                                    <h3>{{ $type->title }}</h3>
                                                </a>
                                            </li>
                                        <hr>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item {{ (request()->segment(1) == 'video_classes') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('video_classes') }}">Live class</a>
                        </li>
                        @foreach($delivery_modes as $mode)
                        <li class="nav-item {{ (request()->segment(1) == $mode->title) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('course_by_type') }}<?= '/' . $mode->id ?>/delivery_mode">{{ $mode->title }}</a>
                        </li>
                        @endforeach
                        <!-- <li class="nav-item dropdown d-menu {{ (request()->segment(1) == 'course_by_type') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delivery Mode<svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <div class="dropdown-menu shadow-sm sm-menu classesnavmainhed skilprod-nav1" aria-labelledby="dropdown01">
                                <ul class="dropdown-listnav">
                                    @foreach($delivery_modes as $type)
                                    <li>
                                        <a class="dropdown-item" href="{{ url('course_by_type') }}<?= '/' . $type->id ?>">
                                            <h3>{{ $type->title }}</h3>
                                        </a>
                                    </li>
                                    <hr>
                                    @endforeach
                                </ul>
                            </div>
                        </li> -->
                        <li class="nav-item {{ (request()->segment(1) == 'book_store') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('book_store') }}">Resources</a>
                        </li>
                    </ul>
                    <!-- <form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success" type="submit">Search</button>
						</form> -->
                </div>
                @auth
                <div class="aftloginpagebtn">

                    <a href="javascript:void(0);" class="selector">
                        @if(auth()->user()->photo)
                        <img src="<?= url('/') . '/public/' ?>{{ auth()->user()->photo }}">
                        @else
                        <!-- default image profile -->
                        <img src="{{ asset('public/images/user-icon.png') }}" alt="Allie Grater">
                        @endif
                        <span>{{ Auth::user()->name.' '.Auth::user()->lastname }}</span>
                        <i class='bx bx-chevron-down'></i>
                    </a>
                    &nbsp;&nbsp;
                    <a href="Javascript:void(0);" style="    background: #f7df00;
    color: #251c70;
    font-family: 'Gilroy-Bold';
    display: inline-block;
    width: auto;
    padding: 3px 2px 3px 8px;
    font-size: 16px;
    border-radius: 45px;
    border: 1px solid #f7df00;
    top: 3px;
    position: relative;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-bell notification-icon'></i>
                        {{count($notifications)}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach($notifications as $notify)
                        <li>
                            @if(@empty($notify->event_id))
                            <a href="<?= url('') ?>/readnotification/<?= $notify->nid ?>">Notification: {{ $notify->desc }}</a>
                            @else
                            <a href="<?= url('') ?>/readnotification/<?= $notify->nid ?>">Notification: {{ $notify->description }}</a>
                            @endif

                        </li>
                        @endforeach
                    </ul>
                    <div class="menu-items">
                        <ul>
                            <li>
                                <a href="{{ url('my_account') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/my-accounts-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/my-accounts-icon-active.svg') }}" alt="">
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/my-accounts-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/my-accounts-icon-active.svg') }}" alt="">
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('purchased_courses') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/my-courses-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/my-courses-icon-active.svg') }}" alt="">
                                    <span>Courses</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('events') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/my-aassessment-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/my-aassessment-icon-active.svg') }}" alt="">
                                    <span>Calendar</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="javascript:void(0);">
                                    <img class="activ" src="{{ asset('public/frontend/svg/my-aassessment-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/my-aassessment-icon-active.svg') }}" alt="">
                                    <span>My Assessment</span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="javascript:void(0);">
                                    <img class="activ" src="{{ asset('public/frontend/svg/dashboard-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/dashboard-icon-active.svg') }}" alt="">
                                    <span>Dashboard</span>
                                </a>
                            </li> 
                            <li>
                                <a href="{{ url('certificate') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/certificates-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/certificates-icon-active.svg') }}" alt="">
                                    <span>Certificates</span>
                                </a>
                            </li>-->
                            <li>
                                <a href="{{ url('payment_history') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/payment-history-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/payment-history-icon-active.svg') }}" alt="">
                                    <span>Payment History</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('manage_payment') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/mange-payment-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/mange-payment-icon-active.svg') }}" alt="">
                                    <span>Mange Payment</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('change_password') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/change-password-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/change-password-icon-active.svg') }}" alt="">
                                    <span>Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('logout') }}">
                                    <img class="activ" src="{{ asset('public/frontend/svg/log-out-icon.svg') }}" alt="">
                                    <img class="activno" src="{{ asset('public/frontend/svg/log-out-icon-active.svg') }}" alt="">
                                    <span>Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                @endauth
                @guest
                <div class="loginbtn-nav">
                    <a href="{{ url('login') }}">Login</a>
                </div>
                @endguest
            </div>
        </nav>
    </div>
</header>