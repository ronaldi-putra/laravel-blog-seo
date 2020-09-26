@extends('template_frontend.home')

@section('content')
<div class="section-body">
    <h2 class="section-title">Postingan Terbaru</h2>
    <div class="row">
        @foreach ($data as $data)
        <div class="col-12 col-md-4 col-lg-4">
            <article class="article article-style-c">
                <div class="article-header">
                    <img src="{{ $data->gambar }}" data-background="{{ $data->gambar }}" class="article-image">
                </div>
                <div class="article-details">
                    <div class="article-category"><a href="#">{{ $data->category->name }}</a>
                        <div class="bullet"></div> <a href="#">{{ $data->created_at->diffForHumans() }}</a>
                    </div>
                    <div class="article-title">
                        <h2><a href="#">{{ $data->judul }}</a></h2>
                    </div>
                    <div class="article-user">
                        <img alt="image" src="{{ asset('public/assets/img/avatar/avatar-1.png') }}">
                        <div class="article-user-details">
                            <div class="user-detail-name">
                                <a href="#">{{ $data->user->name }}</a>
                            </div>
                            <div class="text-job">
                                @if ($data->user->role == 1)
                                Administrator
                                @else
                                Penulis
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="article-cta mt-2">
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </article>
        </div>
        @endforeach
    </div>
</div>

@endsection
