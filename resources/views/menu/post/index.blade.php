@extends('layouts.app-auth')

@section('content')

<!-- Breadcrumb -->
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">My Posts</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        My Posts
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content Header--> <!--begin::App Content-->
<!-- End of Breadcrumb -->

<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <!-- Menampilkan pesan flash jika ada -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>


<!-- Button Add Post with Modal -->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        {{-- <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addPostModal">New Post<i class="bi bi-plus"></i></button> --}}
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary mb-2">New Post<i class="bi bi-plus ms-1"></i></a>
    </div>
</div>


<!-- Table User -->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Posts Table</h3>
                    </div>
                    <div class="card-body p-3">
                        <table class="table table-responsive-sm table-hover nowrap" id="example">
                            <thead>
                                <tr>
                                    <th width=10 class="text-center">#</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th class="text-center">Published at</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($posts as $post)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->categories_name }}</td>
                                    <td class="text-center">{{ $post->published_at }}</td>
                                    <td class="text-center">

                                        {{-- Button untuk Preview Post --}}
                                        <a class="btn badge text-bg-dark" href="{{ route('posts.show', $post->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- Button untuk membuka  Edit --}}
                                        <a class="btn badge text-bg-primary" href="{{ route('posts.edit', $post->id) }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- Tombol Delete yang memunculkan Modal Konfirmasi --}}
                                        <button class="btn badge text-bg-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                                            <i class="bi bi-trash"></i></span>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Delete (Konfirmasi) -->
                                <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">Delete post</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete the post <strong>{{ $post->name }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>

        </div>
    </div>
</div>
<!-- End of Table User -->


@endsection