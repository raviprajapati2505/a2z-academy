<?php

namespace App\Http\Traits;
use App\Models\User;
use Auth;

trait UserTrait {
    public function currentUser() {
        // Fetch all the students from the 'student' table.
        $user = Auth::User()->toArray();
        $user['current_grade'] = "Student Grade-8";
        $user['image'] = asset('public/images/user-icon.png');
        $user['userActivities'] = $this->userActivities($user['id']);
        $user['userVideoCourses'] = $this->userVideoCourses($user['id']);
        return $user;
    }
    public function userActivities($userId) {
        // Fetch all the students from the 'student' table.
        $activities = array();
        $activities[0]['image'] = asset('public/images/science-icon.png');
        $activities[0]['title'] = 'Science - Chapter 4';
        $activities[0]['url'] = '';
        $activities[1]['image'] = asset('public/images/chemistry-icon.png');
        $activities[1]['title'] = 'Chemistry- Unit 3';
        $activities[1]['url'] = '';
        $activities[2]['image'] = asset('public/images/biology-icon.png');
        $activities[2]['title'] = 'Biology - Chapter 7';
        $activities[2]['url'] = '';
        return $activities;
    }
    public function userVideoCourses($userId) {
        // Fetch all the students from the 'student' table.
        $courses = array();
        $courses[0]['image'] = asset('public/images/profile-user-icon.png');
        $courses[0]['title'] = 'Science Subjects';
        $courses[0]['author'] = 'Sirena Robertson';
        $courses[0]['rating'] = '4';
        $courses[0]['is_live'] = true;
        $courses[0]['url'] = '';
        
        return $courses;
    }
}