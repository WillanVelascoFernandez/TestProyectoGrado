<?php

namespace App\Http\Controllers\Api;

use App\Models\Data;
use Illuminate\Http\Request;
use App\Http\Requests\DataRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Data::paginate();

        return DataResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataRequest $request): Data
    {
        return Data::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Data $data): Data
    {
        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataRequest $request, Data $data): Data
    {
        $data->update($request->validated());

        return $data;
    }

    public function destroy(Data $data): Response
    {
        $data->delete();

        return response()->noContent();
    }

    }
