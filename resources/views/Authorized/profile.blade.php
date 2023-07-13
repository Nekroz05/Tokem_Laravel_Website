@extends('master')

@section('title', "Profile")

@section('content')
    @if (session('success'))
        <?php
            function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            alert(session('success')[0]);
        ?>
    @endif
    <div class="container-fluid my-auto w-50">


        <div class="card">

            <div class="card-header">
                Profile
            </div>

            <div class="card-body">
                <p><span class="fw-bold">Name &emsp;&emsp;&nbsp;: </span>&emsp;<input type="text" value="{{ Auth::user()->name }}" disabled></p>
                <p><span class="fw-bold">Email &emsp;&emsp;&nbsp;&nbsp;: </span>&emsp;<input type="text" value="{{ Auth::user()->email }}" disabled></p>
                <p><span class="fw-bold">Address &emsp;: </span>&emsp;<input type="textarea" row="10" col="20" value="{{ Auth::user()->address }}" disabled></p>
                <p><span class="fw-bold">Password &nbsp;: </span>&emsp;<input type="password" value="{{ Auth::user()->password }}" disabled></p>
                <p><span class="fw-bold">phone &emsp;&emsp;: </span>&emsp;<input type="text" value="{{ Auth::user()->phone }}" disabled></p>
            </div>

            <div class="card-footer text-end">
                    <form action="{{ route('update_page') }}" style="display: inline-block">
                        @csrf
                        <input type="submit" value="Update" class="btn btn-primary">
                    </form>

                    <form action="{{ route('logout') }}" style="display: inline-block">
                        @csrf
                        <input type="submit" value="logout" class="btn btn-danger">
                    </form>
            </div>


        </div>

    </div>
@endsection
