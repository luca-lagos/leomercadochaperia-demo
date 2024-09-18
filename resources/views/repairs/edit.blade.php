@extends('template')
@section('title', 'Editar presupuesto')
@push('css')
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        #details {
            resize: none !important;
            height: 390px !important;
        }

        #preview {
            width: 100%;
            height: 300px !important;
            object-fit: cover;
            border-radius: 5px;
        }
        a{
            color: #d83d0e;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid mb-4">
        <h1 class="h3 mb-3 text-gray-800">Editar presupuesto</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('repairs.index') }}">Presupuestos</a></li>
            <li class="breadcrumb-item active">Editar presupuesto</li>
        </ol>
        <div class="w-100 mt-3 border border-3 border-primary rounded p-4">
            <form action="{{ route('repairs.update', ['repair' => $repair]) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="fullname" class="form-label">Cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            </div>
                            <input type="text" name="fullname" id="fullname" class="form-control"
                                placeholder="Ingrese el nombre completo" value="{{ old('fullname', $repair->fullname) }}">
                        </div>
                        @error('fullname')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="dni" class="form-label">DNI del cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            </div>
                            <input type="number" step="any" name="dni" id="dni" class="form-control"
                                placeholder="Ingrese el DNI" value="{{ old('dni', $repair->dni) }}">
                        </div>
                        @error('dni')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="phone" class="form-label">Télefono del cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            </div>
                            <input type="number" step="any" name="phone" id="phone" class="form-control"
                                placeholder="Ingrese el teléfono" value="{{ old('phone', $repair->phone) }}">
                        </div>
                        @error('phone')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="location" class="form-label">Dirección del cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            </div>
                            <input type="text" name="location" id="location" class="form-control"
                                placeholder="Ingrese la dirección" value="{{ old('location', $repair->location) }}">
                        </div>
                        @error('location')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="vehicle" class="form-label">Vehículo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" name="vehicle" id="vehicle" class="form-control"
                                placeholder="Ingrese el vehículo" value="{{ old('vehicle', $repair->vehicle) }}">
                        </div>
                        @error('vehicle')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="type_repair" class="form-label">Tipo de reparación</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" name="type_repair" id="price" class="form-control"
                                placeholder="Ingrese el tipo de reparación" value="{{ old('type_repair',$repair->type_repair) }}">
                        </div>
                        @error('type_repair')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="price" class="form-label">Precio</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" min="1" step="any" name="price" id="price"
                                class="form-control" placeholder="Ingrese un precio" value="{{ old('price', $repair->price) }}">
                        </div>
                        @error('price')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-8 mt-3">
                        <label for="details" class="form-label">Detalles</label>
                        <textarea name="details" id="details" rows="10" class="form-control">{{ old('details', $repair->details) }}</textarea>
                        @error('details')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Imagen del vehículo</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="image_path" id="image_path" class="custom-file-input"
                                    value="{{ old('image_path', $repair->image_path) }}" accept="image/*">
                                <label for="image_path" class="custom-file-label" data-browse="Seleccionar">
                                    @if ($repair->image_path != null)
                                        {{$repair->image_path}}
                                    @else
                                    Elije una
                                    imagen
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="border rounded-lg text-center p-3">
                            @if ($repair->image_path != null)
                                <img src="{{ asset('storage/repairs/' . $repair->image_path . '') }}" id="preview" />
                            @else
                                <img src="//placehold.it/140?text=IMAGE" id="preview" />
                            @endif
                        </div>
    
                        @error('image_path')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 text-right mt-3">
                        <button type="submit" class="btn btn-primary text-center px-4 py-2">EDITAR</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        $(document).ready(function() {

            // input plugin
            bsCustomFileInput.init();

            // get file and preview image
            $("#image_path").on('change', function() {
                var input = $(this)[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })

        })
    </script>
@endpush
