@extends('app')

@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <div><a href="/" class="btn btn-primary">Home</a></div>
            <div><a href="{{ route('invoice_details.create') }}" class="btn btn-success">New Invoice Details</a></div>
        </div>

        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Product</th>
                    <th>Bill</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($invoice_details as $key => $invoice_detail)
                    <tr>
                        <td>{{$invoice_details->firstItem() + $key }}.</td>
                        <td>{{$invoice_detail->price }}</td>
                        <td>{{$invoice_detail->amount }}</td>
                        <td>{{$invoice_detail->product->name }}</td>
                        <td>{{$invoice_detail->Bill->Total }}</td>
                        <td>{{$invoice_detail->created_at->format('F d ,Y')}}</td>
                        <td>
                            <a href="{{ route('invoice_details.edit', $invoice_detail) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('invoice_details.delete', $invoice_detail) }}" method="post" style="display: inline;">
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
