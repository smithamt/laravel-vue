<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appraisal;
use Illuminate\Http\Request;

class AppraisalApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)

    {
        $query = $request->input('query');
        $appraisal = Appraisal::when($query, function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('keyword', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->select('employeeId')
                ->paginate(10);
        })->paginate(10);

        return response()->json($appraisal);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $appraisal = Appraisal::create($request->validated());
        return response()->json($appraisal, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $appraisal = Appraisal::findOrFail($id);
        return response()->json($appraisal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssetRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $appraisal = Appraisal::findOrFail($id);
        $appraisal->update($request->validated());
        return response()->json($appraisal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $appraisal = Appraisal::findOrFail($id);
        $appraisal->isPublic = false;
        $appraisal->save();
        return response()->json(null, 204);
    }
}
