@extends('app')

@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <div><a href="/" class="btn btn-primary">Home</a></div>
            <div><a href="{{ route('employees.create') }}" class="btn btn-success">New Employees</a></div>
        </div>

        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>LastName</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($employees as $key => $employee)
                    <tr>
                        <td>{{$employees->firstItem() + $key }}.</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->lastname}}</td>
                        <td>{{$employee->address}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->city->name }}</td>
                        <td>{{$employee->created_at->format('F d ,Y')}}</td>
                        <td>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('employees.delete', $employee) }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No data found in table</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
