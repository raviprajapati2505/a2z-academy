@extends('layouts.app_front')

@section('content')
<div class="container videosclassesmain-covpg">
    <div class="classall-datacover">

        <div class="classalldatitand-cls">
            <div class="classalldata-title">
                <!-- <p>Skill</p> -->
                <h3>My Video</h3>
            </div>
            <div class="classalldata-topiner">
                <!-- <h6>Class Change</h6>
                <div class="iSelect fixedWidth rounded rectcourrecenew1">
                    <label for="chk">
                        <input aria-hidden="true" id="chk" type="checkbox">
                        <span class="select-label" title="Select the model">Recent Class</span>
                        <ul role="listbox">
                            <div class="classalllist-heightset">
                                <li role="option">
                                    <h3>Popular Class</h3>
                                </li>
                                <hr>
                                <li role="option">
                                    <h3>Recent Class</h3>
                                </li>
                                <hr>
                                <li role="option">
                                    <h3>Featured Class</h3>
                                </li>
                            </div>
                        </ul>
                    </label>
                </div> -->
            </div>
        </div>

        <div class="classalldata-inerbox">
            <div class="row">
                @if(count($video_classes) > 0)
                @foreach($video_classes as $class)
                <div class="classalldata-box3">
                    <div class="coursesdata-cover">
                        <div class="coursesdata-iner">
                            <?php
                            $url = $class->newness_class->zoom_join_url;
                            $meeting_credentials = explode('?', $url);
                            $mn = str_replace('https://us05web.zoom.us/j/', '', $meeting_credentials[0]);
                            $password = str_replace('pwd=', '', $meeting_credentials[1]);
                            ?>
                            <?php
                            $current_hour = date('H');
                            $time_from = $class->newness_class->time_from;
                            $time_to = $class->newness_class->time_to;
                            $current_date = strtotime(date('Y-m-d'));
                            $class_date = strtotime($class->newness_class->date);

                            if (($current_hour >= $time_from && $current_hour <= $time_to) && $current_date == $class_date) {
                                $classd = 'live-class';
                                $zoom_link = 'join_meeting';
                                $text = 'Live Now';
                            } else if ($class_date < $current_date) {
                                $classd = 'offline-class';
                                $zoom_link = 'completed';
                                $text = 'Meeting Completed';
                            } else {
                                $classd = 'offline-class';
                                $zoom_link = 'not_started';
                                $text = 'Live at ' . $class->time_from . ':00';
                            }
                            ?>
                            <a href="<?php echo $password ?>" target="_blank">
                            <!-- <a href="javascript:void(0);" class="{{ $zoom_link }}" data-mn="{{ $mn }}" data-pwd="{{ $password }}" data-display_name="{{ auth()->user()->name }}" data-role="0" data-url="<?= url('/').'/meeting?' ?>"> -->
                                <div class="coursesdata-img">
                                    <div class="retclass">
                                        <h5>3.5 <i class='bx bxs-star'></i></h5>
                                    </div>
                                    @if($class->newness_class->image)
                                    <img src="<?= url('/') . '/public/' . $class->newness_class->image ?>">
                                    @else
                                    <!-- default image class -->
                                    <img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater">
                                    @endif
                                </div>
                                <div class="coursesdata-livetext">
                                    <h3>{{ $class->newness_class->title }}</h3>
                                    <h5>By {{ $class->newness_class->teacher->name }}</h5>
                                    <div class="liveoff-datacov <?= $classd; ?>">
                                        <h6><span class="pulse"></span> {{ $text }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>No classes available</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container videosclassesmain-covpg">
    <div class="classall-datacover">

        <div class="classalldata-title">
            <h3>Recommended Classes for you</h3>
        </div>
        <div class="classalldata-inerbox">
            <div class="row">

                <div class="classalldata-box3">
                    <div class="coursesdata-cover">
                        <a href="javascript:void(0);" class="avtgnamanicov">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    <div class="timeclocbox1">
                                        <p>
                                            <i class="bx bx-time-five"></i>
                                            <span>2 hr</span>
                                        </p>
                                    </div>
                                    <img src="{{ asset('public/frontend/images/skill-img-1.jpg') }}" alt="">
                                </div>
                                <div class="coursesdata-text exttextadd">
                                    <h3>Biology</h3>
                                    <h5>By Amy Smith</h5>
                                    <div class="paydata-coursese">
                                        <h4>$20</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="classalldata-box3">
                    <div class="coursesdata-cover">
                        <a href="javascript:void(0);" class="avtgnamanicov">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    <div class="timeclocbox1">
                                        <p>
                                            <i class="bx bx-time-five"></i>
                                            <span>12 hr</span>
                                        </p>
                                    </div>
                                    <img src="{{ asset('public/frontend/images/skill-img-2.jpg') }}" alt="">
                                </div>
                                <div class="coursesdata-text exttextadd">
                                    <h3>Physical Education</h3>
                                    <h5>By Mrs. A. T. Whitecotton</h5>
                                    <div class="paydata-coursese">
                                        <h4>$50</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="classalldata-box3">
                    <div class="coursesdata-cover">
                        <a href="javascript:void(0);" class="avtgnamanicov">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    <div class="timeclocbox1">
                                        <p>
                                            <i class="bx bx-time-five"></i>
                                            <span>2 hr</span>
                                        </p>
                                    </div>
                                    <img src="{{ asset('public/frontend/images/skill-img-3.jpg') }}" alt="">
                                </div>
                                <div class="coursesdata-text exttextadd">
                                    <h3>Computer Basics</h3>
                                    <h5>By Geraldine Carpenter</h5>
                                    <div class="paydata-coursese">
                                        <h4>$30</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="classalldata-box3">
                    <div class="coursesdata-cover">
                        <a href="javascript:void(0);" class="avtgnamanicov">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    <div class="timeclocbox1">
                                        <p>
                                            <i class="bx bx-time-five"></i>
                                            <span>2 hr</span>
                                        </p>
                                    </div>
                                    <img src="{{ asset('public/frontend/images/my-courses-img10.jpg') }}" alt="">
                                </div>
                                <div class="coursesdata-text exttextadd">
                                    <h3>Regional Language(s)</h3>
                                    <h5>By Mary Belle Greenwell</h5>
                                    <div class="paydata-coursese">
                                        <h4>$20</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="classalldata-box3">
                    <div class="coursesdata-cover">
                        <a href="javascript:void(0);" class="avtgnamanicov">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    <div class="timeclocbox1">
                                        <p>
                                            <i class="bx bx-time-five"></i>
                                            <span>12 hr</span>
                                        </p>
                                    </div>
                                    <img src="{{ asset('public/frontend/images/my-courses-img19.jpg') }}" alt="">
                                </div>
                                <div class="coursesdata-text exttextadd">
                                    <h3>Philosophy</h3>
                                    <h5>By Thelma Egbert</h5>
                                    <div class="paydata-coursese">
                                        <h4>$50</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="classalldata-box3">
                    <div class="coursesdata-cover">
                        <a href="javascript:void(0);" class="avtgnamanicov">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    <div class="timeclocbox1">
                                        <p>
                                            <i class="bx bx-time-five"></i>
                                            <span>12 hr</span>
                                        </p>
                                    </div>
                                    <img src="{{ asset('public/frontend/images/my-courses-img20.jpg') }}" alt="">
                                </div>
                                <div class="coursesdata-text exttextadd">
                                    <h3>Earth Sciences</h3>
                                    <h5>By Elma Kemp</h5>
                                    <div class="paydata-coursese">
                                        <h4>$30</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form class="navbar-form navbar-right" id="meeting_form" style="display:none">
    <div class="form-group">
        <input type="text" name="display_name" id="display_name" maxLength="100" placeholder="Name" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="meeting_number" id="meeting_number" value="96119393023" maxLength="200" style="width:150px" placeholder="Meeting Number" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="meeting_pwd" id="meeting_pwd" value="" style="width:150px" maxLength="32" placeholder="Meeting Password" class="form-control">
    </div>
    <div class="form-group">
        <input type="text" name="meeting_email" id="meeting_email" value="" style="width:150px" maxLength="32" placeholder="Email option" class="form-control">
    </div>

    <div class="form-group">
        <select id="meeting_role" class="sdk-select">
            <option value=0>Attendee</option>
            <option value=1>Host</option>
            <option value=5>Assistant</option>
        </select>
    </div>
    <div class="form-group">
        <select id="meeting_china" class="sdk-select">
            <option value=0>Global</option>
            <option value=1>China</option>
        </select>
    </div>
    <div class="form-group">
        <select id="demoType" class="sdk-select">
            <option value='cdn'>CDN</option>
            <option value='local'>Local</option>
        </select>
    </div>
    <div class="form-group">
        <select id="meeting_lang" class="sdk-select">
            <option value="en-US">English</option>
            <option value="de-DE">German Deutsch</option>
            <option value="es-ES">Spanish Español</option>
            <option value="fr-FR">French Français</option>
            <option value="jp-JP">Japanese 日本語</option>
            <option value="pt-PT">Portuguese Portuguese</option>
            <option value="ru-RU">Russian Русский</option>
            <option value="zh-CN">Chinese 简体中文</option>
            <option value="zh-TW">Chinese 繁体中文</option>
            <option value="ko-KO">Korean 한국어</option>
            <option value="vi-VN">Vietnamese Tiếng Việt</option>
            <option value="it-IT">Italian italiano</option>
        </select>
    </div>

    <input type="hidden" value="" id="copy_link_value" />
    <button type="submit" class="btn btn-primary" id="clear_all">Clear</button>
    <button type="button" link="" onclick="window.copyJoinLink('#copy_join_link')" class="btn btn-primary" id="copy_join_link">Copy Direct join link</button>
</form>
@include('common.zoom.required_js')
<script src="{{ asset('public/js/additional/zoom/nav.js') }}"></script>
@endsection