@extends('template_frontend.home')

@section('content')
<div class="card card-primary">
    @foreach ($data as $dt)
    <div class="card-header">
        <h4>{{ $dt->judul }}</h4>
        <div class="card-header-action">
            Category :
            <a href="#" class="badge badge-primary">
                {{ $dt->category->name}}
            </a>
        </div>
    </div>
    <div class="card-body">
        <img src="{{ asset($dt->gambar) }}" class="img-fluid mb-2" width="500px" height="360px">
        <hr>
        <p>{{ $dt->content }}</p>
    </div>
    <div class="card-footer">
        <div class="article-user-details">
            <div class="badge badge-primary">
                {{ $dt->user->name }}
            </div>
            <div class="badge badge-info">
                @if ($dt->user->role == 1)
                Administrator
                @else
                Penulis
                @endif
            </div>
            <div class="badge badge-warning">
                {{ $dt->created_at }}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
