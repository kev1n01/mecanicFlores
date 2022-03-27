<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="{{$idModal}}" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="{{$idModal}}Label" aria-hidden="true">
        <div class="modal-dialog {{$classModalDialog}} {{$classSize}}">
            <div class="modal-content">
                <div class="modal-header mx-auto">
                    <h6 class="modal-title" id="{{$idModal}}Label">{{$action}} {{$nameComponent}}</h6>
                </div>
                <div class="modal-body">
                    {{$slot}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" 
                        wire:click="cerrarModal">Cancelar
                    </button>
                    @if($action)
                    <button type="submit" wire:click="submit" class="btn btn-dark ">
                        <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm"></span>
                        {{$action}}
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
