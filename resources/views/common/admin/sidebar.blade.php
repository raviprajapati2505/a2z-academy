<div class="sidebar sidebarmainsetcov">
    <div class="logo-details">
        <a href="Javascript:void(0);">
            <img src="{{ asset('public/images/logo.png') }}" alt="logo icon" class="mainlogo">
            <img src="{{ asset('public/images/logo.png') }}" alt="logo" class="mainlogo-icon">
        </a>
        <!-- <span class="logo_name"></span> -->
    </div>
    <ul class="nav-links">
        <li class="searchboxsetcover">
            <!-- <div class="search-box">
                <input type="text" placeholder="Search Here">
                <i class="bx bx-search"></i>
            </div> -->
        </li>
        @if (@auth()->user()->isTeacher())
        <li>
            <a href="{{ URL('teacher/home') }}" class="{{ (request()->segment(2) == 'home') ? 'active' : '' }}">
                <img src="{{ asset('public/svg/dashboard-icon.svg') }}" alt="Dashboard">
                <span class="links_name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ URL('teacher/live_classes') }}" class="{{ (request()->segment(2) == 'live_classes') ? 'active' : '' }}">
                <img src="{{ asset('public/svg/purchase-videos-icon.svg') }}" alt="Live Classes">
                <span class="links_name">Live Class</span>
            </a>
        </li>
        <!-- <li>
            <a href="{{ URL('teacher/manage_classes') }}" class="{{ (request()->segment(2) == 'manage_classes') ? 'active' : '' }}">
                <img src="{{ asset('public/svg/my-classes-icon.svg') }}" alt="Manage Classes">
                <span class="links_name">Manage Classes</span>
            </a>
        </li> -->
        <li>
            <a href="{{ URL('teacher/events') }}" class="{{ (request()->segment(2) == 'events') ? 'active' : '' }}">
                <img src="{{ asset('public/svg/calendar-icon.svg') }}" alt="Calendar">
                <span class="links_name">Calendar</span>
            </a>
        </li>
        <!-- <li>
            <a href="{{ URL('teacher/grades') }}" class="{{ (request()->segment(2) == 'grades') ? 'active' : '' }}">
                <img src="{{ asset('public/svg/grades-icon.svg') }}" alt="Learner Grades">
                <span class="links_name">Learner Grades</span>
            </a>
        </li>
        <li>
            <a href="{{ URL('teacher/assessments') }}" class="{{ (request()->segment(2) == 'assessments') ? 'active' : '' }}">
                <img src="{{ asset('public/svg/teaching-evaluation-icon.svg') }}" alt="Learner Assessment">
                <span class="links_name">Learner Assessment</span>
            </a>
        </li> -->
        <li>
            <a href="{{ URL('teacher/profiles') }}" class="{{ (request()->segment(2) == 'profiles') ? 'active' : '' }}">
                <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Profile">
                <span class="links_name">Profile</span>
            </a>
        </li>
        <li>
            <a href="{{ URL('teacher/notes') }}" class="{{ (request()->segment(2) == 'notes') ? 'active' : '' }}">
                <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Notes">
                <span class="links_name">Note</span>
            </a>
        </li>
        @else
            @if (@auth()->user()->isCredentials())
            <li>
                <a href="{{ URL('admin/manage_course') }}" class="{{ (request()->segment(2) == 'manage_course') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/my-courses-icon.svg') }}" alt="My Classes">
                    <span class="links_name">Manage Courses</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/course_type') }}" class="{{ (request()->segment(2) == 'course_type') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Category">
                    <span class="links_name">Category</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/subject') }}" class="{{ (request()->segment(2) == 'subject') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Sub-Category">
                    <span class="links_name">Sub Category</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/child_category') }}" class="{{ (request()->segment(2) == 'child_category') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Sub-Category">
                    <span class="links_name">Sub-subcategory</span>
                </a>
            </li>
            @else
            <li>
                <a href="{{ URL('admin/admin_dashboard') }}" class="{{ (request()->segment(2) == 'admin_dashboard') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/dashboard-icon.svg') }}" alt="My Classes">
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/manage_course') }}" class="{{ (request()->segment(2) == 'manage_course') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/my-courses-icon.svg') }}" alt="My Classes">
                    <span class="links_name">Manage Courses</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/manage_admin') }}" class="{{ (request()->segment(2) == 'manage_admin') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/dashboard-icon.svg') }}" alt="My Classes">
                    <span class="links_name">Manage Users</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/manage_class') }}" class="{{ (request()->segment(2) == 'manage_class') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/my-classes-icon.svg') }}" alt="Manage Live Class">
                    <span class="links_name">Manage Live Class</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/manage_teacher') }}" class="{{ (request()->segment(2) == 'manage_teacher') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Manage Instructor">
                    <span class="links_name">Manage Instructor</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/manage_student') }}" class="{{ (request()->segment(2) == 'manage_student') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Manage Learner">
                    <span class="links_name">Manage Learner</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/event') }}" class="{{ (request()->segment(2) == 'event') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/calendar-icon.svg') }}" alt="Calendar">
                    <span class="links_name">Calendar</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ URL('admin/grade') }}" class="{{ (request()->segment(2) == 'grade') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/grades-icon.svg') }}" alt="Learner Grades">
                    <span class="links_name">Learner Grades</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/assessment') }}" class="{{ (request()->segment(2) == 'assessment') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/teaching-evaluation-icon.svg') }}" alt="Learner Assessment">
                    <span class="links_name">Learner Assessments</span>
                </a>
            </li> -->
            <li>
                <a href="{{ URL('admin/profile') }}" class="{{ (request()->segment(2) == 'profile') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Profile">
                    <span class="links_name">Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/book_store') }}" class="{{ (request()->segment(2) == 'book_store') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Book Store">
                    <span class="links_name">Resources</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/news') }}" class="{{ (request()->segment(2) == 'news') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="News">
                    <span class="links_name">Manage News</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ URL('admin/class_list') }}" class="{{ (request()->segment(2) == 'class_list') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Class List">
                    <span class="links_name">Class List</span>
                </a>
            </li> -->
            <li>
                <a href="{{ URL('admin/page') }}" class="{{ (request()->segment(2) == 'page') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Pages">
                    <span class="links_name">Page</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/promocode') }}" class="{{ (request()->segment(2) == 'promocode') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Promo Code">
                    <span class="links_name">Promo Code</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ URL('admin/report/certificate_report') }}" class="{{ (request()->segment(3) == 'certificate_report') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Promo Code">
                    <span class="links_name">Certification report</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('admin/report/total_enrollment_report') }}" class="{{ (request()->segment(3) == 'total_enrollment_report') ? 'active' : '' }}">
                    <img src="{{ asset('public/svg/profile-icon.svg') }}" alt="Promo Code">
                    <span class="links_name">Enrollment Report</span>
                </a>
            </li>

        @endif
    </ul>
</div>