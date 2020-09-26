@extends('template_backend.home')
@section('subjudul','Tag')
@section('content')

<div class="section-body col-8">
    <div class="card">
        <div class="card-header">
            <h4>Edit Tag</h4>
        </div>
        <div class="card-body">
            @if (session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}
            </div>
            @endif
            <form action="{{ route('tag.update', $tag->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>Name Tag</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $tag->name }}">
                    @error('name')
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
