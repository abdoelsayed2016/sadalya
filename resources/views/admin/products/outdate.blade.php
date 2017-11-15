@extends('admin.layouts.master')

@section('styles')
    <link href="{{ asset('css/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css') }}" rel="stylesheet">
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('products.index') }}">Products</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">Products Out Of Date</strong></li>
    </ol><!-- End of order list-->

    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-10">
        </div>
        <div class="col-md-2">
            <a href="{{ route('products.create') }}" class="btn btn-primary"><span class="fa fa-plus"></span> Add new Product</a>
        </div>
    </div>


    <table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="vacations">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Date</th>
            <th>Count</th>
        </tr>
        </thead>

        <tbody>

        @foreach($productdetails as $index=>$productdetail)

            <tr>
                <td>{{ $index+1 }}</td>

                <td>{{ $productdetail->product->name }}</td>
                <th>{{ $productdetail->product->price }}</th>
                <th>{{ $productdetail->date }}</th>
                <td>
                    {{ $productdetail->count }}
                </td>

            </tr>

        @endforeach
        </tbody>

        <tfoot>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        </tfoot>
    </table>

@endsection

@section('scripts')

    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/extensions/Buttons/js/buttons.html5.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js') }}"></script>

    <script>
        $(document).ready(function () {

            var total = $('#vacations tfoot th').length;

            $('#vacations tfoot th').each( function (index) {

                if (index !== total - 1) {

                    $(this).html('<input type="text" class="form-control" style="width: 100%" placeholder="Search" />');
                }
            } );

            var table = $('#vacations').DataTable({

                dom: '<"html5buttons" B>lTfgitp',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1 ]
                        }
                    },
                    'colvis'
                ]
            });


            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                });
            });

        });
    </script>
@endsection