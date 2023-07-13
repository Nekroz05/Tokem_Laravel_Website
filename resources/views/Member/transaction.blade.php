@extends('master')

@section('title', "Profile")

@section('content')

    <div class="w-90" style="margin: 10vh 20vw 10vh 20vw;">
        <div class="accordion accordion-flush" style=" overflow: hidden;">
            {{-- {{ DD($histories->first()); }} --}}
            @forelse ($histories as $history)
            {{-- {{ DD($historiy); }} --}}
            <div class="accordion-item w-75">
                <?php $totalPrice = 0 ?>
                <h2 class="accordion-header" id="flush-heading{{ $history->id }}">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $history->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $history->id }}">
                    <h4>{{ $history->created_at }}</h4>
                  </button>
                </h2>

                <div id="flush-collapse{{ $history->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $history->id }}" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <table class=" table table-striped">
                        <th >Product Image</th>
                        <th >Product Name</th>
                        <th >Product Price</th>
                        <th >Product Quantity</th>
                        <th >Sub Total</th>
                        {{-- {{ DD($history->carts); }} --}}
                        @foreach ($history->cart->products as $product)
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

                  </div>
                </div>
            </div>

            @empty
            <h1>No Item Purchase History yet...</h1>
            <h1>Go To Products page and find the best flower for you!</h1>
            @endforelse

        </div>
    </div>

@endsection
