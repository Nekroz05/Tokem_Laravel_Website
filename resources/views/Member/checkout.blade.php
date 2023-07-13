@extends('master')

@section('title', "Profile")

@section('content')
@if ($errors->any())
        <?php
            function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }

        ?>

        @foreach ($errors->all() as $error)
            <div><?php alert($error) ?></div>
        @endforeach
    @endif
<h1>Checkout</h1>

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
                    <td>{{ $product->quantity }}</td>
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
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PaymentModal">
  Confirm checkout
</button>
<!-- <a class="mx-4 btn btn-primary rounded-4" href="{{ route('checkOut',['id'=>$hist->id]) }}">Check Out</a> -->
<div class="modal fade" id="PaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('checkOut',['id'=>$hist->id]) }}", method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation on payment for Rp {{ $totalPrice }}?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Shipping address: {{ Auth::user()->address }}</p>
                <p>confirm : <input type="text" name="confirm" value="{{ $dummy }}" readonly></p>
                <p>Password: <input type="password" name="password"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Confirm">
            </div>
        </form>
    </div>
  </div>
</div>
@endsection
