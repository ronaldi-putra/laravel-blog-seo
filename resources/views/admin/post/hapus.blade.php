@extends('template_backend.home')
@section('subjudul','Post')
@section('content')

<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Post Yang Dihapus</h4>
            <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary">Tambah Post</a>
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
                        <th scope="col">judul</th>
                        <th scope="col">Category</th>
                        <th scope="col">Tag</th>
                        <th scope="col">Content</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $p => $hasil)
                    <tr>
                        <th scope="row">{{ $p + $post->firstitem() }}</th>
                        <td>{{ $hasil->judul }}</td>
                        <td>{{ $hasil->category->name }}</td>
                        <td>
                            @foreach ($hasil->tag as $tag )
                            <ul>
                                <li>
                                    {{ $tag->name }}
                                </li>
                            </ul>
                            @endforeach
                        </td>
                        <td>{{ $hasil->content }}</td>
                        <td><img src="{{ asset($hasil->gambar) }}" alt="Gambar Rusak" class="img-fluid"
                                style="width: 100px"></td>
                        <td>
                            <form action="{{ route('post.kill', $hasil->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('post.restore', $hasil->id) }}"
                                    class="btn btn-sm btn-warning">Restore</a>
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Apakah yakin ingin menghapus!')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $post->links() }}
        </div>
    </div>
</div>

@endsection
