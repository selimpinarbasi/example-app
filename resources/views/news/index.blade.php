@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('news.create') }}">Haber Ekle</a>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($news as $article)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/'. $article->image) }}"
                             class="w-40 mb-8 shadow-xl"
                             alt=""
                             height="200px"
                             width="300px">
                        <div class="card-body">
                            <p class="card-text">
                                {{ $article->title }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    {{\Carbon\Carbon::parse($article->created_at)->format('d.m.Y H.i')}}
                                    <a href="{{route( 'cate-news',$article->category_id )}}">{{ $article->category->name }}</a>
                                </small>
                                <form action="{{ route('news.show', $article->id) }}" method="GET">
                                    <button class="btn btn-primary" type="submit">DevamınıOku</button>
                                </form>
                                @if(auth()->user()->isAdmin || $article->user_id == auth()->id())
                                    <form action="{{ route('news.destroy', $article->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-primary" class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Sil</button>
                                    </form>
                                    <form action="{{ route('news.edit',$article ,$article->id) }}" method="GET">
                                        <button class="btn btn-primary" type="submit">Düzenle</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
