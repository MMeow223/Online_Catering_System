@extends('layouts.app')

@section('content')


<div class="container-fluid p-4 bg-warning sticky-top">
    <div class="row">

        <div class="col-3 text-center"><h1>Pinocone</h1></div>

        <div class="col-4">
            <a href="/home" class="btn btn-outline-dark m-1">Home</a>
            <a href=# class="btn btn-outline-dark m-1">Profile</a>
            <a href=# class="btn btn-outline-dark m-1">Notification</a>
            <a href=# class="btn btn-outline-dark m-1">Delivering Tab</a>
        </div>

        <div class="col-4">
            <form action="{{route('dashboard')}}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search"
                           placeholder="Search products" value="{{ request()->query('search') }}"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>

                </div>
            </form>
        </div>

        <div class="col-1"><a href=# class="btn">Cart</a></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-2">
            <nav class="navbar bg-light pt-5">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <h5>Categories</h5>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">All</a>
                        </li>
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link px-3 @if($category->id == explode('/',request()->path())[1]) fs-4 @endif {{ (request()->is('/filterCategory/'.$category->id)) ? 'fs-4' : '' }} " href="{{ route('filterCategory', $category->id) }}">{{ $category->category_title }}</a>
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
                                <img class="card-img-top" src="https://www.thespruceeats.com/thmb/TLsKoV2dAENurB0yOSUnEzHYU_4=/1333x1000/smart/filters:no_upscale()/taiwanese-beef-noodle-soup-4777014-hero-01-e06a464badec476684e513cad44612da.jpg" alt="Card image" style="width:100%">

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
