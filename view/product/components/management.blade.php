<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-cyan card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-cyan active" id="custom-tabs-four-images-tab" data-toggle="pill" href="#custom-tabs-four-images" role="tab" aria-controls="custom-tabs-four-images" aria-selected="false">Gestão de Imagens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-cyan" id="custom-tabs-four-items-tab" data-toggle="pill" href="#custom-tabs-four-items" role="tab" aria-controls="custom-tabs-four-items" aria-selected="false">Gestão de Lotes</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-images" role="tabpanel" aria-labelledby="custom-tabs-four-images-tab">
                            @include('admin.product.components.images')
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-items" role="tabpanel" aria-labelledby="custom-tabs-four-items-tab">
                            @include('admin.item.buttons')
                            <form action="{{route('item.destroy',$product)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                @include('admin.item.list')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
