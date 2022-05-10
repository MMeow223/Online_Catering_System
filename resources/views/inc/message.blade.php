@if (count($errors) > 0)

    <a href="{{Request::url()}}" class="top-0 fixed-top text-decoration-none d-flex" style="height: 100vh;background-color: rgba(0,0,0,.40)">


{{--        <div class="row">--}}
            @foreach ($errors->all() as $error)
{{--                <div class="align-self-center" style="">--}}
                    <div class="alert alert-danger w-25 m-auto align-self-center">
                        {{ $error }}
                    </div>
{{--                </div>--}}
            @endforeach
{{--        </div>--}}

    </a>

@endif

@if (session('success'))
    <a href="{{Request::url()}}" class="top-0 fixed-top text-decoration-none" style="height: 100vh;background-color: rgba(0,0,0,.40)">

        <div class="alert alert-success w-25 text-center m-auto top-50 ">
            {{ session('success') }}
        </div>
    </a>
@endif

@if (session('error'))

    <a href="{{Request::url()}}" class="top-0 fixed-top text-decoration-none" style="height: 100vh;background-color: rgba(0,0,0,.40)">

        <div class="alert alert-danger w-25 text-center m-auto top-50 ">
            {{ session('error') }}
        </div>
    </a>
@endif
