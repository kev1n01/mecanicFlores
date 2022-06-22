<div>
    <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
        :classModalDialog="$classModalDialog" :classSize="$classSize">

        @foreach ($permission_check as $key => $p)
        <div class="row">
            <div class="col mx-auto">
                <div class=" float-left">
                    @if(!$p['check'])
                    <span class=" fa fa-check mr-3 "></span>
                    @endif
                    <span class=" fa {{$p['check'] ? 'fa-check mr-3 text-primary' : ''}} "></span>
                    <span >{{$key}}</span>
                </div>
                <div class="form-group  float-right">

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="iradio_flat-green " wire:model="permission_check.{{$key}}.check"
                                wire:click="addPermissionKey('{{$key}}')" >
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </x-component-modal>
</div>
