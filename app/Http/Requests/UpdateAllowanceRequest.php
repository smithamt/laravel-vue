<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllowanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'minimumWorkingDaysPerMonth' => 'nullable|integer',
            'frequency' => 'required|in:monthly,yearly,once',
            'isTaxable' => 'boolean',
            'currency_id' => 'nullable|exists:currencies,id',
            'ref' => 'nullable|string|max:255',
            'isPublic' => 'boolean',
            'companyId' => 'required|exists:companies,id',
            'created_by_id' => 'required|exists:employees,id',
        ];
    }
}
