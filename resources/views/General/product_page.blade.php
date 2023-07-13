@extends('master')

@section('title', "Products")

@section('content')
    @if (session('success'))
        <?php
            function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            alert(session('success')[0]);
        ?>
    @endif

    <div class="m-5 flex justify-content-between">
        <p class=" fw-bold h2">Our Products</p>

        <form action="{{ route('search') }}" method="GET">
            @csrf
            <label for="search" class="fw-bold h4">Search : </label>
            <input type="search" name="search" id="search" style="width: 15vw;">
        </form>
    </div>

    <div class="w-90" style="margin-left: 11vw;">
        <?php

        $numOfCols = 3;
        $rowCount = 0;
        ?>
        @forelse ($products as $product) <?php
            if($rowCount % $numOfCols == 0) { ?> <div class="row"> <?php }
                $rowCount++; ?>

                <div class="card col-md-3 mx-4 my-3 rounded-25">
                    <a href="/products/{{ $product->id }}">
                        <img src="{{ asset('storage/'.$product->image_path) }}" class="p-2 rounded-25" style="width: 100%; height:40vh;" alt="Not Available">
                        {{-- <img src="storage/{{ $product->image_path }}" class="p-2 rounded-25" style="width: 100%"> --}}
                    </a>
                    <hr>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <h5 class="card-text"> Rp. {{ $product->price }},00</h5>
                    </div>
                    <div class="card-footer" style="background-color: inherit">
                        @if (Auth::check() && Auth::user()->role == 2)
                            <div class="flex justify-content-between">
                                <a href="{{ route('edit', ['id' => $product->id] ) }}" class="btn btn-primary rounded-25">Edit Product</a>
                                <form action="{{ route('deleteProductAttempt',['id' => $product->id] ) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-primary rounded-25" value="Remove Product">
                                </form>

                            </div>
                        @else
                        @if ($product->stock == 0)
                            <a href="{{ route('productDetail',['id' => $product->id]) }}" class="btn btn-primary rounded-25 disabled">Add to cart</a>
                        @else
                            <a href="{{ route('productDetail',['id' => $product->id]) }}" class="btn btn-primary rounded-25">Add to cart</a>
                        @endif

                        @endif
                    </div>
                </div>

            <?php
                if($rowCount % $numOfCols == 0) { ?> </div> <?php }?>
        @empty
        <h1>No Product Match</h1>
        @endforelse

        <br>
        {{ $products->onEachSide(0)->links() }}


        @if (Auth::check() && Auth::user()->role == 2)
        <a class="me-4 text-decoration-none fs-5 fw-bold btn btn-primary" href="{{ route('addProductPage') }}"> Add Products </a>
        @endif
    </div>

    @if (session('removeProduct'))
        {{-- {{ $msg = $success; }} --}}
        {{-- {{ DD(session('success')); }} --}}
        <script>
            alert('Successfully Remove The Product');
        </script>
    @endif

@endsection
