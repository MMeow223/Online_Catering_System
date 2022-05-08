@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['customer.update', Auth::user()->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

    <div class="container">
        <div class="row">
            <div class="col-2">
                <nav class="navbar bg-light pt-5">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <h5 class="fw-bold text-decoration-underline">
                                Profile
                            </h5>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/customer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                    <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                                    <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                                </svg>
                                Profile Index
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.edit', Auth::user()->id ) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                    <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                                    <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                                </svg>
                                Edit Profile
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
            <div class="col-10">
                    <div class="card-body">
                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="username">{{ __('Username') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-name" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-patch-question" viewBox="0 0 16 16">
                                        <path
                                            d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"></path>
                                        <path
                                            d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"></path>
                                        <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username"
                                       value="{{Auth()->user()->username}}" required autofocus>
                                <div class="collapse" id="collapse-name">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the username</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="email">{{ __('Email') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-email" role="button"
                                   aria-expanded="false" aria-controls="collapse-email">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-patch-question" viewBox="0 0 16 16">
                                        <path
                                            d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"></path>
                                        <path
                                            d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"></path>
                                        <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{Auth()->user()->email}}" required autofocus>
                                <div class="collapse" id="collapse-email">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the email.</small></p>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="password">{{ __('Password') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-password" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-patch-question" viewBox="0 0 16 16">
                                        <path
                                            d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"></path>
                                        <path
                                            d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"></path>
                                        <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password"
                                       value="{{Auth()->user()->password}}" required autofocus>
                                <div class="collapse" id="collapse-password">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the password. Remove the encrypted password and insert new password, will be automatically encrypted too.</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="institutional_name">{{ __('Institutional Name') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-institutional_name" role="button"
                                   aria-expanded="false" aria-controls="collapse-institutional_name">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-patch-question" viewBox="0 0 16 16">
                                        <path
                                            d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"></path>
                                        <path
                                            d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"></path>
                                        <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <input id="institutional_name" type="text" class="form-control" name="institutional_name"
                                       value="{{$customer->institution_name ?? ' '}}" required autofocus>
                                <div class="collapse" id="collapse-institutional_name">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the Institutional name.</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="institutional_address">{{ __('Institutional Address') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-institutional_address" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-patch-question" viewBox="0 0 16 16">
                                        <path
                                            d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"></path>
                                        <path
                                            d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"></path>
                                        <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <input id="institutional_address" type="text" class="form-control" name="institutional_address"
                                       value="{{$customer->institution_address ?? ' '}}" required autofocus>
                                <div class="collapse" id="collapse-institutional_address">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the Institutional address.</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="phone">{{ __('Phone Number') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-phone" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-patch-question" viewBox="0 0 16 16">
                                        <path
                                            d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"></path>
                                        <path
                                            d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"></path>
                                        <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone"
                                       value="{{$customer->phone ?? ' '}}" required autofocus>
                                <div class="collapse" id="collapse-phone">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the phone number.</small></p>
                                </div>
                            </div>
                        </div>

                        {{ Form::submit('Update', ['class' => 'btn btn-primary float-right']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
