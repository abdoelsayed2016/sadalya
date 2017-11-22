@extends('admin.layouts.master')

@section('styles')
    <link href="{{ asset('css/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css') }}" rel="stylesheet">
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('store.product.index') }}">Stores</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">Stores</strong></li>
    </ol><!-- End of order list-->


    <table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="vacations">
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Store Name</th>
            <th>Count</th>

        </tr>
        </thead>

        <tbody>

        @foreach($storeProducts as $index=>$storeProduct)

            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $storeProduct->product->name }}</td>
                <th>{{$storeProduct->store->name }}</th>
                <th>{{$storeProduct->count }}</th>

            </tr>

        @endforeach
        </tbody>

        <tfoot>
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