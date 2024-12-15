<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
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
            'type' => 'nullable|string|max:255',
            'forAll' => 'boolean',
            'amount' => 'nullable|numeric',
            'currency_id' => 'nullable|exists:currencies,id',
            'ref' => 'nullable|string|max:255',
            'condition' => 'nullable|string|max:255',
            'lifecycle' => 'nullable|string|max:255',
            'purchaseDate' => 'nullable|date',
            'depreciation' => 'nullable|numeric',
            'maintenanceSchedule' => 'nullable|string|max:255',
            'assetPerformance' => 'nullable|string|max:255',
            'auditInformation' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'isPublic' => 'boolean',
            'created_by_id' => 'required|exists:employees,id',
            'company_id' => 'required|exists:companies,id',
        ];
    }
}
