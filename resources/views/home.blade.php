@extends('layouts.app')

@section('content')





<div class="container">
    <div class="row">
        <div class="col-2">
            <nav class="navbar bg-light pt-5">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <h5 class="fw-bold text-decoration-underline">
                                Categories
                            </h5>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                    <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                                    <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                                </svg>
                                All Categories
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="nav-item d-flex justify-content-start">
                                <a class="nav-link px-3 @if($category->id == explode('/',request()->path())[1]) fs-4 @endif {{ (request()->is('/filterCategory/'.$category->id)) ? 'fs-4' : '' }} " href="{{ route('filterCategory', $category->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                        <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                                        <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                                    </svg>
                                    {{ $category->category_title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
            </nav>
        </div>

        <div class="col-10">

            <h1 class="row m-3">Show result(s) of @if(request()->is('/')) All Category  @else "{{$current_category_name}}" @endif</h1>

            <div class="row">
                @forelse ($products as $product)
                    <div class="col-3 ">
                        <a href="#" class="d-inline text-decoration-none">
                            <div class="card m-3 shadow">
                                {{--                                <img class="card-img-top" src="https://www.thespruceeats.com/thmb/TLsKoV2dAENurB0yOSUnEzHYU_4=/1333x1000/smart/filters:no_upscale()/taiwanese-beef-noodle-soup-4777014-hero-01-e06a464badec476684e513cad44612da.jpg" alt="Card image" style="width:100%">--}}
                                <img class="card-img-top" src="{{url("/images/$product->good_image")}}" alt="Image of {{ $product->good_name }}" style="width:100%">

                                <div class="card-body">
                                    <h4 class="card-title text-black">{{ $product->good_name }}</h4>
                                    <p class="card-text text-black">{{ $product->good_description }}</p>
                                    <p class="card-text text-black">RM{{ $product->good_price }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div>
                        <img src="/images/no-results.png" class=" mx-auto d-block pt-5" style="max-width: 10%">
                        <h1 class="text-center pt-5">
                            No results found
                        </h1>
                        <p class="text-center text-muted">
                            Try different or more general keywords
                        </p>
                    </div>
                @endforelse
                <span>
                    {{$products->appends(['search' => request() -> query('search')])->links('pagination::bootstrap-5') }}
                </span>
            </div>
        </div>
    </div>

</div>

<hr>
<div class="container bg-light p-5 ">
    <div class="row justify-content-around" >
        <div class="col-sm-4 bg-light p-0">
            <div class="text-secondary row">
                <h5>Dashboard</h5>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Navigation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Delivering Tab</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-sm-4 bg-light p-0">
            <div class="text-secondary row">
                <h5>About Pinocone</h5>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Policies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Disclaimer</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="col-sm-4 bg-light p-0">
            <div class="text-secondary row"><h5>Payment</h5></div>

        </div>
    </div>
</div>
<hr>
<div class="container bg-light px-4 ">
    <div class="row justify-content-around">
        <p>© 2022 Pinocone. All Rights Reserved.</p>
    </div>
</div>
@endsection
