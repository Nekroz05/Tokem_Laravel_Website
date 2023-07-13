@extends('master')

@section('title', "Profile")

@section('content')
    <div class="container-fluid my-auto w-75">
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

        <div class="card">
            <form action="{{ route('update') }}" method="POST">
                @csrf

                <div class="card-header">
                    Profile
                </div>

                <div class="card-body">
                    <p><span class="fw-bold">Name &emsp;&emsp;&nbsp;: </span>&emsp;<input type="text" name="name" value="{{ Auth::user()->name }}"></p>
                    <div class="row">
                        <span id='message'></span>

                        <div class="col">
                            <p><span class="fw-bold">password : </span>&emsp;<input type="password" name="password" id="password" onkeyup="check();"></p>
                        </div>

                        <div class="col">
                            <p><span class="fw-bold">confirm : </span>&emsp;<input type="password" name="password_confirmation" id="confirm_password" onkeyup="check();"></p>
                        </div>

                    </div>

                    <p><span class="fw-bold">Address &emsp;: </span>&emsp;<textarea row="10" col="30" type="text" name="address">{{Auth::user()->address}}</textarea></p>
                    <p><span class="fw-bold">phone &emsp;&emsp;: </span>&emsp;<input type="text" name="phone" value="{{ Auth::user()->phone }}"></p>
                </div>

                <div class="card-footer text-end">
                    <input type="submit" value="Update" class="btn btn-primary">
                    <a href="{{ route('profile') }}" class="btn btn-danger">Cancel</a>
                </div>

            </form>
        </div>

    </div>
@endsection
