<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Http\Services\ClassroomService;
use Illuminate\Http\Request;
use App\Http\Requests\ClassroomUserRequest;

class ClassroomController extends Controller
{
    public function __construct(private ClassroomService $classroomService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ClassroomResource::collection($this->classroomService->getWithFilters($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request)
    {
        return new ClassroomResource($this->classroomService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ClassroomResource($this->classroomService->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRequest $request, string $id)
    {
        return new ClassroomResource($this->classroomService->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->classroomService->destroy($id);

        return response()->noContent();
    }
    public function manageUser(ClassroomUserRequest $request, string $id)
    {
        return response()->json(
            $this->classroomService->manageUser($id, $request->validated())
        );
    }
}
