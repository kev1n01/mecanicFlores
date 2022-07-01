<div class="row sales layout-top-spcing container">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-content m-3">
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
                            <table class="table table-striped mt-1">
                                <thead class="thead-basic">
                                <th class="table-th text-center">VENTA</th>
                                <th class="table-th text-center">TOTAL</th>
                                <th class="table-th text-center">ITEMS</th>
                                <th class="table-th text-center">FECHA</th>
                                <th class="table-th text-center">ACTION</th>
                                </thead>
                                <tbody>
                                @if($sales)
                                    <tr><td colspan="4"><h6 class="text-center">Actualmente no tiene ninguna compra registrada</h6></td></tr>
                                @endif
                                @foreach($sales as $s)
                                    <tr>
                                        <td class="text-center"><h6>{{$s->id}}</h6></td>
                                        <td class="text-center"><h6>S/ {{number_format($s->total,2)}}</h6></td>
                                        <td class="text-center"><h6>{{$s->items}}</h6></td>
                                        <td class="text-center"><h6>{{$s->created_at}}</h6></td>
                                        <td class="text-center">
                                            <button  wire:click.prevent="viewDetails({{$s}})" class="btn btn-dark color-basic btn-sm">
                                                <i class="fa fa-list"></i>
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
    @livewire('user.modal.modalpurchasedetail')
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
