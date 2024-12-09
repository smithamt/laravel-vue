<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use Illuminate\Http\Request;

class AssetApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)

    {
        $query = $request->input('query');
        $assets = Asset::paginate(10);
        $assets = Asset::when($query, function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('keyword', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%");
        })->paginate(10);

        return response()->json($assets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssetRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAssetRequest $request)
    {
        $asset = Asset::create($request->validated());
        return response()->json($asset, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $asset = Asset::findOrFail($id);
        return response()->json($asset);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssetRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAssetRequest $request, $id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update($request->validated());
        return response()->json($asset);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->isPublic = false;
        $asset->save();
        return response()->json(null, 204);
    }
}
