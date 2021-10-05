@extends('layouts.admin',['header' => 'Cadastro de Empreendimento'])
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form id="form-product-create" action="{{route('product.store')}}" onsubmit="enable('state');"  method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.product.components.input')
    {{--@csrf
    @include('admin.components.footer-button')--}}
</form>
@endsection

<script>
    function tenantFilter()
    {
        var tenant_id = $('#tenant_id').val();
        $('#specialists').prop('disabled', false);
        $('.hide').hide();
        $('.tenant_'+tenant_id).show();
        $('.default').prop('selected', true);
        cordinator();

    }
    function cordinator()
    {
        var tenant_id = $('#tenant_id').val();
        var vendor_id = $('#vendor_id').val();
        $('#coordinator_id').prop('disabled', false);
        $('.hide_cordinator').hide();
        $('.cordinator_'+tenant_id).show();
        $('.cordinator_'+tenant_id+'_'+vendor_id).show();
    }
    function specialistFilter()
    {
        cordinator();
        $('#specialists').prop('disabled', false);
        $('#specialists').val([]);
        var tenant_id = $('#tenant_id').val();
        var vendor_id = $('#vendor_id').val();
        var tenantClass = 'specialist_'+tenant_id;
        var tenantVendorClass = 'specialist_'+tenant_id+'_'+vendor_id;

        $('#specialists').find('.specialist-opt').each(function(){
            if ($(this).hasClass(tenantClass) || $(this).hasClass(tenantVendorClass)) {
                $(this).prop('disabled', false);
            } else {
                $(this).prop('disabled', 'disabled');
            }
        });

        $('#specialists').select2();
    }
</script>
