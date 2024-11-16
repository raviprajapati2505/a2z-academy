<?php
namespace App\Http\Controllers\Teacher;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use Session;
use Storage;
use App\Models\User;
use Auth;
use App\Http\Traits\UserTrait;
class DashboardController extends Controller
{
    use UserTrait;

    public function index()
    { 
        $dashboardDetails = array();
        
        $dashboardDetails['classes'][0]['image'] = asset('public/images/today-classes-img1.png');
        $dashboardDetails['classes'][0]['title'] = "Science - Chapter 4";
        $dashboardDetails['classes'][0]['percentage'] = "75";

        $dashboardDetails['classes'][1]['image'] = asset('public/images/today-classes-img2.png');
        $dashboardDetails['classes'][1]['title'] = "Biology - Unit 7";
        $dashboardDetails['classes'][1]['percentage'] = "50";

        $dashboardDetails['classes'][2]['image'] = asset('public/images/today-classes-img3.png');
        $dashboardDetails['classes'][2]['title'] = "Chemistry- Unit 3";
        $dashboardDetails['classes'][2]['percentage'] = "60";

        $dashboardDetails['classes'][3]['image'] = asset('public/images/today-classes-img4.png');
        $dashboardDetails['classes'][3]['title'] = "Physics- Unit 5";
        $dashboardDetails['classes'][3]['percentage'] = "30";

        $dashboardDetails['time_spent']['total'] = "";
        $dashboardDetails['time_spent']['items'][0]['title'] = "Chemistry - 45 Mins";
        $dashboardDetails['time_spent']['items'][0]['color'] = "#feca43";

        $dashboardDetails['time_spent']['items'][1]['title'] = "Biology - 2 hr 30 min";
        $dashboardDetails['time_spent']['items'][1]['color'] = "#3a84c8";

        $dashboardDetails['time_spent']['items'][2]['title'] = "Physics - 30 Mins";
        $dashboardDetails['time_spent']['items'][2]['color'] = "#ea3b69";

        $dashboardDetails['time_spent']['items'][3]['title'] = "Other - 2 hr";
        $dashboardDetails['time_spent']['items'][3]['color'] = "#6e2ee5";

        $currentUser = $this->currentUser();
        
        $userEvents = $this->userEvents();
        $userVideoCourses = $this->userVideoCourses($currentUser['id']);

        return view('teacher.dashboard.index', compact('dashboardDetails','currentUser','userEvents','userVideoCourses'));
    }
}