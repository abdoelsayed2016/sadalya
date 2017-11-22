@extends('admin.layouts.master')
@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('requests.index') }}">Request</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">Add New Requests</strong></li>
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
            <h3 class="panel-title">Add new Request</h3>
            <ul class="panel-tool-options">
                <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
            </ul>
        </div><!-- end of panel heading -->

        <div class="panel-body">

            <form action="{{ route('requests.store') }}" method="post">

                {{ csrf_field() }}

                {{ method_field('POST') }}

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-10">
                            <label for="name">Products</label>
                            <select class="form-control" id="product_id">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}--{{$product->type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" onclick="add()" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-responsive table-striped" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>count</th>
                        </tr>
                    </thead>
                    <tbody id="rows">

                    </tbody>

                </table>


                <div class="form-group">
                    <button class="btn btn-primary"><span class="fa fa-plus"></span> Add Request</button>
                </div>

            </form><!-- end of form -->

        </div><!-- end of panel body -->

    </div><!-- end of panel default -->

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#product_id').select2();
            $('.select2-selection__choice').css('background-color', 'red');
        });
        function add()
        {
            tr="<tr>";
            tr+="<th>"+$("#product_id").find(":selected").text()+"<input type='hidden' name='product_id[]' value='"+$("#product_id").val()+"'></th>"
            tr+="<th><input class='form-controll' name='count[]'></th>";
            $("#rows").append(tr);

        }
    </script>
@endsection