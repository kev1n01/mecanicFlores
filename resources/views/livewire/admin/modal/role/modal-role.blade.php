<div>
    <form wire:submit.prevent="{{$method}}">
        <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
            :classModalDialog="$classModalDialog" :classSize="$classSize">

            <div class="col-md-12">
                <x-component-input name="role" label="" placeholder="Ingresar el rol" type="text">
                </x-component-input>
            </div>

        </x-component-modal>
    </form>
</div>
