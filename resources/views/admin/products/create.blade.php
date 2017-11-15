@extends('admin.layouts.master')

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('products.index') }}">products</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">Add New product</strong></li>
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
            <h3 class="panel-title">Add new product</h3>
            <ul class="panel-tool-options">
                <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
            </ul>
        </div><!-- end of panel heading -->

        <div class="panel-body">

            <form action="{{ route('products.store') }}" method="post">

                {{ csrf_field() }}

                {{ method_field('POST') }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="name">Price</label>
                    <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                </div>
                <div class="form-group">
                    <label for="name">Company</label>
                    <input type="text" name="company" class="form-control" value="{{ old('company') }}">
                </div>
                <div class="form-group">
                    <label for="name">Origin</label>
                    <input type="text" name="origin" class="form-control" value="{{ old('origin') }}">
                </div>
                <div class="form-group">
                    <label for="name">Concentrate</label>
                    <input type="text" name="concentrate" class="form-control" value="{{ old('concentrate') }}">
                </div>
                <div class="form-group">
                    <label for="name">Discount</label>
                    <input type="text" name="discount" class="form-control" value="{{ old('discount') }}">
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="name">Product Type</label>--}}
                    {{--<select name="product_type_id" class="form-control">--}}
                        {{--@foreach($product_types as $product_type)--}}
                         {{--<option value="{{$product_type->id}}">{{$product_type->name}}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for="name">Type</label>
                    <select name="type_id" class="form-control">
                        <option value="1">syrup</option>
                        <option value="2">tablet</option>
                        <option value="3">ampule</option>
                        <option value="4">capsule</option>
                        <option value="5">cream</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Category</label>
                    <select name="category_id" class="form-control">
                        @foreach($categoies as $cate)
                         <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>count</th>
                            <th><button onclick="add_row()" class="btn btn-primary" type="button"><span class="fa fa-plus"></span></button></th>
                        </tr>
                        </thead>
                        <tbody id="rows">

                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <button  class="btn btn-primary"><span class="fa fa-plus"></span> Add Product</button>
                </div>

            </form><!-- end of form -->

        </div><!-- end of panel body -->

    </div><!-- end of panel default -->

@endsection
@section('scripts')
    <script>
        function add_row()
        {
            row='<tr>';
            row+='<th><input type="date" name="date[]"></th>';
            row+='<th><input type="number" name="count[]"></th>';
            row+='<th><button type="button" class="btn btn-danger" onclick="remove(this)">-</button></th>';
            row+='</tr>';
            $('#rows').append(row);
        }
        function remove(obj){
            var whichtr = $(obj).closest("tr");
            whichtr.remove();
        }
    </script>
@endsection