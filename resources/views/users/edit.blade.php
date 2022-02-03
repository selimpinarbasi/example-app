@extends('layouts.app')

@section('content')

    <form action="{{ route('user.update', $users->id)}}" method="POST">
        @csrf

        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div>
                    <p>Name : {{ $users->name }}</p>
                    <label>Name</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <p>Lastname : {{$users->lastname}}</p>
                    <label>Lastname</label>
                    <input type="text" name="lastname">
                </div>
                <div>
                    <p> Password : **********</p>
                    <label>Password</label>
                    <input type="text" name="password">
                </div>

                <button type="submit">Güncelle</button>
            </div>
        </div>
    </form>
@endsection
