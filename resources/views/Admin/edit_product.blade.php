@extends('master')

@section('title', "edit prodcuts")

@section('content')
    <div class="container-fluid w-75">
        <div class="card">
            <form action="{{ route('editAttempt', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-header">
                    {{  $product->name }}
                </div>

                <div class="card-body">
                    <p>
                        <span class="fw-bold">description : </span>&emsp;
                        <input type="text" name="description" value="{{ $product->description }}" class="form-control @error('description') is-invalid @enderror">
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p>
                        <span class="fw-bold">price : </span>&emsp;
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p>
                        <span class="fw-bold">stock : </span>&emsp;
                        <input type="text" name="stock" value="{{ $product->stock }}" class="form-control @error('stock') is-invalid @enderror"></input>
                        @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p>
                        <span class="fw-bold">image : </span>&emsp;
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>
                </div>

                <div class="card-footer text-end">
                    <input type="submit" value="Update" class="btn btn-primary">
                    <a href="{{ route('products') }}" class="btn btn-danger">Cancel</a>
                </div>

            </form>
        </div>

    </div>
@endsection
