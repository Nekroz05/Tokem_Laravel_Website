@extends('master')

@section('title', 'Category')

@section('content')
    @if (session('success'))
        <?php
            function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            alert(session('success')[0]);
        ?>
    @endif
    <div class="container-fluid w-75">
        <p class="text-muted">Available categories</p>
        <div class="row">
            @forelse ($categories as $category)
                <div class="col-md-4">
                    <div class="card mb-3" style="border-radius: 15px">
                            <div class="row g-0">
                                <div class="col-3 text-center" style="border-radius: 15px  0px 0px 15px; background-color: #8bde78">
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        {{ $category->category }}
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @empty
            <p class="text-muted">Category is empty, please add</p>
            @endforelse
        </div>

        <p class="text-muted">Add category</p>

        <form action="{{ route('add_category') }}" method="POST">
            @csrf
            <div class="row">
                <!-- <div class=""> -->
                    <div class="col-2">
                        <label for="category" class="form-label">Input new category</label>
                    </div>

                    <div class="col-6">
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror">
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-2">
                        <input type="submit" value="add category">
                    </div>
                <!-- </div> -->
            </div>
        </form>

    </div>
@endsection
