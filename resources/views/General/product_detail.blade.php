@extends('master')

@section('title', "Products")

@section('content')

<div class="flex" style="margin : 10vh 10vw 10vh 10vw">
    <img src="{{ asset('storage/'.$product->image_path) }}" class="p-2 rounded-25 mx-5" style="width: 40vw;">
    <div class="text-wrap">
        <h1>{{ $product->name }}</h1>
        <p  style="width: 20vw; height:20vh;">{{ $product->description }}</p>
        <p>Category : {{ $product->category->category }}</p>
        <p>Stock : {{ $product->stock}}</p>
        @if (!(Auth::check() && Auth::user()->role == 2))
        <form action="/addToCart/{{ $product->id }}" method="GET">
            <input name="quantity" type="range" value="1" min="1" max="{{ $product->stock }}" oninput="this.nextElementSibling.value = this.value">
            <output>1</output>
            <br><br>
            @if ($product->stock == 0)
                <input type="submit" class="btn btn-primary rounded-25 disabled" value="Add To Cart">
            @else
                <input type="submit" class="btn btn-primary rounded-25" value="Add To Cart">
            @endif

        </form>
        @endif

    </div>
</div>

@endsection
