@extends('layouts.app-auth')

@section('content')

<!-- Breadcrumb -->
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">User Management</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        User Management
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


<!-- Button Add User with Modal -->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addUserModal">Add<i class="bi bi-plus"></i></button>
    </div>
</div>


<!-- Table User -->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">User Table</h3>
                        <div class="card-tools">
                            <ul class="pagination pagination-sm float-end">
                                <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                                <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                                <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                                <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                                <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
                            </ul>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $users as $user )
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <!-- Jika gambarnya ada -->
                                        @if ($user->image)
                                            <img src="{{ URL::asset('storage/img/users/' . $user->image) }}" alt="{{ $user->image }}" style="width: 70px; height: 70px; object-fit: cover;">
                                        <!-- kalo gada gambarnya dibuat static -->
                                        @else
                                            <img src="{{ URL::asset('storage/img/users/user_image.png') }}" alt="Default Image" style="width: 70px; height: 70px; object-fit: cover;">
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        <span class="badge 
                                            {{ $user->status == 'verified' ? 'text-bg-success' : 
                                            ($user->status == 'not_verified' ? 'text-bg-warning' : 
                                            ($user->status == 'block' ? 'text-bg-danger' : 'bg-secondary')) }}">
                                            {{ $user->status }}
                                        </span>
                                    </td>


                                    <td class="text-center">
                                        <!-- <a href="{{ route('users.edit', $user->id) }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}"><span class="badge text-bg-primary"><i class="bi bi-pencil"></i></span></a> -->

                                        <!-- Button untuk membuka modal Edit -->
                                        <button class="btn badge text-bg-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                            <i class="bi bi-pencil"></i></span>
                                        </button>

                                        <!-- <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn badge text-bg-danger"><span class=""><i class="bi bi-trash"></i></span></button>
                                        </form> -->

                                        <!-- Tombol Delete yang memunculkan Modal Konfirmasi -->
                                        <button class="btn badge text-bg-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                            <i class="bi bi-trash"></i></span>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="role" class="form-label">Role</label>
                                                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                                            @php
                                                                $roles = $user->role;
                                                            @endphp

                                                            <option value="superadmin" {{ $roles == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                                            <option value="admin" {{ $roles == 'admin' ? 'selected' : '' }}>Admin</option>
                                                            <option value="user" {{ $roles == 'user' ? 'selected' : '' }}>User</option>
                                                        </select>
                                                        @error('role')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Image</label>
                                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" value="{{ $user->image }}">
                                                        @error('image')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                            {{-- @php
                                                                $status = $user->status;
                                                            @endphp --}}

                                                            @if ($user->status == "verified")
                                                                <option value="verified" selected>Verified</option>
                                                                <option value="not_verified" >Not Verified</option>
                                                                <option value="block" >Block</option>
                                                            @elseif($user->status == "not_verified")
                                                                <option value="verified">Verified</option>
                                                                <option value="not_verified" selected>Not Verified</option>
                                                                <option value="block">Block</option>
                                                            @else
                                                                <option value="verified">Verified</option>
                                                                <option value="not_verified" >Not Verified</option>
                                                                <option value="block" selected>Block</option>
                                                            @endif

                                                            {{-- <option value="verified" {{ $user->status == 'verified' ? 'selected' : '' }}>Verified</option>
                                                            <option value="not_verified" {{ $user->status == 'not_verified' ? 'selected' : '' }}>Not Verified</option>
                                                            <option value="block"  {{ $user->status == 'block' ? 'selected' : '' }}>Block</option> --}}
                                                        </select>
                                                        @error('status')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                    <button type="submit" class="btn btn-primary">Update User</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal Edit -->


                                <!-- Modal Delete (Konfirmasi) -->
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Delete user</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete the user <strong>{{ $user->name }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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


<!-- Modal for adding new user -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection