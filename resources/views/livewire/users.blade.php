<div>
    <div class="page-header">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                        </ol>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-create-user">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Agregar
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" aria-label="Crear nuevo usuario" data-bs-toggle="modal" data-bs-target="#modal-create-user">
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
                            <select class="form-select" wire:model.lazy="perPage" aria-label="Mostrar cantidad de usuarios">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <div class="ms-auto text-muted">
                            Buscar:
                            <div class="ms-2 d-inline-block">
                                <input type="search" class="form-control" wire:model.debounce.300ms='keyWord' aria-label="Buscar usuarios" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-sm card-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><button class="table-sort {{$field === 'clave' ? $order : '' }}" wire:click="sortable('clave')">Clave</button></th>
                                <th class="d-none d-md-table-cell"><button class="table-sort {{$field === 'created_at' ? $order : '' }}" wire:click="sortable('created_at')">Created at</button></th>
                                <th class="d-none d-md-table-cell"><button class="table-sort {{$field === 'updated_at' ? $order : '' }}" wire:click="sortable('updated_at')">Updated at</button></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{ $item->clave }}
                                    </td>
                                    <td class="d-none d-md-table-cell">{{ $item->created_at }}</td>
                                    <td class="d-none d-md-table-cell">{{ $item->updated_at }}</td>
                                    <td>
                                        <a role="button" class="me-2" wire:click="edit({{$item->id}})" data-bs-toggle="modal" data-bs-target="#modal-edit-user">
                                            Editar
                                        </a>
                                        <a role="button" class="" wire:click="delete({{$item->id}})">
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
                        <span>{{ $users->total() }}</span> resultados
                    </p>

                    <div class="pagination m-0 ms-auto">

                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal-create-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store" method="POST" id="create-user">
                        <div class="row align-items-end">
                            <div class="col-12 mb-3">
                                <label class="form-label required">Clave</label>
                                <input type="text" class="form-control @error('clave') is-invalid @enderror" wire:model.defer='clave' />
                                @error('clave')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label required">Contraseña</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model.defer='password' />
                                @error('password')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-12">
                                <label class="form-label required">Confirmar contraseña</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" wire:model.defer='password_confirmation' />
                                @error('password_confirmation')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn me-auto" data-bs-dismiss="modal">Cerrar</a>
                    <button type="submit" form="create-user" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update" method="POST" id="edit-user">
                        <div class="row align-items-end">
                            <div class="col-12 mb-3">
                                <label class="form-label required">Clave</label>
                                <input type="text" class="form-control @error('clave') is-invalid @enderror" wire:model.defer='clave' />
                                @error('clave')

                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn me-auto" data-bs-dismiss="modal">Cerrar</a>
                    <button type="submit" form="edit-user" class="btn btn-primary">Actualizar</button>
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

        var createModalEl = document.getElementById('modal-create-user')
        var editModalEl = document.getElementById('modal-edit-user')

        createModalEl.addEventListener('hidden.bs.modal', function (event) {
            @this.call('cancel');
        });

        editModalEl.addEventListener('hidden.bs.modal', function (event) {
            @this.call('cancel');
        });

    </script>
    @endpush

</div>
