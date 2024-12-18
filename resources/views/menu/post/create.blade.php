@extends('layouts.app-auth')

@section('content')

<!-- Breadcrumb -->
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Add New Posts</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">My Posts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add New Post
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


<!-- Table User -->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->

            <div class="col-md-12"> <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Add New Post</div>
                    </div>

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
        
                            <div class="mb-3">
                                <label for="subheading" class="form-label">Subheading</label>
                                <input type="text" name="subheading" id="subheading" class="form-control @error('subheading') is-invalid @enderror" value="{{ old('subheading') }}" required>
                                @error('subheading')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
        
                            {{-- <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
        
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    {{-- <option value="user" {{ old('category_id') == 'user' ? 'selected' : '' }}>User</option> --}}
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->categories_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
        
                            {{-- <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            {{-- Text Editor Summernote --}}
                            <div class="mb-3">
                                <label for="summernote" class="form-label">Content</label>
                                {{-- <input type="text" name="content" id="summernote" class="form-control @error('content') is-invalid @enderror" value="{{ old('content') }}" required> --}}
                                <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>

                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> 
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> <!--end::Footer-->
                    </form> <!--end::Form-->

                </div> <!--end::Quick Example--> <!--begin::Input Group-->
            </div>
        </div>
    </div>
</div>
<!-- End of Table User -->


@endsection