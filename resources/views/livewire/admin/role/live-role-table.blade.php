<div>
    <div class="col-md-6">
        <div class="card">
            <div style="float: inline-start;" class="mt-2 ml-2">
                @can('role create')
                <button wire:click="$emit('toogleModal')" class="btn btn-primary">
                    <i class="fas fa-plus"></i>Nuevo rol
                </button>
                @endcan

            </div>

            <div class="card-header bg-dark">

                <h6 class="rol_center">
                    Roles
                </h6>
            </div>
            <div class="card-body">
                <x-component-table>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">N° usuarios</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <h6><strong class="badge badge-pill badge-secondary">{{ $role->count_user }}</strong></h6>
                            </td>
                            <td width="20%">
                                <h6><span wire:click="$emit('toogleModal',{{ $role->id }},'Role')"
                                        class="badge badge-success th-pointer">Editar</span>
                                </h6>
                                <h6><span wire:click="$emit('addPermission',{{ $role->id }})"
                                        class="badge badge-info th-pointer">Permisos</span>
                                </h6>

                                @if (!$role->count_user && canView('role delete'))
                                <h6><span wire:click="deleteRole({{$role->id}})"
                                        class="badge badge-danger th-pointer">Eliminar</span></h6>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-component-table>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark">
                <h6 class="rol_center">
                    Permisos
                </h6>
            </div>
            <div class="card-body">
                <x-component-table>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col ">N° Roles</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($permisos as $permiso)
                        <tr>
                            <td>{{$permiso->name}}</td>
                            <td>
                                <h6><span class="badge badge-pill badge-warning rounded-full th-pointer">
                                    {{$permiso->count_user}}</td>
                            </span></h6>
                            <td width="20%">

                                @if (!$permiso->count_user)
                                <h6><span wire:click="deletePermiso({{$permiso->id}})"
                                    class="badge badge-danger th-pointer">Eliminar
                                </span></h6>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-component-table>
            </div>
        </div>

    </div>

</div>

@push('modals')
@livewire('admin.modal.role.modal-role')
@livewire('admin.modal.role.modal-permission')
@endpush

@push('scripts')
<script>
    window.addEventListener('close-modal', event => {
        $('#RoleModal').modal('hide');
    });
    window.addEventListener('open-modal', event => {
        $('#RoleModal').modal('show');
    });

    window.addEventListener('close-modal-permission', event => {
        $('#PermissionModal').modal('hide');
    });
    window.addEventListener('open-modal-permission', event => {
        $('#PermissionModal').modal('show');
    });

</script>
@endpush
