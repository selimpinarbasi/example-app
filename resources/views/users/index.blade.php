@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('users.create') }}">Kullanıcı Ekle</a>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($users as $user)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                            @if($user->isAdmin == true)
                                {{$user->name}} {{$user->lastname}}
                                {{"{Admin}"}}
                            @else
                                {{ $user->name}} {{ $user->lastname }}
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary" class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Sil</button>
                                </form>

                                <form action="{{ route('users.edit', $user->id) }}" method="GET">
                                    <button class="btn btn-primary" type="submit">Düzenle</button>
                                </form>
                            @endif
                            <div class="d-flex justify-content-between align-items-center"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
