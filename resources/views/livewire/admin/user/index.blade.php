<div>
    <nav aria-label="breadcrumb breadcrumb-custom">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
        </ol>
    </nav>

    <div class="card">

        <div class="card-header">
            <div class="col-md-1  col-sm-2 ">
                <select wire:model="perPage" class="form-control">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="form-group col-md-4 col-sm-10 search">
                <input type="text" wire:model="search" class="form-control "
                    placeholder="Busqueda por datos en general ">
            </div>

            <button class="btn btn-secondary " data-toggle="tooltip" data-placement="top" title="Limpiar filtros"
                type="button" wire:click="clear">
                <i class="fas fa-eraser"></i><span> Limpiar</span>
            </button>

            @can('usuario create')
            <a class="btn btn-dark " wire:click="showModal" type="button" data-toggle="tooltip" data-placement="top"
                title="Crear nuevo usuario">
                Crear Nuevo
            </a>
            @endcan


        </div>



        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th></th>

                        <th></th>

                        <th>
                            <input class="form-control" placeholder="nombre" type="text" wire:model="nameSearch">
                        </th>

                        <th>
                            <input class="form-control" placeholder="corre electronico" type="text"
                                wire:model="emailSearch">
                        </th>

                        <th>
                            <select class="form-control " wire:model="user_status_id">
                                <option value="">Seleciona estado</option>
                                @foreach ($status as $key => $statu)
                                <option value="{{ $key }}">{{ $statu }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th>

                            <select class="form-control " wire:model="user_role">
                                <option value="">Seleciona Rol</option>
                                @foreach ($roles as $key => $role)
                                <option value="{{ $key }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th class="icon-filter">
                            <span>
                                <i class="fas fa-filter"></i>
                                Filtrar por
                            </span>
                        </th>
                    </tr>

                    <thead class="thead-light">
                        <tr>
                            <th width="60px" wire:click="sortable('id')" class="th-pointer" scope="col">id
                                <span class=" th-span fas fa{{ $camp === 'id' ? $icon : '-sort' }} "></span>
                            </th>

                            <th scope="col">Imagen</th>
                            <th width="25%" wire:click="sortable('name')" class="th-pointer" scope="col">Nombre
                                <span class=" th-span fas fa{{ $camp === 'name' ? $icon : '-sort' }}"></span>
                            </th>

                            <th wire:click="sortable('email')" class="th-pointer" scope="col">Correo electrónico
                                <span class=" th-span fas fa{{ $camp === 'email' ? $icon : '-sort' }}"></span>
                            </th>
                            <th scope="col">Estado</th>

                            <th scope="col">Rol</th>

                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    @if ($users->count())
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="tr-custom">

                            <td>{{ $user->id }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $user->image_user) }}" width="60px" height="60px"
                                    class="rounded-circle" alt="{{ $user->name }}">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->user_status->name }}</td>
                            <td>
                                <span class="badge badge-success">{{ $user->roles()->first()->name ?? 'N/A' }}</span>
                            </td>
                            <td width="17%">
                                @can('usuario update')
                                <a href="javascript:void(0)" class="btn btn-primary"
                                    wire:click="showModal({{ $user->id }})" data-toggle="tooltip" data-placement="top"
                                    title="Editar usuario">
                                    <i class="far fa-edit"></i>
                                </a>
                                @endcan

                                @can('usuario delete')
                                <a href="javascript:void(0)" class="btn btn-danger"
                                    wire:click="deleteUser({{ $user->id }})" data-toggle="tooltip" data-placement="top"
                                    title="Eliminar usuario">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endcan
                                @can('usuario update')
                                <a href="javascript:void(0)" class="btn btn-info"
                                    wire:click="$emit('addPermission',{{ $user->id }},'user')" data-toggle="tooltip"
                                    data-placement="top" title="Editar permisos">
                                    <i class="fa fa-unlock-keyhole"></i>
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
