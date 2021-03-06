@extends('admin.layouts.master')

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('categories.index') }}">Categories</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">Edit {{ $category->name }}</strong></li>
    </ol><!-- End of order list-->

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <P>{{ $error }}</P>
            @endforeach
        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <h3 class="panel-title">Edit {{ $category->name }}</h3>
            <ul class="panel-tool-options">
                <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
            </ul>
        </div><!-- end of panel heading -->

        <div class="panel-body">

            <form action="{{ route('categories.update', $category->id) }}" method="post">

                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary"><span class="fa fa-plus"></span> Edit Category</button>
                </div>

            </form><!-- end of form -->

        </div><!-- end of panel body -->

    </div><!-- end of panel default -->

@endsection
