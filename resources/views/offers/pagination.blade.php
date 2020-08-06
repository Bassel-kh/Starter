@include('layouts.header')
@include('layouts.navBar')

<div class=" position-ref full-height ">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
        @if(Session::has('error'))
            <div class="alert alert-success" role="alert">
                {{Session::get('error')}}
            </div>
        @endif
    <table class="table ">
        <thead>
        <tr>
            <th scope="col"># Id</th>
            <th scope="col">{{__('messages.Offer Name')}}</th>
            <th scope="col">{{__('messages.Offer Price')}}</th>
            <th scope="col">{{__('messages.Offer details')}}</th>
            <th scope="col">{{__('messages.Offer Photo')}}</th>
            <th scope="col">{{__('messages.operation')}}</th>

        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr>
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td>{{$offer -> details}}</td>
                <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <td>
                <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success">{{__('messages.update')}}</a>
                <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger">{{__('messages.delete')}}</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $offers -> links() !!}
    </div>
</div>
</body>
</html>
