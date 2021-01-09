<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $courses = $user->courses()->notEnded()->latest()->get();

        $response = [];

        /** @var Course $course */
        foreach ($courses as $course){
            $response[] = [
                'id' => $course->id,
                'title' => $course->title,
                'study_field' => $course->studyField()->first()->title,
                'teacher' => $course->teacher()->first()->name,
                'lesson' => $course->lesson()->first()->title,
            ];
        }

        return response($response);
    }

    public function show(Course $course)
    {
        if($course->is_ended)
            return abort(404);

        /** @var User $user */
        $user = auth()->user();

        if(!$user->hasThisCourse($course))
            return abort(404);

        $users = $course->users()->latest()->get();

        $studyField = $course->studyField()->first();
        $teacher = $course->teacher()->first();
        $lesson = $course->lesson()->first();

        return response([
            'course' => $course,
            'lesson' => $lesson,
            'teacher' => $teacher,
            'study_field' => $studyField,
            'users' => $users,
//            'groups' => '$groups',
        ]);
    }
}
