@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/plugins/clockpicker/clockpicker.css') }}">
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        @if(auth()->user()->id ==1)

        @else
            <li><a href="{{ route('requests.index') }}">Requests</a></li>
            <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">Request Id :{{ $request->id }}</strong></li>
        @endif
    </ol><!-- End of order list-->
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">Id</label>
                <p>{{ $request->id }}</p>
            </div>
            <div class="form-group">
                <label for="name">Status</label>
                <p>@if($request->read==0) Not Read Yet @else Accepted @endif</p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Product Name</th>
                        <th>Count</th>
                    </tr>
                    @foreach($requestProducts as $requestProduct)
                        <tr>
                            <th>{{$requestProduct->product->name}}--{{$requestProduct->product->type->name}}</th>
                            <th>{{$requestProduct->count}}</th>

                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>




@endsection
