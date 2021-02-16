@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <img src="{{ asset('storage/product_images/' . $product->image_name) }}" alt="Product image">
                    <h2>{{ 'Name: ' . $product->product_name }}</h2>
                    <p>Description: </p>
                    <p>{{ $product->description }}</p>
                    <p>{{ 'Price: $' . $product->price }}</p>
                    <h3>Contact seller:</h3>
                    <a href="{{ 'mailto:' . $user->email }}">{{ $user->email }}</a>
                    <a href="{{ 'tel:' . $user->phone }}">{{ $user->phone }}</a>
                    <p>{{ 'Created at: ' . $product->created_at }}</p>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection