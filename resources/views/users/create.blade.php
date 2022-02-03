@extends('layouts.app')

@section('content')
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div>
                    <label>Name</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Lastname</label>
                    <input type="text" name="lastname">
                </div>
                <div>
                    <label>email</label>
                    <input type="text" name="email">
                </div>
                <div>
                    <label>Password</label>
                    <input type="text" name="password">
                </div>
                <a> <button>Ekle</button></a>
            </div>
        </div>
    </form>
@endsection
