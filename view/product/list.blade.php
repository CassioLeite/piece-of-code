@extends('layouts.admin', ['header' => 'Listagem de Empreendimentos'])
@section('content')
<div class="content">
    @if($errors->any())
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($errors->getMessages() as $error)
                                <li>{!!$error[0]!!}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('admin.product.components.table')
                    </div>
                </div>
            </div>
        </div>
        @can('product:create')
        <livewire:admin.list-button :route="'product'" :label="'ADICIONAR EMPREENDIMENTO'" :permission="'product.create'">
        @endcan
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('keyup', function(){
                console.log($('#product-table_filter input').val());
            })
        });

    </script>
@endsection