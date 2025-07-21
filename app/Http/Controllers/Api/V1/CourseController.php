<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query()->with('professor');
        if ($request->has('professor_id')) {
            $query->where('professor_id', $request->professor_id);
        }
        $courses = $query->paginate(min($request->get('per_page', 10), 100));
        return CourseResource::collection($courses);
    }

    public function show($id)
    {
        $course = Course::with('professor')->findOrFail($id);
        return response()->json(new CourseResource($course), Response::HTTP_OK);
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());
        return response()->json(new CourseResource($course), Response::HTTP_CREATED);
    }

    public function update(UpdateCourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->validated());
        return response()->json(new CourseResource($course), Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
