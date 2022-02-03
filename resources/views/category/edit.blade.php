@extends('layouts.app')

@section('content')

    <form action="{{ route('categoryy.update', $category->id)}}" method="POST">
        @csrf

        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div>
                    <p>Name : {{$category->name}}</p>
                    <label>Name : </label>
                    <input type="text" name="name">
                </div>
                <div>
                    <p>Description : {{$category->description}}</p>
                    <label>Description : </label>
                    <input type="text" name="description">
                </div>
                <button type="submit">Güncelle</button>
            </div>
        </div>
    </form>
@endsection
