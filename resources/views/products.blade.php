@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    @foreach ($products as $product)
                        <img src="{{ asset('storage/product_images/' . $product->image_name) }}" alt="Product image">
                        <a href="/products/{{ $product->id }}">{{ $product->product_name }}</a>
                        <p>{{ '$' . $product->price }}</p>
                        @guest
                        @else
                            @if ($product->user_id == Auth::id())
                                <a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
                                <form action="/products/{{ $product->id }}/delete" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            @endif
                        @endguest
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection