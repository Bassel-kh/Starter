@include('layouts.header')
@include('layouts.navBar')

<div class=" position-ref full-height">
    <table class="table">
        <thead>
        <tr>
            <th scope="col"># Id</th>
            <th scope="col">{{__('messages.Offer Name')}}</th>
            <th scope="col">{{__('messages.Offer Price')}}</th>
            <th scope="col">{{__('messages.Offer details')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
        <tr>
            <th scope="row">{{$offer -> id}}</th>
            <td>{{$offer -> name}}</td>
            <td>{{$offer -> price}}</td>
            <td>{{$offer -> details}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
</body>
</html>
