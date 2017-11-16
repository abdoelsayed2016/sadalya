@extends('admin.layouts.master')

@section('styles')
    <link href="{{ asset('css/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css') }}" rel="stylesheet">
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('stores.index') }}">Stores</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">Stores</strong></li>
    </ol><!-- End of order list-->

    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-10">
        </div>
        <div class="col-md-2">
            <a href="{{ route('stores.create') }}" class="btn btn-primary"><span class="fa fa-plus"></span> Add new Stores</a>
        </div>
    </div>


    <table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="vacations">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>

        @foreach($stores as $index=>$store)

            <tr>
                <td>{{ $index+1 }}</td>

                <td>{{ $store->name }}</td>
                <td>{{ $store->address }}</td>

                <td>
                    <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-primary"><span class="fa fa-edit"></span></a>

                    <a type='button' class='btn btn-danger' data-toggle='modal' data-target="#confirmation{{$store->id}}"> <span class="fa fa-trash"></span> </a>
                    <?php
                    $route=route('stores.destroy', $store->id);
                    $id= $store->id;
                    $message="Do You Want To Delete This Store ?";
                    ?>
                    @include('admin.layouts.delete')


                </td>

            </tr>

        @endforeach
        </tbody>

        <tfoot>
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