@extends('layouts.workspace')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Allowance</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('allowances.update', $allowance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $allowance->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keyword">Keyword</label>
                            <input type="text" name="keyword" class="form-control" id="keyword" value="{{ $allowance->keyword }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description">{{ $allowance->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount" value="{{ $allowance->amount }}" required>
                        </div>
                        <div class="form-group">
                            <label for="minimumWorkingDaysPerMonth">Minimum Working Days Per Month</label>
                            <input type="number" name="minimumWorkingDaysPerMonth" class="form-control" id="minimumWorkingDaysPerMonth" value="{{ $allowance->minimumWorkingDaysPerMonth }}">
                        </div>
                        <div class="form-group">
                            <label for="frequency">Frequency</label>
                            <select name="frequency" class="form-control" id="frequency" required>
                                <option value="monthly" {{ $allowance->frequency === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="yearly" {{ $allowance->frequency === 'yearly' ? 'selected' : '' }}>Yearly</option>
                                <option value="once" {{ $allowance->frequency === 'once' ? 'selected' : '' }}>Once</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="isTaxable">Is Taxable</label>
                            <input type="checkbox" name="isTaxable" id="isTaxable" {{ $allowance->isTaxable ? 'checked' : '' }}>
                        </div>
                        <div class="form-group">
                            <label for="currency_id">Currency</label>
                            <select name="currency_id" class="form-control" id="currency_id">
                                <!-- Assuming you have a list of currencies to choose from -->
                                @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}" {{ $allowance->currency_id == $currency->id ? 'selected' : '' }}>
                                    {{ $currency->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ref">Reference</label>
                            <input type="text" name="ref" class="form-control" id="ref" value="{{ $allowance->ref }}">
                        </div>
                        <div class="form-group">
                            <label for="isPublic">Is Public</label>
                            <input type="checkbox" name="isPublic" id="isPublic" {{ $allowance->isPublic ? 'checked' : '' }}>
                        </div>
                        <div class="form-group">
                            <label for="companyId">Company</label>
                            <select name="companyId" class="form-control" id="companyId" required>
                                <!-- Assuming you have a list of companies to choose from -->
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ $allowance->companyId == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection