@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <form action="/users/{{ $user->id }}/update" method="post">
                        @csrf
                        <div class="">

                            <label for="name">Username:</label>
                            <input 
                            type="text" 
                            class=""
                            name="name" 
                            placeholder="Product name..."
                            value="{{ $user->name }}">
            
                            <label for="email">Email:</label>
                            <input 
                            type="text"
                            class=""
                            name="email" 
                            placeholder="Description..."
                            value="{{ $user->email }}">
            
                            <label for="phone">Phone Number:</label>
                            <input 
                            type="number"
                            class=""
                            name="phone" 
                            placeholder="Price..."
                            value="{{ $user->phone }}">
            
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
            
                        </div>
                    </form>
                    <p>{{ 'Joined: ' . $user->created_at }}</p>
                    <p>{{ 'Products posted:' . $productCount }}</p>
                    <a class="btn btn-primary" href="/users/{{ $user->id }}/products" role="button">View Products</a>
                    <a class="btn btn-secondary" href="/change-password" role="button">Change Password</a>
                    <form action="/users/{{ $user->id }}/delete" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection