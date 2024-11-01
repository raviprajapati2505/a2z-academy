<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;
use app\Models\Certificate;
use App\Models\StudentCourseHistory;
use App\Models\TrackLecture;
use Illuminate\Support\Facades\Hash;

class CertificateController extends Controller
{
    public function index()
    {
      $track_lecture = TrackLecture::where('student_id', Auth::user()->id)->get();
      $purchased_course = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->where('student_course_history.student_id', Auth::user()->id)
            ->where('student_course_history.is_paid', '1')
            ->get();
        return view('frontend.certificate.index',compact('purchased_course','track_lecture'));
    }

    public function download_certificate(Request $request)
    {
        // create Image from file
        $img = Image::make('public/frontend/images/certificates-img1.png');

        $image = $request->file('file');
        //$input['file'] = time().'.'.$image->getClientOriginalExtension();

        $imgFile = Image::make($image->getRealPath());
        $image_profile = $imgFile->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        });

        // use callback to define details
        $img->text($request->name, 420, 280, function ($font) {
            $font->file(realpath('public/fonts/Gilroy-Bold.ttf'));
            $font->size(45);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        $img->insert($image_profile, 'top-left', 90, 150);
        $img->save('public/certificate-new.jpg');
        $filename = Auth::user()->name . '-certificate.png';
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename=' . $filename,
        ];
        $data = [
            'file' => $filename,
            'year' => $request->year ?? '',
            'qualification' => $request->qualification ?? '',
            'organization' => $request->organization ?? '',
            'name' => $request->name ?? '',
        ];
        if ($request->admin_id && empty($request->password)) {
            unset($data['password']);
        }
        Certificate::updateOrCreate(
            [
                'student_id' => Auth::user()->id,
                'course_id' => $request->course_id
            ],
            $data
        );
        return response()->stream(function () use ($img) {
            echo $img;
        }, 200, $headers);
    }
}
