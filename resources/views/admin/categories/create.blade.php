@extends('admin.layouts.master')

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('categories.index') }}">Category</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">Add New categorie</strong></li>
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
            <h3 class="panel-title">Add new category</h3>
            <ul class="panel-tool-options">
                <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
            </ul>
        </div><!-- end of panel heading -->

        <div class="panel-body">

            <form action="{{ route('categories.store') }}" method="post">

                {{ csrf_field() }}

                {{ method_field('POST') }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary"><span class="fa fa-plus"></span> Add category</button>
                </div>

            </form><!-- end of form -->

        </div><!-- end of panel body -->

    </div><!-- end of panel default -->

@endsection
