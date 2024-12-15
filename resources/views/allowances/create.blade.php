@extends('layouts.workspace')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create Allowance</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('allowances.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="keyword">Keyword</label>
                            <input type="text" name="keyword" class="form-control" id="keyword">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="minimumWorkingDaysPerMonth">Minimum Working Days Per Month</label>
                            <input type="number" name="minimumWorkingDaysPerMonth" class="form-control" id="minimumWorkingDaysPerMonth">
                        </div>
                        <div class="form-group">
                            <label for="frequency">Frequency</label>
                            <select name="frequency" class="form-control" id="frequency" required>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                                <option value="once">Once</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="isTaxable">Is Taxable</label>
                            <input type="checkbox" name="isTaxable" id="isTaxable">
                        </div>
                        <div class="form-group">
                            <label for="currency_id">Currency</label>
                            <select name="currency_id" class="form-control" id="currency_id">
                                <!-- Assuming you have a list of currencies to choose from -->
                                @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ref">Reference</label>
                            <input type="text" name="ref" class="form-control" id="ref">
                        </div>
                        <div class="form-group">
                            <label for="isPublic">Is Public</label>
                            <input type="checkbox" name="isPublic" id="isPublic">
                        </div>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" class="form-control" id="company_id" required>
                                <!-- Assuming you have a list of companies to choose from -->
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection