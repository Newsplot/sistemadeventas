@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Create Invoice Details</h3>
                            <a href="{{ route('invoice_details.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <form action="{{ route('invoice_details.create') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="Enter price">
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter amount">
                                @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bill_id">Bill</label>
                                <select name="bill_id" id="bill_id">
                                    <option value="">Select</option>
                                    @foreach($bills as $bill)
                                        <option
                                        @if($bill->id === (int)$bill->bill_id)
                                            selected
                                        @endif
                                        value="{{ $bill->id }}">{{ $bill->total }}</option>
                                    @endforeach
                                </select>
                                @error('bill_id')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id">
                                    <option value="">Select</option>
                                    @foreach($products as $product)
                                        <option
                                        @if($product->id === (int)$product->product_id)
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
