@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2">
                <nav class="navbar bg-light pt-5">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <h5 class="fw-bold text-decoration-underline">
                                Notification
                            </h5>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                    <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                                    <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                                </svg>
                                All type
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>

            <div class="col-10">
                @foreach($notifications as $notification)
                    @if($notification->notification_type_id == 3)
                        <div class="container border border-1 border-secondary">
                            <a onclick="{{route()}}">//popMsg("You have successfully claimed the voucher!")
                                <div class="row">
                                    <img src="{{url("/images/$notification->notification_image")}}" class=" mx-auto d-block pt-5" style="max-width: 10%">
                                    <h4>{{ $notification->notification_title }}</h4>
                                    <p>{{ $notification->notification_description }}</p>
                                </div>
                            </a>
                        </div>
                    @elseif($notification->notification_type_id == 1)
                        <div class="container border border-1 border-secondary">
                            <a onclick="{{route('')}}">
                                <div class="row">
                                    <img src="{{url("/images/$notification->notification_image")}}" class=" mx-auto d-block pt-5" style="max-width: 10%">
                                    <h4>{{ $notification->notification_title }}</h4>
                                    <p>{{ $notification->notification_description }}</p>
                                </div>
                            </a>
                        </div>
                    @elseif($notification->notification_type_id == 2)
                        <div class="container border border-1 border-secondary">
                            <a onclick="{{route('home')}}">
                                <div class="row">
                                    <img src="{{url("/images/$notification->notification_image")}}" class=" mx-auto d-block pt-5" style="max-width: 10%">
                                    <h4>{{ $notification->notification_title }}</h4>
                                    <p>{{ $notification->notification_description }}</p>
                                </div>
                            </a>
                        </div>
                    @elseif($notification->notification_type_id == 4)
                        <div class="container border border-1 border-secondary">
                            <a onclick="{{route('')}}">
                                <div class="row">
                                    <img src="{{url("/images/$notification->notification_image")}}" class=" mx-auto d-block pt-5" style="max-width: 10%">
                                    <h4>{{ $notification->notification_title }}</h4>
                                    <p>{{ $notification->notification_description }}</p>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
    </div>
@endsection
