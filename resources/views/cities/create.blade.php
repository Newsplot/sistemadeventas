@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3>Create City</h3>
                            <a href="{{ route('cities.index') }}" class="btn btn-secondary">Back to list</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <form action="{{ route('cities.create') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label h4">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Department">
                                @error('name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="department_id" class="h4">Department</label>
                                <select name="department_id" class="form-select form-select-lg mb-3" id="department_id">
                                    <option value="">Select</option>
                                    @foreach($departments as $department)
                                        <option
                                            @if($department->id === (int)old('department_id'))
                                                selected
                                            @endif
                                            value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
