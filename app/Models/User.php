<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Exception;
use App\Mail\SendCodeMail;
use App\Models\UserCode;
use SmsApi;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use SoftDeletes;

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'lastname',
        'phone',
        'name',
        'email',
        'password',
        'status',
        'class_id',
        'subject_id',
        'role',
        'photo',
        'education',
        'language',
        'gender',
        'dob',
        'availability',
        'years_experience',
        'designation',
        'present_address',
        'aboutme',
        'permananat_address',
        'country_code',
        'external_id',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassList::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function newnessclass(): HasMany
    {
        return $this->hasMany(NewnessClass::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function newnessclass_student(): HasMany
    {
        return $this->hasMany(NewnessClassStudent::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_grade(): HasMany
    {
        return $this->hasMany(StudentGrade::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_assessment(): HasMany
    {
        return $this->hasMany(StudentAssessment::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_course_history(): HasMany
    {
        return $this->hasMany(StudentCourseHistory::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function curriculam_lecture(): HasMany
    {
        return $this->hasMany(CurriculamLecture::class, 'teacher_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_review(): HasMany
    {
        return $this->hasMany(StudentReview::class, 'student_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_favourite(): HasMany
    {
        return $this->hasMany(StudentFavourite::class, 'student_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function track_lecture(): HasMany
    {
        return $this->hasMany(TrackLecture::class, 'student_id');
    }

        /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function course_material(): HasMany
    {
        return $this->hasMany(CourseMaterial::class, 'student_id');
    }

        /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function certificate(): HasMany
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }

    public function isAdmin()
    {
        return $this->role == 'Admin' ? true : false;
    }

    public function isTeacher()
    {
        return $this->role == 'Teacher' ? true : false;
    }

    public function isStudent()
    {
        return $this->role == 'Student' ? true : false;
    }

    public function isCredentials()
    {
        return $this->role == 'Credentials' ? true : false;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function scopeGenerateCode()
    {

        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['code' => $code]
        );

        try {

            $details = [
                'title' => 'Your two factor authentication code is:',
                'code' => $code
            ];
            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));

            //SmsApi::sendMessage("TO","MESSAGE");
            //$response = SmsApi::sendMessage("+91" . auth()->user()->phone . "", "Your code is : " . $code);
        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }
}
