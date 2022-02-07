@extends('layouts.app')

@section('content')
    <form action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div>
                    <label>Title : </label>
                    <input type="text" name="title" placeholder="Başlık giriniz...">
                </div>
                <div>
                    <label>Content : </label>
                    <input type="text" name="content" placeholder="Yazıyı giriniz...">
                </div>
                <div>
                    <label>image : </label>
                    <input type="file" name="image">
                </div>

                <div>
                    <label>Category ID : </label>
                    <!--<input type="text" name="category_id">-->
                    <!--<input type="text" list="category_id" name="category_id" placeholder="Kategori seçiniz.."/>
                    <datalist id="category_id">
                        @fo reach($category as $article)
                            <option value="{ {$article->id}}">{ {$article->name}}</option>
                        @e ndforeach
                    </datalist>-->
                    <select name="category_id" id="category_id">
                        <option value="">Kategori seçiniz</option>
                        @foreach($category as $article)
                            <option value="{{$article->id}}">{{$article->name}}</option>
                        @endforeach
                    </select>
                </div>

                <a> <button>Ekle</button></a>
            </div>
        </div>
    </form>
@endsection
