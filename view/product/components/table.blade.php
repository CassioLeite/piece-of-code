<div class="table-responsive">
    <table class="table table-striped" id="product-table">
        <thead>
            <th>Organização</th>
            <th>Incorporadora</th>
            <th>Nome</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Status</th>
            @canany(['product:update','product:destroy' ])
            <th class="no-sort">Ações</th>
            @endcanany
        </thead>
        <tbody>
            @foreach($products as $key => $product)
            <tr>
                @php $css = !$product->active ? 'teal' : 'secondary';  @endphp
                @if($product->tenant)
                <td><a href="{{route('tenant.show', $product->tenant)}}">{{$product->tenant->name ?? ''}}</a></td>
                @else
                <td><a href="#">{{$product->tenant->name ?? ''}}</a></td>
                @endif
                <td> @if($product->vendor)<a href="{{route('vendor.show', $product->vendor)}}">{{$product->vendor->name ?? ''}}</a>@endif</td>
                <td>{{$product->name ?? ''}}</td>
                <td>{{$product->state ?? ''}}</td>
                <td>{{$product->city ?? ''}}</td>
                <td >
                    <form action="{{ route('product.status', $product) }}" method="POST" >
                        @csrf
                        <input type="hidden" name="active" value="{{ (int)!$product->active}}">
                        <button type="submit" class="btn btn-sm btn-outline-{{$css}}">{{$product->active ? 'inativar' : 'ativar'}}</button></span>
                    </form>
                </td>
                @canany(['product:update','product:destroy' ])
                <td style="width: 100px;">
                    @can('product:update')
                        <a href="{{route('product.show',['product' => $product])}}"><i class="fas fa-edit text-cyan pl-2"></i></a>
                    @endcan
                    @can('product:destroy')
                        <a href="" id="{{ $product->id }}" class="delete-button">
                            <i class="fas fa-trash text-danger pl-2"></i>
                        </a>
                    <form id="delete-form-{{$product->id}}" action="{{ route('product.destroy', $product) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endcan
                </td>
                @endcanany
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('script-datatable')@parent
<script>
    $(function () {
        $("#product-table").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "url" :"https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
            },
            "order": [],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            }]
        });
    });
    $(function(){
            $('.delete-button').on('click', function (event) {
                event.preventDefault();
                var id = $(this).attr('id');

                $('#delete-modal').modal('toggle');
                $('#delete-confirm').click(function() {
                    var form = $('#delete-form-' + id);
                    form.submit();
                });
            });
        });
</script>
@endsection
<div id="delete-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Deseja deletar {!! $label ?? 'o registro' !!}?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button id="delete-confirm" type="button" class="btn btn-danger">Deletar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
</div>
