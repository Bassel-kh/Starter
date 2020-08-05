@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    المستشفيات

                </div>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">address</th>
                        <th scope="col">الاجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($hospitals) && $hospitals -> count() > 0)
                        @foreach($hospitals as $hospital)
                        <tr>
                            <td>{{ $hospital -> id }}</td>
                            <td>{{ $hospital -> name }}</td>
                            <td>{!! $hospital -> address !!}</td>
                            <td><a href="{{route('hospitals.doctors', $hospital -> id )}}" class="btn btn-success"> عرض الأطباء</a></td>
                        </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
@stop
