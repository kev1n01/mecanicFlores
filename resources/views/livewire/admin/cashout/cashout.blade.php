<div class="row sales layout-top-spcing">
    <div class="col-sm-12">
        <div class="card">

            <div class="card-content m-3">
                <h4 class="card-title text-center"><b>Corte de Caja</b></h4>
                <hr>

                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="">Usuario</label>

                        <select wire:model="userid" class="form-control">
                            <option value="">Elegir usuario</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                        @error('userid') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="">Fecha inicial</label>
                            <input type="date" wire:model.lazy="fromDate" class="form-control">
                            @error('fromDate') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="">Fecha final</label>
                            <input type="date" wire:model.lazy="toDate" class="form-control">
                            @error('toDate') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 align-self-center d-flex justify-content-around pt-2">
                        @if($userid > 0 && $fromDate != null && $toDate != null)
                            <button type="button" wire:click.prevent="consultar" class="btn btn-dark">Consultar</button>
                        @endif
                        @if($total > 0)
                            <button type="button" wire:click.prevent="print" class="btn btn-dark">Imprimir</button>
                        @endif
                    </div>
                </div>

                <div class="row mt-5">
                <div class="col-sm-12 col-md-4 mbmobile">
                    <div class="connect-sorting bg-dark">
                        <h5 class="text-white">Ventas Totales: S/ {{number_format($total,2)}}</h5>
                        <h5 class="text-white">Articulos: {{$items}}</h5>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="table-responsive">
                        <table class="table table-striped mt-1">
                            <thead class="thead-basic">
                                <th class="table-th text-center">VENTA</th>
                                <th class="table-th text-center">TOTAL</th>
                                <th class="table-th text-center">ITEMS</th>
                                <th class="table-th text-center">FECHA</th>
                                <th class="table-th text-center">ACTION</th>
                            </thead>
                            <tbody>
                            @if($total <= 0)
                                <tr><td colspan="4"><h6 class="text-center">No hay ventas en la fecha seleccionada</h6></td></tr>
                            @endif
                            @foreach($sales as $s)
                                <tr>
                                    <td class="text-center"><h6>{{$s->id}}</h6></td>
                                    <td class="text-center"><h6>S/ {{number_format($s->total,2)}}</h6></td>
                                    <td class="text-center"><h6>{{$s->items}}</h6></td>
                                    <td class="text-center"><h6>{{$s->created_at}}</h6></td>
                                    <td class="text-center">
                                        <button  wire:click.prevent="viewDetails({{$s}})" class="btn btn-dark color-basic btn-sm">
                                            <i class="fas fa-list"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>

        </div>
    </div>
</div>
@push('modals')
    @livewire('admin.modal.cashout.modal-cashout')
@endpush

@push('scripts')

    <script>

        window.addEventListener('close-modal-detail', event => {
            $('#DetailsModal').modal('hide');
        });
        window.addEventListener('open-modal-detail', event => {
            $('#DetailsModal').modal('show');
        });
    </script>

@endpush
