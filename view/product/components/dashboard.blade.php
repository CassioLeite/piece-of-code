
@foreach($products as $group => $value)
<div class="col-md-3 col-12">
    <!-- small card -->
    <div class="small-box bg-light">
        <div class="inner">
            <p class="font-weight-light">{!! $value->first()->vendor->name ?? '' !!}</p>
            <h3 class="text-center text-primary font-weight-light">{{$value->count()}}</h3>
            <p class="text-center text-primary font-weight-light" style="font-size: 14px;">Cadastrados</p>
        </div>
        <div class="icon">
            <i class="fas fa-industry"></i>
        </div>
        <a href="{{ route('product.list', $value->first()->vendor) }}" class="small-box-footer ">
            <span class="text-cyan font-weight-light">Ver Listagem</span>
        </a>
    </div>
</div>
@endforeach
