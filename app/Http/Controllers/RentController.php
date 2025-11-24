<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use SupplementBacon\LaravelAPIToolkit\Http\Resources\PaginatedCollection;
use SupplementBacon\LaravelAPIToolkit\Http\Resources\Smart;
use SupplementBacon\LaravelPaginable\Requests\IndexPaginatedRequest;
use Symfony\Component\HttpFoundation\Response;

class RentController extends Controller
{
    public function index(IndexPaginatedRequest $request)
    {
        $items = Rent::paginator($request);

        return new PaginatedCollection($items);
    }

    public function show(Rent $rent)
    {
        return new Smart($rent);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Rent::storeRules());
        $existingRent = Rent::where('bike_id', $validated['bike_id'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('rent_start', [$validated['rent_start'], $validated['rent_end']])
                    ->orWhereBetween('rent_end', [$validated['rent_start'], $validated['rent_end']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('rent_start', '<=', $validated['rent_start'])
                            ->where('rent_end', '>=', $validated['rent_end']);
                    });
            })
            ->first();
        if ($existingRent) {
            return response()->json(['error' => 'The bike is already rented during this period.'], 422);
        }
        $rent = Rent::create($validated);

        return new Smart($rent);
    }

    public function update(Request $request, Rent $rent)
    {
        $validated = $request->validate(Rent::updateRules($rent->id));
        $rent->update($validated);

        return new Smart($rent);
    }

    public function destroy(Rent $rent)
    {
        $rent->delete();

        return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
