<div>
    <nav aria-label="breadcrumb breadcrumb-custom">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header ">
            <div class="row ">
                <div class="col-md-6">
                    <div class="row">
                    <div class="col-md-2   ">
                        <select wire:model="perPage" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class=" col-md-10 ">
                        <input type="text" wire:model="search" class="form-control "
                               placeholder="Busqueda por datos en general ">
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-dark color-basic " data-toggle="tooltip" data-placement="top" title="Limpiar filtros"
                            type="button" wire:click="clear">
                        <i class="fa fa-eraser"></i><span> Limpiar</span>
                    </button>

                    @can('usuario create')
                        <button class="btn btn-dark color-basic " wire:click="showModal" type="button" data-toggle="tooltip"
                                data-placement="top" title="Crear nuevo usuario">
                            <span><i class="fa fa-plus"></i> Crear Nuevo</span>
                        </button>
                    @endcan

                    <button type="button" class="btn btn-dark color-basic dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown"
                            aria-expanded="false" data-offset="10,20">
                        <i class="ti ti-export"></i>
                        @if ($selectedRows)
                            <span class="badge badge-default" style="background-color: white; color: #0f0f0f;">{{  count($selectedRows)  }}</span>
                        @endif
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item " href="{{ route('users.pdf') }}"><i class="fas fa-file-pdf"></i> PDF</a>
                        <a class="dropdown-item" wire:click.prevent="export('pdf')"><i class="fas fa-file-pdf"></i> pdf simple</a>
                        <a class="dropdown-item" wire:click.prevent="export('excel')"><i class="fas fa-file-excel"></i> XLSX</a>
                        <a class="dropdown-item" wire:click.prevent="export('csv')"><i class="fas fa-file-csv"></i> CSV</a>
                    </div>
                </div>
            </div>
        </div>



        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>
                            <input class="form-control " placeholder="nombre" type="text" wire:model="nameSearch">
                        </th>
                        <th>
                            <input class="form-control" placeholder="corre electrónico" type="text"
                                wire:model="emailSearch">
                        </th>
                        <th>
                            <select class="form-control " wire:model="user_status_id">
                                <option value="">Seleciona </option>
                                @foreach ($status as $key => $statu)
                                <option value="{{ $key }}">{{ $statu }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>

                            <select class="form-control " wire:model="user_role">
                                <option value="">Seleciona </option>
                                @foreach ($roles as $key => $role)
                                <option value="{{ $key }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th class="icon-filter">
                            <span>
                                <i class="ti ti-filter"></i>
                                Filtrar por
                            </span>
                        </th>
                    </tr>

                    <thead style="background: #2A3F54; color: white;">
                        <tr>
                            <th class="table-th text-center">
                                <div class="icheck-primary" style="height: 15px">
                                    <input wire:model="selectPageRows" type="checkbox" value="1" name="todo2"
                                        id="todoCheck2">
                                    <label for="todoCheck2"></label>
                                </div>
                            </th>

                            <th class="table-th text-center" scope="col">Imagen</th>
                            <th width="20%" wire:click="sortable('name')" class="th-pointer table-th text-center" scope="col">Nombre
                                <span class=" th-span fa fa{{ $camp === 'name' ? $icon : '-sort' }}"></span>
                            </th>

                            <th wire:click="sortable('email')" class="th-pointer table-th text-center" scope="col">Correo electrónico
                                <span class=" th-span fa fa{{ $camp === 'email' ? $icon : '-sort' }}"></span>
                            </th>
                            <th class="table-th text-center" scope="col">Estado</th>

                            <th class="table-th text-center" scope="col">Rol</th>

                            <th class="table-th text-center" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    @if ($users->count())
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="tr-custom">
                            <th style="width: 10px;">
                                <div class="icheck-primary">
                                    <input wire:model="selectedRows" type="checkbox" value="{{ $user->id }}"
                                        name="todo2" id="{{ $user->id }}">
                                    <label for="{{ $user->id }}"></label>
                                </div>
                            </th>

                            <td>
                                @if($user->profile_photo_path)
                                    <img src="{{ asset('storage/'.$user->profile_photo_path) }}" width="60px" height="60px"
                                        class="rounded-circle" alt="{{ $user->name}}">
                                @else
                                    <img src="{{ $user->profile_photo_url }} " width="60px" height="60px"
                                         class="rounded-circle" alt="{{ $user->name }}">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <h6>
                                    <span class=" badge {{ $user->user_status_id == 1 ? 'badge-success-inverse ' : 'badge-danger-inverse'}}">
                                            {{ strtoupper( $user->status_name)}}
                                    </span>
                                </h6>
                            </td>
                            <td>
                                <h6>
                                    <span class="badge badge-primary-inverse ">
                                        {{ strtoupper($user->roles()->first()->name ?? 'N/A' )}}
                                    </span>
                                </h6>
                            </td>
                            <td width="17%">
                                @can('usuario update')
                                <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                    wire:click="showModal({{ $user->id }})" data-toggle="tooltip" data-placement="top"
                                    title="Editar usuario">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endcan

                                @can('usuario delete')
                                <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                    onclick="Confirm({{ $user->id }},'delUser')" data-toggle="tooltip" data-placement="top"
                                    title="Eliminar usuario">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endcan
                                @can('usuario update')
                                <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                    wire:click="$emit('addPermission',{{ $user->id }},'user')" data-toggle="tooltip"
                                    data-placement="top" title="Editar permisos">
                                    <i class="fa fa-unlock"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                    @endif
                </table>
            </div>

            {{ $users->links() }}

            @if (($nameSearch || $emailSearch) && !$users->count())
            <div>
                No hay resultados para la búsqueda "
                @if ($nameSearch)
                {{ $nameSearch }}
                @endif
                @if ($emailSearch)
                {{ $emailSearch }}
                @endif
                " en la página {{ $page }} al mostrar {{ $perPage }} registros
            </div>
            @endif
            @if (!$users->count() && !$emailSearch && !$nameSearch)
            <div>
                No hay usuarios registradas. Registre nuevos usuarios pulsando el boton "+"
            </div>
            @endif
        </div>
    </div>
</div>

@push('modals')
@livewire('admin.modal.user.modal-user')
@livewire('admin.modal.role.modal-permission')
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        $('.select2').select2()

    });

    window.addEventListener('close-modal', event => {
        $('#UserModal').modal('hide');
    });
    window.addEventListener('open-modal', event => {
        $('#UserModal').modal('show');
    });

    window.addEventListener('close-modal-permission', event => {
        $('#PermissionModal').modal('hide');
    });
    window.addEventListener('open-modal-permission', event => {
        $('#PermissionModal').modal('show');
    });

</script>
@endpush
