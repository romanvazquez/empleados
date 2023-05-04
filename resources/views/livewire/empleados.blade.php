<div>
    <div class="page-header">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Empleados</li>
                        </ol>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-create-employee">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Agregar
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" aria-label="Crear nuevo empleado" data-bs-toggle="modal" data-bs-target="#modal-create-employee">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <div class="mx-2 d-none d-sm-inline-block">
                            <select class="form-select" wire:model.lazy="perPage" aria-label="Mostrar cantidad de empleados">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        {{-- <div class="mx-2 d-none d-sm-inline-block">
                            <select class="form-select" wire:model.lazy="roleId" aria-label="Filtrar por rol de usuario">
                                <option value=""></option>
                                @foreach ($roles as $id => $role)

                                    <option value="{{$id}}">{{$role}}</option>
                                @endforeach

                            </select>
                        </div> --}}
                        <div class="ms-auto text-muted">
                            Buscar:
                            <div class="ms-2 d-inline-block">
                                <input type="search" class="form-control" wire:model.debounce.300ms='keyWord' aria-label="Buscar usuarios" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    <button class="table-sort {{ $field === 'ape_pat' ? $order : '' }}" wire:click="sortable('ape_pat')">Nombre</button>
                                </th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th class="d-none d-xl-table-cell">Fecha de nacimiento</th>
                                <th>Área</th>
                                <th>Puesto</th>
                                <th class="d-none d-lg-table-cell">
                                    <button class="table-sort {{ $field === 'no_empleado' ? $order : '' }}" wire:click="sortable('no_empleado')">No. Empleado</button>
                                </th>
                                <th class="d-none d-xl-table-cell">
                                    <button class="table-sort {{$field === 'estatus' ? $order : '' }}" wire:click="sortable('estatus')">Estatus</button>
                                </th>
                                <th class="d-none d-xl-table-cell">
                                    <button class="table-sort {{$field === 'fecha_contratacion' ? $order : '' }}" wire:click="sortable('fecha_contratacion')">Fecha de contratación</button>
                                </th>
                                <th class="d-none d-lg-table-cell">
                                    <button class="table-sort {{$field === 'salario' ? $order : '' }}" wire:click="sortable('salario')">Salario</button>
                                </th>
                                <th class="w-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados as $item)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $item->ape_pat." ".$item->ape_mat." ".$item->nombre }}</td>
                                    <td>{{ $item->telefono }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="d-none d-xl-table-cell">{{ isset($item->fecha_nac) ? \Carbon\Carbon::parse($item->fecha_nac)->format('d/m/Y') : 'S/F' }}</td>
                                    <td>{{ $item->area }}</td>
                                    <td>{{ $item->puesto }}</td>
                                    <td class="d-none d-lg-table-cell">{{ str_pad( $item->no_empleado, 6, "0", STR_PAD_LEFT) }}</td>
                                    <td class="d-none d-xl-table-cell">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" {{ $item->estatus ? 'checked' : '' }} wire:click="setStatus({{$item->id}}, {{$item->estatus}})">
                                        </label>
                                    </td>
                                    <td class="d-none d-xl-table-cell">{{ isset($item->fecha_contratacion) ? \Carbon\Carbon::parse($item->fecha_contratacion)->format('d/m/Y') : 'S/F' }}</td>
                                    <td class="d-none d-lg-table-cell">{{ number_format( $item->salario, 2, ".", ",") }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap d-none d-md-flex">
                                            <a href="#" class="btn btn-icon" wire:click="edit({{$item->id}})" data-bs-toggle="modal" data-bs-target="#modal-edit-employee">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg>
                                            </a>
                                            <a role="button" class="btn btn-icon bg-red" wire:click="delete({{$item->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7l16 0"></path>
                                                    <path d="M10 11l0 6"></path>
                                                    <path d="M14 11l0 6"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                </svg>
                                            </a>
                                        </div>
                                        <a role="button" class="me-2 d-block d-md-none" wire:click="edit({{$item->id}})" data-bs-toggle="modal" data-bs-target="#modal-edit-employee">
                                            Editar
                                        </a>
                                        <a role="button" class="d-block d-md-none" wire:click="delete({{$item->id}})">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted mb-3">
                        <span>{{ $empleados->total() }}</span> resultados
                    </p>

                    <div class="pagination m-0 ms-auto">

                        {{ $empleados->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="modal-create-employee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store" method="POST" id="create-employee">
                        <div class="row align-items-end">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" wire:model.defer='nombre' />
                                @error('nombre')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Apellido paterno</label>
                                <input type="text" class="form-control @error('ape_pat') is-invalid @enderror" wire:model.defer='ape_pat' />
                                @error('ape_pat')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Apellido materno</label>
                                <input type="text" class="form-control @error('ape_mat') is-invalid @enderror" wire:model.defer='ape_mat' />
                                @error('ape_mat')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control @error('fecha_nac') is-invalid @enderror" wire:model.lazy='fecha_nac' />
                                @error('fecha_nac')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" wire:model.defer='email' />
                                @error('email')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required">Teléfono</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" wire:model.defer='telefono' />
                                @error('telefono')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">No. Empleado</label>
                                <input type="text" class="form-control @error('no_empleado') is-invalid @enderror" wire:model.defer='no_empleado' />
                                @error('no_empleado')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">

                                <label class="form-label">Área</label>
                                <select class="form-select @error('area') is-invalid @enderror" wire:model.lazy="area">
                                    <option value="0"></option>
                                    <option value="Tecnologías">Tecnologías</option>
                                    <option value="Jurídico">Jurídico</option>
                                    <option value="Finanzas">Finanzas</option>
                                    <option value="RRHH">RRHH</option>
                                </select>
                                @error('area')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Fecha de contratación</label>
                                <input type="date" class="form-control @error('fecha_contratacion') is-invalid @enderror" wire:model.lazy='fecha_contratacion' />
                                @error('fecha_contratacion')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label class="form-label">Puesto</label>
                                <input type="text" class="form-control @error('puesto') is-invalid @enderror" wire:model.defer='puesto' />
                                @error('puesto')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label class="form-label">Salario</label>
                                <input type="text" class="form-control @error('puesto') is-invalid @enderror" wire:model.defer='salario' />
                                @error('puesto')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn me-auto" data-bs-dismiss="modal">Cerrar</a>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" wire:model="estatus">
                        <span class="form-check-label">Activo</span>
                    </label>
                    <button type="submit" form="create-employee" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="modal-edit-employee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update" method="POST" id="edit-employee">
                        <div class="row align-items-end">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" wire:model.defer='nombre' />
                                @error('nombre')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Apellido paterno</label>
                                <input type="text" class="form-control @error('ape_pat') is-invalid @enderror" wire:model.defer='ape_pat' />
                                @error('ape_pat')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Apellido materno</label>
                                <input type="text" class="form-control @error('ape_mat') is-invalid @enderror" wire:model.defer='ape_mat' />
                                @error('ape_mat')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control @error('fecha_nac') is-invalid @enderror" wire:model.lazy='fecha_nac' />
                                @error('fecha_nac')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" wire:model.defer='email' />
                                @error('email')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required">Teléfono</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" wire:model.defer='telefono' />
                                @error('telefono')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">No. Empleado</label>
                                <input type="text" class="form-control @error('no_empleado') is-invalid @enderror" wire:model.defer='no_empleado' />
                                @error('no_empleado')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">

                                <label class="form-label">Área</label>
                                <select class="form-select @error('area') is-invalid @enderror" wire:model.lazy="area">
                                    <option value="0"></option>
                                    <option value="Tecnologías">Tecnologías</option>
                                    <option value="Jurídico">Jurídico</option>
                                    <option value="Finanzas">Finanzas</option>
                                    <option value="RRHH">RRHH</option>
                                </select>
                                @error('area')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Fecha de contratación</label>
                                <input type="date" class="form-control @error('fecha_contratacion') is-invalid @enderror" wire:model.lazy='fecha_contratacion' />
                                @error('fecha_contratacion')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label class="form-label">Puesto</label>
                                <input type="text" class="form-control @error('puesto') is-invalid @enderror" wire:model.defer='puesto' />
                                @error('puesto')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label class="form-label">Salario</label>
                                <input type="text" class="form-control @error('puesto') is-invalid @enderror" wire:model.defer='salario' />
                                @error('puesto')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn me-auto" data-bs-dismiss="modal">Cerrar</a>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" wire:model="estatus">
                        <span class="form-check-label">Activo</span>
                    </label>
                    <button type="submit" form="edit-employee" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    <script>
        Livewire.on('cerrarModal', modalId => {
            var myModalEl = document.getElementById(modalId);
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
        });

        var createModalEl = document.getElementById('modal-create-employee')
        var editModalEl = document.getElementById('modal-edit-employee')

        createModalEl.addEventListener('hidden.bs.modal', function (event) {
            @this.call('cancel');
        });

        editModalEl.addEventListener('hidden.bs.modal', function (event) {
            @this.call('cancel');
        });

    </script>
    @endpush
</div>
