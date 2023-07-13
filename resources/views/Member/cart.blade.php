@extends('master')

@section('title', "Profile")

@section('content')
<div class="w-75 container-fluid">
@if ($products->first())
    <?php $totalPrice = 0 ?>
    <table class="table table-striped">
        <th>Products Image</th>
        <th>Products Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
        @foreach ($products as $product)
            <tr>
                @foreach ($details as $detail)
                    @if ($detail->id == $product->product_detail_id)
                        <td><img src="{{ asset('storage/'.$detail->image_path) }}" alt="" class="image-logo"></td>
                        <td> {{ $detail->name }}</td>
                        <td>{{ $detail->price }}</td>
                        <form action="{{ route('updateProductQuantity',['id'=>$product->id]) }}" method="POST">
                            @csrf
                            <td><input onchange="this.form.submit();" type="number" name="quantity" value="{{ $product->quantity  }}" min="min" max="{{ $detail->stock }}"></td>
                        </form>
                        <?php
                        $subtotal = $detail->price * $product->quantity
                        ?>
                        <?php $totalPrice += $subtotal ?>

                        <td>{{ $subtotal }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach




    </table>

    <h4>Total Price : {{ $totalPrice }}</h4>
    <!-- <input type="submit" class="btn btn-primary rounded-4" value="Checkout"> -->
    <a class="mx-4 btn btn-primary rounded-4" href="{{ route('checkOutPage') }}">Check Out</a>

@else
    <h1>No Item In You Cart...</h1>
    <h1>Please go to our products page and add some to your cart, thank you!</h1>
@endif
</div>
{{-- <script></script>
    var select = document.getElementById('client_id');
    select.onchange = function(){
        this.form.submit();
    };
</script> --}}
@endsection
