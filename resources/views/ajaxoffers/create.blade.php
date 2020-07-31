@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;" >
            تم الحفظ بنجاح
        </div>

        <div class="flex-center position-ref full-height">
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
                <form method = "POST" id="offerForm" action="" enctype="multipart/form-data">

                    @csrf
                    {{--<input name="_token" value="{{ csrf_token() }}">--}}
                    <div class="form-group">
                        <label for="OfferName">{{__('messages.offer select image')}}</label>
                        <input type="file" class="form-control"name="photo"  >
                        @error('photo')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="OfferName">{{__('messages.Offer Name ar')}}</label>
                        <input type="text" class="form-control"name="name_ar"  placeholder="{{__('messages.Offer Name')}}">
                        @error('name_ar')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="OfferName">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control"name="name_en"  placeholder="{{__('messages.Offer Name')}}">
                        @error('name_en')
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
                        <label for="OfferDetails">{{__('messages.Offer details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" placeholder="{{__('messages.Offer details')}}">
                        @error('details_ar')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="OfferDetails">{{__('messages.Offer details en')}}</label>
                        <input type="text" class="form-control" name="details_en" placeholder="{{__('messages.Offer details')}}">
                        @error('details_en')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}} </button>
                </form>

            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).on('click','#save_offer', function (e) {
                e.preventDefault();

                var formData = new FormData($('#offerForm')[0])
                $.ajax({
                    type:'post',
                    enctype:"multipart/form-data",
                    url:"{{route('ajax.offers.store')}}",
                    data: formData ,
                    processData: false,
                    contentType: false,
                    cache:false,
                    success: function (data) {
                        if(data.status == true)
                            // alert(data.msg);
                            $('#success_msg').show();
                    },
                    error: function (reject) {
                    }

                })
            });
        </script>
    @stop
@stop
