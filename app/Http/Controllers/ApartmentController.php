<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $apartments = DB::table('apartments')
            ->select('id','name', 'price', 'currency')
            ->paginate(10)
            ->items();

        return response()->json($apartments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {

        $attributes = $this->validateApartment();
        $apartment = Apartment::create($attributes);

        return response()->json($apartment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        $apartment = Apartment::findOrFail($id);
        $attributes = $this->validateApartment();
        $apartment->update($attributes);

        return response()->json('Apartment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->delete();

        return response()->json("Apartment deleted successfully");
    }

    protected function validateApartment(): array {
        return request()->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'currency' => ['required', 'string', 'size:3'],
            'category_id' => ['required', 'integer'],
            'rating' => ['required', 'numeric', 'min:0', 'max:5']
        ]);
    }
}
