@extends('layouts.app-auth')

@section('content')

<!-- Breadcrumb -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
{{-- End of Breadcrumb --}}

<div class="app-content">
    <div class="container-fluid">

        {{-- Cards Dashboard --}}
        <div class="row">

            {{-- Card My Post --}}
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $countPost }}</h3>
                        <p>My Posts</p>
                    </div> 
                    
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8.414a2 2 0 0 0-.586-1.414l-4.414-4.414A2 2 0 0 0 14.414 2H6zm8 7a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h5a1 1 0 0 1 1 1zm0 4a1 1 0 0 1-1 1H8a1 1 0 1 1 0-2h5a1 1 0 0 1 1 1zm-1 4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1z" />
                    </svg>
                    

                    <a href="{{ route('posts.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
            {{-- End of Card My Post --}}


            {{-- Card Category --}}
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $countCategory }}<sup class="fs-5"></sup></h3>
                        <p>Categories</p>
                    </div> 
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M4 2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4zm10 0a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2h-6a2 2 0 0 1-2-2V4zm0 14a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2h-6a2 2 0 0 1-2-2v-6zm-10 0a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H4z" />
                    </svg>
                    
                    <a href="{{ route('category.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
            {{-- End of Card Category --}}


            {{-- Card User Registrations only for Superadmin Role & Admin Role --}}
            @if(auth()->user()->role === "superadmin" | auth()->user()->role === "admin")

                {{-- Card User Registrations --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $countUser }}</h3>
                            <p>User Registrations</p>
                        </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                        </svg> <a href="{{ route('users.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i> </a>
                    </div>
                </div>
                {{-- End of Card User Registrations --}}
                

                {{-- Card Unique Visitors --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>{{ $countAllPosts }}</h3>
                            <p>All Posts</p>
                        </div> 

                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M4 3a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1h4a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2V3zm2 1v1h8V4H6zm-1 3v12h14V6h-3v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V6zm2 0v2h8V6H7z" />
                        </svg>
                        

                        <a href="{{ route('all-posts.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i> </a>
                    </div>
                </div>
                {{-- End of Unique Visitors --}}

            @endif

        </div>
        {{-- End of Cards Dashboard --}}

    </div>
</div>

@endsection