<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use App\Http\Resources\ProfessorResource;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $professors = Professor::with('courses')
            ->paginate(min($request->get('per_page', 10), 100));

        return ProfessorResource::collection($professors);
    }

    public function show($id)
    {
        $professor = Professor::with('courses')->findOrFail($id);
        return response()->json(new ProfessorResource($professor), Response::HTTP_OK);
    }

    public function store(StoreProfessorRequest $request)
    {
        $professor = Professor::create($request->validated());
        return response()->json(new ProfessorResource($professor), Response::HTTP_CREATED);
    }

    public function update(UpdateProfessorRequest $request, $id)
    {
        $professor = Professor::findOrFail($id);
        $professor->update($request->validated());
        return response()->json(new ProfessorResource($professor), Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
