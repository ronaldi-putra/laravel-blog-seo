@extends('template_backend.home')
@section('subjudul','Post')
@section('content')

<div class="section-body col-8">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Post</h4>
        </div>
        <div class="card-body">
            @if (session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}
            </div>
            @endif
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul Post</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                        value="{{ old('judul') }}">
                    @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="categories_id" class="form-control selectric @error('content') is-invalid @enderror">
                        <option value="" holder>Pilih Category</option>
                        @foreach ($category as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    @error('categories_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pilih Tag</label>
                    <select class="form-control select2" multiple="" name="tags[]">
                        @foreach ($tag as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <input type="text" class="form-control @error('content') is-invalid @enderror" name="content"
                        value="{{ old('content') }}">
                    @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar"
                        value="{{ old('gambar') }}">
                    @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
