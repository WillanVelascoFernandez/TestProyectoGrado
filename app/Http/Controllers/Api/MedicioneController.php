<?php

namespace App\Http\Controllers\Api;

use App\Models\Medicione;
use Illuminate\Http\Request;
use App\Http\Requests\MedicioneRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MedicioneResource;

class MedicioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mediciones = Medicione::paginate();

        return MedicioneResource::collection($mediciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicioneRequest $request): Medicione
    {
        return Medicione::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicione $medicione): Medicione
    {
        return $medicione;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicioneRequest $request, Medicione $medicione): Medicione
    {
        $medicione->update($request->validated());

        return $medicione;
    }

    public function destroy(Medicione $medicione): Response
    {
        $medicione->delete();

        return response()->noContent();
    }
}
