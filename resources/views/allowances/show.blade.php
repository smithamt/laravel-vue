@extends('layouts.workspace')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Allowance Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $allowance->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $allowance->name }}</td>
                        </tr>
                        <tr>
                            <th>Keyword</th>
                            <td>{{ $allowance->keyword }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $allowance->description }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ $allowance->amount }}</td>
                        </tr>
                        <tr>
                            <th>Minimum Working Days Per Month</th>
                            <td>{{ $allowance->minimumWorkingDaysPerMonth }}</td>
                        </tr>
                        <tr>
                            <th>Frequency</th>
                            <td>{{ ucfirst($allowance->frequency) }}</td>
                        </tr>
                        <tr>
                            <th>Is Taxable</th>
                            <td>{{ $allowance->isTaxable ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Currency</th>
                            <td>{{ $allowance->currency ? $allowance->currency->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Reference</th>
                            <td>{{ $allowance->ref }}</td>
                        </tr>
                        <tr>
                            <th>Is Public</th>
                            <td>{{ $allowance->isPublic ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Company</th>
                            <td>{{ $allowance->company ? $allowance->company->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td>{{ $allowance->createdBy ? $allowance->createdBy->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $allowance->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $allowance->updated_at }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('allowances.edit', $allowance->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('allowances.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection