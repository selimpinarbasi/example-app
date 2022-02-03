@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->user()->isAdmin)
            <a href="{{ route('category.create') }}">Kategori Ekle</a>
        @endif
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($categories as $category)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{route( 'cate-news',$category->id )}}">{{ $category->name }}</a>
                            </p>
                            <small>{{ $category->description }}</small>
                            @if(auth()->user()->isAdmin)
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary" class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Sil</button>
                                </form>
                                <form action="{{ route('category.edit', $category->id) }}" method="GET">
                                    <button class="btn btn-primary" type="submit">Düzenle</button>
                                </form>
                                <div class="d-flex justify-content-between align-items-center">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
