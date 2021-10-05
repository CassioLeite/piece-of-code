@extends('layouts.admin', ['header' => 'Edição de Empreendimento'])
@section('content')
<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger col-12">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="row pb-2">
    <div class="col-12">
        {{--
        <a href="{{route('product.preview', $product)}}" target="_blank" class="btn btn-teal text-white btn-block float-right "> <i class="fas fa-eye"></i> VER {{strtoupper($product->name)}}</a>
        --}}
    </div>
</div>
<form id="form-product-edit" action="{{route('product.update', $product)}}" onsubmit="enable('state');"  method="POST" name="update-form" id="update-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.product.components.input')
    {{--
    @include('admin.components.footer-update-button',['route' => 'product.list' , 'param' => $product->tenant->name])
    --}}
</form>
@include('admin.product.components.management')
{{--
@include('admin.product.components.images')
@include('admin.item.buttons')
<form action="{{route('item.destroy',$product)}}"  method="POST">
    @method('DELETE')
    @csrf
    @include('admin.item.list')
</form>
--}}
@endsection
@section('script-datatable')@parent
<script>
    $(function () {
        $("#item-table").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "url" :"https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
            },
            'order': [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, 100, 1000], [10, 25, 50,100, 1000]],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false

            }]

        });
    });

    function toggle(source) {
        checkboxes = document.getElementsByClassName('destroy');
        for(var i = 0; i < checkboxes.length; i++){
            checkboxes[i].checked = source.checked;
        }
    }

</script>
@endsection
