<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $attributes['slug'] = Str::slug ((request('name') . " " . microtime(true)));
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

    public function search(): JsonResponse
    {
        $search_keys = array("name", "price", "description", "category_id");

        if(request()->hasAny($search_keys)) {
            $apartments = DB::table('apartments')->select('id', 'name', 'price', 'currency');
            match (true) {
                request()->has('name') => $apartments->where('name','LIKE',  '%' . request('name') .'%'),
                request()->has('price') => $apartments->where('price', '=', request('price')),
                request()->has('description') => $apartments->where('description', 'LIKE', '%' . request('description') .'%'),
                request()->has('category_id') => $apartments->where('category_id', '=', request('category_id'))
            };
            $apartments = $apartments->paginate(10)->items();
        } else {
            $apartments = 'Your search has no results';
        }
        return response()->json($apartments);
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
