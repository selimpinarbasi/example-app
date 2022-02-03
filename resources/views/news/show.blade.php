@extends('layouts.app')

@section('content')
    <div class="container">

        <img src="{{ asset('images/'. $news->image) }}"
             class="w-40 mb-8 shadow-xl"
             alt=""
             height="200px"
             width="300px">
        <div class="row justify-content-center">

            <h2>{{ $news->title }}</h2>

            <p>
                {{ $news->content }}
            </p>


        </div>
    </div>
@endsection
