@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Change Password</div>

   

                <div class="card-body">

                    <form method="POST" action="/change-password">

                        @csrf 

   

                         @foreach ($errors->all() as $error)

                            <p class="text-danger">{{ $error }}</p>

                         @endforeach 

  

                        <div class="form-group row">

                            <label for="password" class="col-md-4 col-form-label text-md-right">Old Password</label>

  

                            <div class="col-md-6">

                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">

                            </div>

                        </div>

  

                        <div class="form-group row">

                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

  

                            <div class="col-md-6">

                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">

                            </div>

                        </div>

  

                        <div class="form-group row">

                            <label for="password" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>

    

                            <div class="col-md-6">

                                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" autocomplete="current-password">

                            </div>

                        </div>

   

                        <div class="form-group row mb-0">

                            <div class="col-md-8 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    Confirm

                                </button>

                                <a href="/users/{{ Auth::id() }}" class="btn btn-secondary">Cancel</a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection