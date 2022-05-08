<div>
    <form wire:submit.prevent="{{$method}}" >
        <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
                           :classModalDialog="$classModalDialog" :classSize="$classSize">
            <div class="input-group col-md-12">

                @if($this->active_category_update)
                    <div class="form-group">
                        <input wire:model="name_update" id="name_update" type="text" class="form-control " placeholder="nombre categoria">
                    </div>
                    <span class="input-group-btn pl-2">
                            <button class="btn btn-dark" wire:click.prevent="editCategory"><i class="fa fa-floppy-disk"></i></button>
                            <button class="btn btn-danger" wire:click.prevent="cancelAddCategory"><i class="fa fa-xmark"></i></button>
                        </span>
                @else
                    @if($this->active_category_add )
                        <div class="form-group">
                            <input wire:model="name" id="name" type="text" class="form-control " placeholder="nombre categoria">
                        </div>
                        <span class="input-group-btn pl-2">
                            <button class="btn btn-dark" wire:click.prevent="addCategory"><i class="fa fa-floppy-disk"></i></button>
                            <button class="btn btn-danger" wire:click.prevent="cancelAddCategory"><i class="fa fa-xmark"></i></button>
                        </span>
                    @else
                        <span class="input-group-btn">
                            <button class="btn btn-success" wire:click.prevent="activeAddCategory"><i class="fa fa-plus"></i></button>
                        </span>
                    @endif
                @endif
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                @if($categories->count())
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info"
                                   wire:click="activeUpdateCategory({{ $category->id }})" data-toggle="tooltip" data-placement="top"
                                   title="Editar categoria">
                                    <i class="far fa-edit"></i>
                                </a>

                                <a href="javascript:void(0)" class="btn btn-danger"
                                   wire:click="deleteBrand({{ $category->id }})" data-toggle="tooltip" data-placement="top"
                                   title="Eliminar categoria">
                                    <i class="fa fa-trash"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </x-component-modal>
    </form>
</div>
