@extends('layouts.app')

@section('content')

    <form action="{{ route('article.update', $news->id)}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div>
                    <p>Title : {{$news->title}}</p>
                    <label>Title : </label>
                    <input type="text" name="title">
                </div>
                <div>
                    <p>Content : {{$news->content}}</p>
                    <label>Content : </label>
                    <input type="text" name="content">
                </div>
                <div>
                    <p>Image : {{$news->image}}</p>
                    <label>Image : </label>
                    <input type="file" name="image">
                </div>
                <div>
                    <p>CategoryID : {{$news->category->name}}</p>
                    <label>CategoryID : </label>
                    <select name="category_id" id="category_id">
                        <option value="">Kategori seçiniz</option>
                        @foreach($category as $article)
                            <option value="{{$article->id}}">{{$article->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit">Güncelle</button>
            </div>
        </div>
    </form>
@endsection
