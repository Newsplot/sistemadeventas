@extends('app')

@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <div><a href="/" class="btn btn-primary">Home</a></div>
            <div><a href="{{ route('bills.create') }}" class="btn btn-success">New Bills</a></div>
        </div>

        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Client</th>
                    <th>Employee</th>
                    <th>Product</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($bills as $key => $bill)
                    <tr>
                        <td>{{$bills->firstItem() + $key }}.</td>
                        <td>{{$bill->subtotal }}</td>
                        <td>{{$bill->total }}</td>
                        <td>{{$bill->client->name }}</td>
                        <td>{{$bill->employee->name }}</td>
                        <td>{{$bill->product->name }}</td>
                        <td>{{$bill->created_at->format('F d ,Y')}}</td>
                        <td>
                            <a href="{{ route('bills.edit', $bill) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('bills.delete', $bill) }}" method="post" style="display: inline;">
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
