@extends('layouts.app')

@section('content')
    <div class="col">
        {{$category}}
        <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            @foreach($category as $cate)
                <div class="card-body">
                    <p class="card-text">
                        @dd($cate)
                        {{ $cate->getNews->title }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                        </small>
                        <form action="{{ route('category.show', $cate->id) }}" method="GET">
                            <button class="btn btn-primary" type="submit">DevamınıOku</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
