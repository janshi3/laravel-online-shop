@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Add product</h1>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="">
        <form action="/products/{{ $id }}/update" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="">

                <label for="name">Product name:</label>
                <input 
                type="text" 
                class=""
                name="name" 
                placeholder="Product name..."
                value="{{ $product_name }}">

                <label for="description">Product description:</label>
                <input 
                type="text"
                class=""
                name="description" 
                placeholder="Description..."
                value="{{ $description }}">

                <label for="price">Product price:</label>
                <input 
                type="number"
                class=""
                step="0.01"
                name="price" 
                placeholder="Price..."
                value="{{ $price }}">

                <label for="image">Product picture:</label>
                <input 
                type="file" 
                accept="image/*"
                class="" 
                name="image" 
                placeholder="Upload image">

                <button type="submit" class="btn">
                    Submit
                </button>

            </div>
        </form>
    </div>
@endsection