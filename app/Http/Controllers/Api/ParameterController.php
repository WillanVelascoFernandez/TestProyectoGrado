<?php

namespace App\Http\Controllers\Api;

use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Http\Requests\ParameterRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ParameterResource;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parameters = Parameter::paginate();

        return ParameterResource::collection($parameters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParameterRequest $request): Parameter
    {
        return Parameter::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Parameter $parameter): Parameter
    {
        return $parameter;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParameterRequest $request, Parameter $parameter): Parameter
    {
        $parameter->update($request->validated());

        return $parameter;
    }

    public function destroy(Parameter $parameter): Response
    {
        $parameter->delete();

        return response()->noContent();
    }
}
