<div>
    <form wire:submit.prevent="{{$method}}" >
        <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
                           :classModalDialog="$classModalDialog" :classSize="$classSize">
            <div class="table-responsive">
                <table class="table table-striped mt-1">
                    <thead class="thead-basic">
                        <th class="table-th text-left">PRODUCTO</th>
                        <th class="table-th text-center">CANTIDAD</th>
                        <th class="table-th text-center">PRECIO</th>
                        <th class="table-th text-center">IMPORTE</th>
                    </thead>
                    <tbody>
                    @foreach($details as $d)
                        <tr>
                            <td class="text-left"><h6>{{$d->product}}</h6></td>
                            <td class="text-center"><h6>{{$d->quantity}}</h6></td>
                            <td class="text-center"><h6>S/ {{number_format($d->price,2)}}</h6></td>
                            <td class="text-center"><h6>S/ {{number_format($d->quantity * $d->price,2)}}</h6></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <td class="text-right"><h6 class="text-info">TOTALES: </h6></td>
                        <td class="text-center">
                            @if($details)
                                <h6 class="text-info">{{$details->sum('quantity')}}</h6>
                            @endif
                        </td>
                        @if($details)
                            @php $mytotal = 0; @endphp
                            @foreach($details as $d)
                                @php $mytotal += $d->quantity * $d->price; @endphp
                            @endforeach
                            <td></td>
                            <td class="text-center"><h6 class="text-info">S/ {{number_format($mytotal,2)}}</h6></td>
                        @endif
                    </tfoot>
                </table>
            </div>
        </x-component-modal>
    </form>
</div>
