@extends('master')

@section('title', "edit prodcuts")

@section('content')
@if ($errors->any())
        <?php
            function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }

        ?>

        @foreach ($errors->get('image') as $error)
            <div><?php alert($error) ?></div>
        @endforeach
    @endif
<div class="container-fluid w-75">
        <div class="card">
            <form action="{{ route('addProductAttempt') }}" method="POST" enctype="multipart/form-data" id="addProductForm">
                @csrf

                <div class="card-header">
                    Add product
                </div>

                <div class="card-body">
                    <p><label for="name" class="fw-bold">name : </label>&emsp;
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p>
                        <label for="desc" class="fw-bold">description : </label>&emsp;<input id="desc" type="text" name="description" class="form-control @error('name') is-invalid @enderror">
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p>
                        <label for="price" class="fw-bold">price : </label>&emsp;<input id="price" type="text" name="price" class="form-control @error('name') is-invalid @enderror">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p>
                        <label for="stock" class="fw-bold">stock : </label>&emsp;<input id="stock" type="text" name="stock" class="form-control @error('name') is-invalid @enderror">
                        @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p>
                        <label for="image" class="fw-bold">image : </label>&emsp;<input id="image" type="file" name="image" class="form-control @error('name') is-invalid @enderror">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p>
                        <label for="category" class="fw-bold">Category : </label>
                        <select name="category" id="category" form="addProductForm">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </p>


                    {{-- @foreach ($categories as $category)
                        <input type="radio" id="{{ $category->category }}" name="category" value="{{ $category->id }}">
                        <label for="{{ $category->category }}">{{ $category->category }}</label><br>
                    @endforeach --}}
                </div>

                <div class="card-footer text-end">
                    <a href="/products" class="btn btn-danger mx-4"> Back </a>
                    <input type="submit" value="Add Product" class="btn btn-primary">
                </div>

            </form>
        </div>

    </div>
@endsection
