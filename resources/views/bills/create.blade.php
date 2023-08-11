@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Create Bill</h3>
                            <a href="{{ route('bills.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <form action="{{ route('bills.create') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="subtotal" class="form-label">Sub Total</label>
                                <input type="text" name="subtotal" id="subtotal" class="form-control" placeholder="Enter subtotal">
                                @error('subtotal')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label">Total</label>
                                <input type="text" name="total" id="total" class="form-control" placeholder="Enter total">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="client_id">Client</label>
                                <select name="client_id" id="client_id">
                                    <option value="">Select</option>
                                    @foreach($clients as $client)
                                        <option
                                        @if($client->id === (int)old('client_id'))
                                            selected
                                        @endif
                                        value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="employee_id">Employee</label>
                                <select name="employee_id" id="employee_id">
                                    <option value="">Select</option>
                                    @foreach($employees as $employee)
                                        <option
                                        @if($employee->id === (int)old('employee_id'))
                                            selected
                                        @endif
                                        value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                @error('$employee_id')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id">
                                    <option value="">Select</option>
                                    @foreach($products as $product)
                                        <option
                                        @if($product->id === (int)old('product_id'))
                                            selected
                                        @endif
                                        value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
