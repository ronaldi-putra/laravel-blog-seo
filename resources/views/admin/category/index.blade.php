@extends('template_backend.home')
@section('subjudul','Category')
@section('content')

<div class="section-body col-8">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Category</h4>
            <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Tambah Category</a>
        </div>
        <div class="card-body">
            @if (session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}
            </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $c => $hasil)
                    <tr>
                        <th scope="row">{{ $c + $category->firstitem() }}</th>
                        <td>{{ $hasil->name }}</td>
                        <td>
                            <form action="{{ route('category.destroy', $hasil->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('category.edit', $hasil->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Apakah yakin ingin menghapus!')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $category->links() }}
        </div>
    </div>
</div>

@endsection
