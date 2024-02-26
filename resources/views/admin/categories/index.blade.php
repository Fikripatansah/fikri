@extends('admin.layout')
@section('content')
<div class="card">
    <div class="card-body">
        <a href="/categories/create" class="btn btn-success">+ Kategori</a>


        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Aksi</th>
                </tr>

                @foreach ($Categories as $category)
                <tr >
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->title }}</td>
                    <td class="d-flex">
                        <a href="/categories/{{ $category->id }}/edit" class="btn btn-warning me-2">
                            <i data-feather="edit"></i>Edit
                        </a>

                        <form action="/categories/{{ $category->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"  onclick="return confirm('Apakah Anda Yakin?')">
                                <i data-feather="trash"></i>Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection