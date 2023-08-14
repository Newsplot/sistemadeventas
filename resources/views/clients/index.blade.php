@extends('app')

@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <div><a href="/" class="btn btn-primary">Home</a></div>
            <div><a href="{{ route('clients.create') }}" class="btn btn-success">New Client</a></div>
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
                    <th>Identification</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($clients as $key => $client)
                    <tr>
                        <td>{{$clients->firstItem() + $key }}.</td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->lastname}}</td>
                        <td>{{$client->identification}}</td>
                        <td>{{$client->phone}}</td>
                        <td>{{$client->address}}</td>
                        <td>
                            {{$client->city->name}}
                        </td>
                        <td>{{$client->created_at->format('F d ,Y')}}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('clients.delete', $client) }}" method="post" style="display: inline;">
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
