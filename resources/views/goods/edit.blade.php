@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['goods.update', $good->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="my-auto">{{ __('Good Details') }}</h5>
                        <div>
                            {{ Form::hidden('_method', 'PUT') }}
                            {{ Form::submit('Update', ['class' => 'btn btn-primary float-right']) }}
                            <a href="{{ url()->previous() }}" class="btn btn-secondary float-right">{{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="name">{{ __('Name') }}</label>
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
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{$good->good_name}}" required autofocus>
                                <div class="collapse" id="collapse-name">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the goods name</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="description">{{ __('Description') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-description" role="button"
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
                                <input id="description" type="text" class="form-control" name="description"
                                       value="{{$good->good_description}}" required autofocus>
                                <div class="collapse" id="collapse-description">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the goods description. Please provide detailed description to provide
                                            customers with clear overview wit the goods.</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="price">{{ __('Price (RM)') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-price" role="button"
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
                                <input id="price" type="number" class="form-control" name="price"
                                       value="{{$good->good_price}}" required autofocus>
                                <div class="collapse" id="collapse-price">
                                    <p class="text-muted"><small>This value entered in this field will be displayed as
                                            the goods price. A reasonable price will increase the willingness of
                                            customer to buy a goods.</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="category_id">{{ __('Category') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-category" role="button"
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
                                <select id="category_id" class="form-control" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if($category->id == $good->good_category_id) selected @endif>{{ $category->category_title }}</option>
                                    @endforeach
                                </select>
                                <div class="collapse" id="collapse-category">
                                    <p class="text-muted"><small>Select a category for the goods can help the customer
                                            to better navigate and find their desired item.</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="option_group">{{ __('Good Type') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-good-type" role="button"
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
                                <div class="btn-group col-md-6" role="group"
                                     aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="food_type_option" value=1
                                           id="warm_outlined" autocomplete="off" @if($good->is_warm) checked @endif>
                                    <label class="btn btn-outline-warm" for="warm_outlined">{{__('Warm')}}</label>

                                    <input type="radio" class="btn-check" name="food_type_option" value=0
                                           id="cold_outlined" autocomplete="off"
                                           @if($good->is_warm == false) checked @endif>
                                    <label class="btn btn-outline-cold" for="cold_outlined">{{__('Cold')}}</label>

                                </div>
                                <div class="collapse" id="collapse-good-type">
                                    <p class="text-muted"><small>Define a good type as warm or cold. Warm food should be
                                            prepared 30 minutes before delivery and cold type can be prepared upon
                                            delivery.</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="food_variety">{{ __('Good Variety') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-good-variety" role="button"
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
                                @if(!($varieties->isEmpty()))
                                    @foreach($varieties as $variety)
                                        <div class="form-check form-check-inline py-2">
                                            <input name="variety-checkbox-{{$variety->id}}" class="form-check-input"
                                                   type="checkbox" id="variety-checkbox-{{$variety->id}}" value="1"
                                                   @if($variety->is_available) checked @endif>
                                            <label class="form-check-label"
                                                   for="variety-checkbox-{{$variety->id}}">{{$variety->variety_name}}</label>
                                        </div>
                                    @endforeach
                                @endif()
                                <a id="trigger-new-variety" href="#">Add More Variety</a>
                                <input id="new_variety" type="text" class="form-control" name="new_good_variety"
                                       placeholder='Separate each varieties with comma ","' style="display: none">
                                <div class="collapse" id="collapse-good-variety">
                                    <p class="text-muted"><small>These are the options for the customer. They can choose
                                            the food based on these varieties.</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="option_group">{{ __('Availability') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-good-availability" role="button"
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
                                <div class="btn-group col-md-6" role="group"
                                     aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="availability_option" value=1
                                           id="available_outlined" autocomplete="off"
                                           @if($good->is_available) checked @endif>
                                    <label class="btn btn-outline-success"
                                           for="available_outlined">{{__('Available')}}</label>

                                    <input type="radio" class="btn-check" name="availability_option" value=0
                                           id="not_available_outlined" autocomplete="off"
                                           @if($good->is_available == false) checked @endif>
                                    <label class="btn btn-outline-danger"
                                           for="not_available_outlined">{{__('Unavailable')}}</label>
                                </div>
                                <div class="collapse" id="collapse-good-availability">
                                    <p class="text-muted"><small>If the goods in temporary/permanently not available,
                                            mark it as unavailable so it will not appear in user options.</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-4 col-form-label text-md-right d-flex justify-content-between">
                                <label for="image">{{ __('Image') }}</label>
                                <a class="" data-bs-toggle="collapse" href="#collapse-good-image" role="button"
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
                                <div class="mb-3">
                                    {{ Form::file('image', ['class' => 'form-control']) }}

                                    <div class="collapse" id="collapse-good-image">

                                        <p class="text-muted"><small>This is the image that will be displayed as
                                                thumbnail.</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Toggle "add-new-varieties" input field
        $(document).ready(function () {
            $('#trigger-new-variety').click(function () {
                $('#new_variety').show();
            })
        });
    </script>
    {!! Form::close() !!}

@endsection
