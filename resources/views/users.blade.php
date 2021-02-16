@extends('layouts.app')

<script>
    function confirmAdmin(id) {
        if (confirm("Change admin privileges?")){
            var form = document.getElementById(id);
            form.submit();
        };
    }
</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    @foreach ($users as $user)

                        <p>{{ $user->id }}</p>
                        <h3>{{ $user->name }}</h3>
                        <p>{{ $user->email }}</p>
                        <p>{{ $user->created_at }}</p>

                        <a onclick="confirmAdmin({{ $user->id }})" href="" class="">
                            @if ($user->admin == 0)
                                <input type="checkbox" name="admin" id="">
                            @else
                                <input type="checkbox" name="admin" id="" checked>
                            @endif
                            <form id="{{ $user->id }}" action="/users/{{ $user->id }}/admin" method="post">
                                @csrf
                            </form>
                        </a>

                        <form action="/users/{{ $user->id }}/delete" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection