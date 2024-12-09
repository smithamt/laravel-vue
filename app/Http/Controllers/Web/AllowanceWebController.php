<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use App\Models\Company;
use App\Models\Currency;
use Illuminate\Http\Request;

class AllowanceWebController extends Controller
{
    /**
     * Display a listing of the allowances.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allowances = Allowance::paginate(10);
        return view('allowances.index', compact('allowances'));
    }

    /**
     * Show the form for creating a new allowance.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::all();
        $companies = Company::all();
        return view('allowances.create', compact('currencies', 'companies'));
    }

    /**
     * Store a newly created allowance in storage.
     *
     * @param  \App\Http\Requests\StoreAllowanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Allowance::create($request->validated());
        return redirect()->route('allowances.index')->with('success', 'Allowance created successfully.');
    }

    /**
     * Display the specified allowance.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function show(Allowance $allowance)
    {
        return view('allowances.show', compact('allowance'));
    }

    /**
     * Show the form for editing the specified allowance.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function edit(Allowance $allowance)
    {
        $currencies = Currency::all();
        $companies = Company::all();
        return view('allowances.edit', compact('currencies', 'companies', 'allowance'));
    }

    /**
     * Update the specified allowance in storage.
     *
     * @param  \App\Http\Requests\UpdateAllowanceRequest  $request
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allowance $allowance)
    {
        $allowance->update($request->validated());
        return redirect()->route('allowances.index')->with('success', 'Allowance updated successfully.');
    }

    /**
     * Remove the specified allowance from storage.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allowance $allowance)
    {
        $allowance->delete();
        return redirect()->route('allowances.index')->with('success', 'Allowance deleted successfully.');
    }
}
