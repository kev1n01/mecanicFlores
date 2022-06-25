<div>
    <form wire:submit.prevent="{{$method}}" >
        <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
                           :classModalDialog="$classModalDialog" :classSize="$classSize">
            <div class="input-group col-md-12">

                    @if($this->active_brand_update)
                        <div class="form-group">
                            <input wire:model="name_update" id="name_update" type="text" class="form-control " placeholder="nombre marca">
                        </div>
                        <span class="input-group-btn pl-2">
                            <button class="btn btn-dark" wire:click.prevent="editBrand"><i class="fa fa-floppy-o"></i></button>
                            <button class="btn btn-danger" wire:click.prevent="cancelAddBrand"><i class="fa fa-close"></i></button>
                        </span>
                    @else
                        @if($this->active_brand_add )
                            <div class="form-group">
                                <input wire:model="name" id="name" type="text" class="form-control " placeholder="nombre marca">
                            </div>
                            <span class="input-group-btn pl-2">
                            <button class="btn btn-dark" wire:click.prevent="addBrand"><i class="fa fa-floppy-o"></i></button>
                            <button class="btn btn-danger" wire:click.prevent="cancelAddBrand"><i class="fa fa-close"></i></button>
                        </span>
                        @else
                            <span class="input-group-btn">
                            <button class="btn btn-success" wire:click.prevent="activeAddBrands"><i class="fa fa-plus"></i></button>
                        </span>
                        @endif
                    @endif
            </div>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                @if($brands->count())
                <tbody>
                    @foreach($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                                <a href="javascript:void(0)" class="btn btn-info"
                                   wire:click="activeUpdateBrands({{ $brand->id }})" data-toggle="tooltip" data-placement="top"
                                   title="Editar marca">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="javascript:void(0)" class="btn btn-danger"
                                   onclick="Confirm({{ $brand->id }},'deleteBrand')" data-toggle="tooltip" data-placement="top"
                                   title="Eliminar marca">
                                    <i class="fa fa-trash"></i>
                                </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
            </div>
        </x-component-modal>
    </form>
</div>
