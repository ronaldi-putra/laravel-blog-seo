@extends('template_frontend.home')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Postingan Terbaru</h4>
        <a href="" class="btn btn-sm btn-primary">Lihat Semua</a>
    </div>
    <div class="card-header">
        <div class="section-body">
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
                                <a href="{{ route('blog.isi', $data->slug) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection
