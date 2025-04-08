@extends('layouts.acaraAdminPanel')

@section('heads')
    <!-- Datatable -->
    <link href="{{ asset('acaraAdminPanel/xhtml/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('acaraAdminPanel/xhtml/css/style.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
    <style>
        input[type="checkbox"]:after {
            display: none;
        }

        input[type="checkbox"]:checked:after {
            display: none;
        }
    </style>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
@endsection

@section('content')
    <div class="container-fluid">
        <x-acara.alerts />
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Clients</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Clients</h4>
                        <h4 class="card-title">
                            <a class="add-menu-sidebar" href="{{ route('admin.clients.create') }}">Create New</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display min-w850">
                                <thead>
                                    <tr>
                                        <th style="cursor: pointer" id="selections">
                                            <input type="checkbox" class="w-100" style="cursor: pointer">
                                        </th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th class="d-print-none">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr data-identifier="{{ $client->id }}">
                                            <td></td>
                                            <td>
                                                <img src="{{ Storage::disk('public')->url($client->image) }}"
                                                    style="width: 100px;">
                                            </td>
                                            <td>{{ $client->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="d-flex flex-column flex-md-row justify-content-center"
                                                    style="gap: 0.5rem">
                                                    @can('clients update')
                                                        <a href="{{ route('admin.clients.edit', $client->id) }}"
                                                            class="btn btn-sm btn-secondary">Edit</a>
                                                    @endcan
                                                    {{-- @can('clients read')
                                                        <a href="{{ route('admin.clients.show', $client->id) }}"
                                                            class="btn btn-sm btn-secondary">Show</a>
                                                    @endcan --}}
                                                    @can('clients delete')
                                                        <span class="btn btn-sm btn-danger" id="deleteButton">Delete</span>
                                                    @endcan
                                                </div>
                                            </td>
                                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="post"
                                                id="destroy-{{ $client->id }}" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.clients.bulkDelete') }}" id="deleteSelectedForm" method="POST" class="d-none">
        @csrf
        @method('DELETE')
        <input type="text" name="ids" id="ids">
    </form>
@endsection

@section('scripts')
    <!-- Datatable -->
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="{{ asset('js/sweatalert@2.1.2.js') }}"></script>

    <script>
        $(document).ready(function() {
            const exportOption = [1, 2, 3];
            const buttons = [{
                extend: 'copy',
                className: 'btn btn-xs rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'csv',
                className: 'btn btn-xs rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'excel',
                className: 'btn btn-xs rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'pdf',
                className: 'btn btn-xs rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'print',
                className: 'btn btn-xs rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                text: 'Delete',
                className: 'btn btn-xs rounded-0 btn-danger',
                action: function() {
                    checkSelectedRows()
                }
            }, ];

            const datatable = $('#datatable').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: buttons,
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    targets: 3
                }],
            });

            const selectAll = () => datatable.rows().select();
            const deselectAll = () => datatable.rows().deselect();

            const selections = document.querySelector('#selections');
            const checkbox = selections.querySelector('input');

            const checkAction = () => {
                if (checkbox.checked) {
                    checkbox.checked = false;
                    deselectAll();
                } else {
                    checkbox.checked = true;
                    selectAll();
                }
            }

            selections.addEventListener('click', () => {
                checkAction();
            });

            checkbox.addEventListener('click', () => {
                checkAction();
            });
        })
    </script>
    <script>
        // delete data
        const deleteButtons = document.querySelectorAll('#deleteButton');
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            let identifier = button.parentElement.parentElement.parentElement.dataset
                                .identifier;
                            document.querySelector(`#destroy-${identifier}`).submit()
                        } else {
                            // swal("Your data is safe!");
                        }
                    });
            })
        });
    </script>
    <script>
        // mass delete
        const checkSelectedRows = () => {
            const deleteSelectedForm = document.querySelector('#deleteSelectedForm');
            const ids = document.querySelector('#deleteSelectedForm input#ids');
            let selectedRowsArr = []
            let selectedRows = document.querySelectorAll('tr.selected');
            selectedRows.forEach(row => {
                selectedRowsArr.push(row.dataset.identifier);
            });

            @can('clients delete')
                if (selectedRowsArr.length == 0) {
                    swal({
                        title: "0 Data selected",
                        text: "Please select minimal 1 data!",
                        icon: "error",
                    });
                } else {
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover your datas!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            ids.value = selectedRowsArr;
                            deleteSelectedForm.submit();
                        } else {
                            //
                        }
                    })
                }
            @else
                swal({
                    title: "Action denied",
                    text: "You don't have permission to do this action!",
                    icon: "error",
                });
            @endcan
        }
    </script>
@endsection
