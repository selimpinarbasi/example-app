@extends('layouts.app')

@section('content')
    <form action="{{route('category.store')}}" method="POST">
        @csrf
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div>
                    <label>Category Name</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Description</label>
                    <input type="text" name="description">
                </div>
                <a> <button>Ekle</button></a>
            </div>
        </div>
    </form>
@endsection
