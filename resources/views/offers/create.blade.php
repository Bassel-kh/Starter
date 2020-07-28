@include('layouts.header')
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                        <span class="sr-only">(current)</span></a>
                </li>
            @endforeach

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
{{--//////////////////////////////////////////////////////////////////////////////////--}}

    <div class="content">
        <div class="title m-b-md">
            {{__('messages.Add your offer')}}
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                تم إضافة العرض بنجاح!
            </div>
        @endif
        {{--                <form method = "POST" action="{{ url('offer\store') }}">--}}
        <form method = "POST" action="{{ route('offer.store') }}">

            @csrf
            {{--<input name="_token" value="{{ csrf_token() }}">--}}

            <div class="form-group">
                <label for="OfferName">{{__('messages.Offer Name')}}</label>
                <input type="text" class="form-control"name="name"  placeholder="{{__('messages.Offer Name')}}">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="OfferPrice">{{__('messages.Offer Price')}}</label>
                <input type="text" class="form-control" name="price" placeholder="{{__('messages.Offer Price')}}">
                @error('price')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="OfferDetails">{{__('messages.Offer details')}}</label>
                <input type="text" class="form-control" name="details" placeholder="{{__('messages.Offer details')}}">
                @error('details')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}} </button>
        </form>

    </div>
</div>
</body>
</html>
