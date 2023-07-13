@extends('master')

@section('title', 'Home')

@section('content')

    <div class="jumbo text-center backdrop">
        <h1 class="display-1"><span class="fw-bold" style="color: #856CC8">Level up</span> your planting game.</h1>
    </div>

    <div class="container-fluid w-75 text-center py-5" style="color: #81c86c">
        @if (session('success'))
            <?php
            function alert($msg)
            {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            alert(session('success')[0]);
            ?>
        @endif
        <div>
            <p class="fw-bold">One-stop boutique for all your home and gardening needs.</p>
            <p class="text-muted">We provide Wide variety of plants and gardening services</p>
        </div>

        <div class="container-fluid py-5">

            <div class="row">

                <div class="col-6 d-flex align-items-center">
                    <div class="text-center ">
                        <p class="fw-bold">Be a plant parent now.</p>
                        <p class="text-muted">Beautify your surroundings by adding a touch of live plant. We provide any
                            plant to suit your environment, plant-medium, and we will guide you through every step in
                            becoming a plant parent.</p>
                    </div>
                </div>

                <div class="col-6">
                    <img src="{{ asset('Storage/Assets/plant1.jpg') }}" class="w-75" alt="Plants">
                </div>

            </div>

            <div class="row">

                <div class="col-6">
                    <img src="{{ asset('Storage/Assets/plant2.jpg') }}" class="w-75" alt="Plants">
                </div>

                <div class="col-6 d-flex align-items-center">
                    <div class="text-center ">
                        <p class="fw-bold">Professional plant care</p>
                        <p class="text-muted">Make a great working environtment by having plants around to provide fresh air
                            and joyous feelings. We will take care for everything in your office from installation to
                            maintenance.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <hr>

@endsection
