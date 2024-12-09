@extends('layouts.workspace')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Allowances</h4>
                    <a href="{{ route('allowances.create') }}" class="btn btn-primary float-right">Add Allowance</a>
                </div>
                <div class="card-body">
                    @if ($allowances->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Frequency</th>
                                <th>Is Taxable</th>
                                <th>Is Public</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allowances as $allowance)
                            <tr>
                                <td>{{ $allowance->id }}</td>
                                <td>{{ $allowance->name }}</td>
                                <td>{{ $allowance->amount }}</td>
                                <td>{{ $allowance->frequency }}</td>
                                <td>{{ $allowance->isTaxable ? 'Yes' : 'No' }}</td>
                                <td>{{ $allowance->isPublic ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('allowances.show', $allowance->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('allowances.edit', $allowance->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('allowances.destroy', $allowance->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No allowances found.</p>
                    @endif
                </div>
                <div class="card-footer">
                    {{ $allowances->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection