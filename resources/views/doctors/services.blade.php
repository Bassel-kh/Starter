@extends('layouts.app')
@section('content')
    <div class="container w-50 p-3">


        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    الخدمات

                </div>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($services) && $services -> count() > 0)
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service -> id }}</td>
                                <td>{{ $service -> name }}</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
                <form method="POST" action="{{ route('save.doctors.services') }}">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                    <div class="form-group">
                        <label for="exampleInputEmail1">أختر طبيب</label>
                        <select class="form-control" name="doctor_id" >
                            @if(isset($doctors) && $doctors -> count() > 0)
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>
                            @endforeach
                                @endif
                        </select>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">أختر الخدمات </label>

                        <select class="form-control" name="servicesIds[]" multiple>
                            @if(isset($allServices) && $allServices -> count() > 0)
                            @foreach($allServices as $allService)
                                <option value="{{$allService -> id}}">{{$allService -> name}}</option>
                            @endforeach
                                @endif
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>

            </div>
        </div>
@stop
