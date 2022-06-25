<div class="row">

    <div class="col-md-6 mr-0">
        <div class="card">
            <div class="card-header thead-basic" >
                <h5 class="rol_center text-center " >
                    Roles
                </h5>
            </div>
            <div class="card-body">
                <div style="float: left; padding-bottom: 4px;"  >
                    @can('role create')
                        <button wire:click="$emit('toogleModal')" class="btn btn-dark color-basic">
                            <i class="fa fa-plus"></i>Nuevo rol
                        </button>
                    @endcan

                </div>

                <x-component-table>
                    <thead class="thead-basic">
                        <tr>
                            <th width="40%" class="table-th" scope="col">Name</th>
                            <th width="20%" class="table-th text-center" scope="col">N° usuarios</th>
                            <th width="40%" class="table-th text-center" scope="col">Accion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <h6><strong class="badge badge-pill badge-dark-inverse">{{ $role->count_user }}</strong></h6>
                            </td>
                            <td width="20%">
                                <h6><span wire:click="$emit('toogleModal',{{ $role->id }},'Role')"
                                        class="badge badge-dark color-basic th-pointer">Editar</span>
                                    <span wire:click="$emit('addPermission',{{ $role->id }})"
                                          class="badge badge-dark color-basic th-pointer">Permisos</span>
                                    @if (!$role->count_user && canView('role delete'))
                                    <span wire:click="deleteRole({{$role->id}})"
                                          class="badge  badge-dark color-basic th-pointer">Eliminar</span>
                                    @endif

                                </h6>
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
            <div class="card-header thead-basic" >
                <h6 class="rol_center text-center " >
                    Permisos
                </h6>
            </div>
            <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <x-component-table>
                    <thead class="thead-basic">
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
                                <h6><span class="badge badge-pill badge-primary-inverse">
                                    {{$permiso->count_user}}</td>
                                </span></h6>
                            <td width="20%">

                                @if (!$permiso->count_user)
                                <h6><span wire:click="deletePermiso({{$permiso->id}})"
                                    class="badge badge-dark color-basic-2 th-pointer">Eliminar
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
