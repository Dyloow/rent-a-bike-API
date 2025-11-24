<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use SupplementBacon\LaravelAPIToolkit\Http\Resources\{PaginatedCollection, Smart};
use SupplementBacon\LaravelPaginable\Requests\IndexPaginatedRequest;
use Symfony\Component\HttpFoundation\Response;


class BikeController extends Controller
{
    public function index(IndexPaginatedRequest $request)
    {
        $items = Bike::paginator($request);

        return new PaginatedCollection($items);
    }

    public function show(Bike $bike)
    {
        return new Smart($bike);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Bike::storeRules());
        $bike = Bike::create($validated);

        return new Smart($bike);
    }

    public function update(Request $request, Bike $bike)
    {
        $validated = $request->validate(Bike::updateRules($bike->id));
        $bike->update($validated);

        return new Smart($bike);
    }

    public function destroy(Bike $bike)
    {
        $bike->delete();

        return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
