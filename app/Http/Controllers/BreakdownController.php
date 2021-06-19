<?php

namespace App\Http\Controllers;

use App\Http\Requests\BreakdownGetRequest;
use App\Http\Requests\BreakdownPostRequest;
use App\Http\Resources\BreakdownCreateResource;
use App\Http\Resources\BreakdownResource;
use App\Models\Breakdown;

class BreakdownController extends Controller
{
    public function store(BreakdownPostRequest $request)
    {
        return new BreakdownCreateResource(Breakdown::create($request->all()));
    }

    public function index(BreakdownGetRequest $request)
    {
        return BreakdownResource::collection(Breakdown::withinInterval($request->starts_at, $request->ends_at)->paginate());
    }
}
