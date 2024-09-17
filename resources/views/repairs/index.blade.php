@extends('template')
@section('title', 'Presupuestos')
@push('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- SweetAlert2 plugin -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        #image_path {
            width: 350px !important;
            height: 350px !important;
            object-fit: cover;
        }
        a{
            color: #d83d0e;
        }
    </style>
@endpush
@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success') }}";
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-start",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
    @endif

    <div class="container-fluid mb-4 col-12">
        <h1 class="h3 mb-3 text-gray-800">Presupuestos</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Presupuestos</li>
        </ol>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Listado de elementos</h5>
                <a href="{{ route('repairs.create') }}"><button type="button" class="btn btn-primary">CREAR UN
                        PRESUPUESTO</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>DNI</th>
                                <th>Vehículo</th>
                                <th>Tipo de reparación</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repairs as $repair)
                                <tr>
                                    <td>{{ $repair->fullname }}</td>
                                    <td>{{ $repair->dni }}</td>
                                    <td>{{ $repair->vehicle }}</td>
                                    <td>{{ $repair->type_repair }}</td>
                                    <td>${{ $repair->price }}</td>
                                    <td>
                                        @if ($repair->status == 2)
                                            <span class="fw-bolder p-1 rounded bg-success text-white">REPARADO</span>
                                        @endif
                                        @if ($repair->status == 1)
                                            <span class="fw-bolder p-1 rounded bg-warning text-white">EN PROCESO</span>
                                        @endif
                                        @if ($repair->status == 0)
                                            <span class="fw-bolder p-1 rounded bg-danger text-white">CANCELADO</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-info rounded px-4 mr-1" data-toggle="modal"
                                                data-target="#showModal-{{ $repair->id }}"><i
                                                    class="fas fa-eye"></i></button>
                                            <form action="{{ route('repairs.edit', ['repair' => $repair]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-warning rounded px-4 ml-1 mr-1"><i
                                                        class="fas fa-edit"></i></button>
                                            </form>
                                            @if ($repair->status == 1)
                                                <button class="btn btn-success rounded px-4 ml-1 mr-1" data-toggle="modal"
                                                    data-target="#confirmRepairedModal-{{ $repair->id, $repair->fullname }}"><i
                                                        class="fas fa-check-circle"></i></button>
                                                <button class="btn btn-danger rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmModal-{{ $repair->id, $repair->fullname }}"><i
                                                        class="fas fa-times-circle"></i></button>
                                            @endif
                                            @if ($repair->status == 0)
                                                <button class="btn btn-dark rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmModal-{{ $repair->id, $repair->fullname }}"><i
                                                        class="fas fa-undo-alt"></i></button>
                                            @endif
                                            @if ($repair->status == 2)
                                                <button class="btn btn-dark rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmRepairedModal-{{ $repair->id, $repair->fullname }}"><i
                                                        class="fas fa-undo-alt"></i></button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <!-- Show modal -->
                                <div class="modal fade" id="showModal-{{ $repair->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalles del presupuesto
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><span style="font-weight: bolder">Télefono del cliente:
                                                            </span>{{ $repair->phone }}
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p><span style="font-weight: bolder">Dirección del cliente:
                                                            </span>{{ $repair->location }}
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p><span style="font-weight: bolder">Detalles:
                                                            </span>
                                                            @if ($repair->details != null)
                                                                {{ $repair->details }}
                                                            @else
                                                                -
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p style="font-weight: bolder">Imagen: {{$repair->image_path}}</p>
                                                        <div class="d-flex justify-content-center">
                                                            @if ($repair->image_path != null)
                                                                <img id="image_path"
                                                                    src="{{ Storage::url('storage/repairs/' . $repair->image_path) }}"
                                                                    alt="{{ $repair->fullname }}"
                                                                    class="img-fluid img-thumbnail border-4 rounded">
                                                            @else
                                                                <img src="" alt="{{ $repair->fullname }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirmation desactive modal -->
                                <div class="modal fade" id="confirmModal-{{ $repair->id, $repair->fullname }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        @if ($repair->status == 1)
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar cancelación de
                                                        la reparación
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de cancelar la reparación del vehículo
                                                    "{{ $repair->vehicle }}" de "{{ $repair->fullname }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <form
                                                        action="{{ route('repairs.destroy', ['repair' => $repair->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" name="action" value="confirm_cancel"
                                                            class="btn btn-danger">Cancelar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @elseif($repair->status == 0 || $repair->status == 2)
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar reactivación
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de reactivar la reparación del vehículo
                                                    "{{ $repair->vehicle }}" de "{{ $repair->fullname }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <form
                                                        action="{{ route('repairs.destroy', ['repair' => $repair->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" name="action" value="confirm_restore"
                                                            class="btn btn-danger">Reactivar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <div class="modal fade" id="confirmRepairedModal-{{ $repair->id, $repair->fullname }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Confirmar reparación
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro de confirmar la reparación del vehículo
                                                "{{ $repair->vehicle }}" de "{{ $repair->fullname }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                                <form action="{{ route('repairs.destroy', ['repair' => $repair->id]) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" name="action" value="confirm_repair"
                                                        class="btn btn-danger">Confirmar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                </div>
            </div>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('js')
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
        $('#dataTable').DataTable({
            'language': {
                'url': '//cdn.datatables.net/plug-ins/2.1.6/i18n/es-MX.json',
            },
        })
    </script>
@endpush
