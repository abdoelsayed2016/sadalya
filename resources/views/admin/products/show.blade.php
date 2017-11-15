@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/plugins/clockpicker/clockpicker.css') }}">
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('products.index') }}">Products</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">{{ $product->name }}</strong></li>
    </ol><!-- End of order list-->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Name</label>
                <span style="color:  #3c8dbc;">: {{ $product->name }}</span>
            </div>
            <div class="form-group">
                <label for="name">price</label>
                <span style="color:  #3c8dbc;">: {{ $product->price }}</span>
            </div>
            <div class="form-group">
                <label for="name">concentrate</label>
                <span style="color:  #3c8dbc;">{{ $product->concentrate }}</span>
            </div>
            <div class="form-group">
                <label for="name">company</label>
                <span style="color:  #3c8dbc;">: {{ $product->company }}</span>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="name">origin</label>
                <span style="color:  #3c8dbc;">: {{ $product->origin }}</span>
            </div>
            <div class="form-group">
                <label for="name">discount</label>
                <span style="color:  #3c8dbc;">: {{ $product->discount }}</span>
            </div>
            <div class="form-group">
                <label for="name">Category</label>
                <span style="color:  #3c8dbc;">: {{ $product->category->name }}</span>
            </div>
            <div class="form-group">
                <label for="name">Type</label>
                <span style="color:  #3c8dbc;">:
                    @if($product->type_id==1)
                        syrup
                    @elseif($product->type_id==2)
                        tablet
                    @elseif($product->type_id==3)
                        ampule
                    @elseif($product->type_id==4)
                        capsule
                    @elseif($product->type_id==5)
                        cream
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
    <table class="table table-responsive table-bordered">
        <thead>
        <tr>
            <th>Date</th>
            <th>count</th>
        </tr>
        </thead>
        <tbody >
        @foreach($productdetails as $productDetail)
            <tr>
                <th style="color:  #3c8dbc;">{{$productDetail->date}}</th>
                <th style="color:  #3c8dbc;">{{$productDetail->count}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
        </div>
    </div>



@endsection
