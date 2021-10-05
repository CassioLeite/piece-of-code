@extends('layouts.admin' , ['header' => 'Gestão de Empreendimentos'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-5">
                <div class="row justify-content-md-center">
                    <livewire:admin.dashboard :icon="'fab fa-product-hunt'" :models="$products" :groupBy="'tenant.name'" :route="'product.list'"/>
                </div>
                @can('product:create')
                @include('admin.components.dashboard-add-button', ['route' => 'product', 'label' => 'Empreendimento'])
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

