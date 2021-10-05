
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-cyan card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link text-cyan active" id="custom-tabs-four-pre-register-tab" data-toggle="pill" href="#custom-tabs-four-pre-register" role="tab" aria-controls="custom-tabs-four-pre-register" aria-selected="false">Pré-Cadastro</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-cyan" id="custom-tabs-four-content-tab" data-toggle="pill" href="#custom-tabs-four-content" role="tab" aria-controls="custom-tabs-four-content" aria-selected="false">Conteúdo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-cyan" id="custom-tabs-four-seo-tab" data-toggle="pill" href="#custom-tabs-four-seo" role="tab" aria-controls="custom-tabs-four-seo" aria-selected="false">SEO</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-pre-register" role="tabpanel" aria-labelledby="custom-tabs-four-pre-register-tab">
                    @include('admin.product.pages.info-pre-register')
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-content" role="tabpanel" aria-labelledby="custom-tabs-four-content-tab">
                    @include('admin.product.pages.info-content')
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-seo" role="tabpanel" aria-labelledby="custom-tabs-four-seo-tab">
                    @include('admin.product.pages.info-seo')
                  </div>
                </div>
                @if(Request::route()->getName() == 'product.create')
                    @include('admin.components.footer-button')
                @elseif(Request::route()->getName() == 'product.show')
                    @include('admin.components.footer-update-button',['route' => 'product.list' , 'param' => $product->tenant->name])
                @endif
              </div>
            </div>
          </div>
    </div>
</div>
@include('admin.components.delete-modal')
@include('admin.product.components.delete-modal-all-images')
@section('script')
    <script>
        var clicked = false;

        function format(state) {
            var originalOption = state.element;
            console.log(originalOption);
        }
        $(window).on("load", function(){
            //Initialize Select2 Elements
            $('.select2').select2();
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('.especialistas').select2();
        });
        $('#inputImages').on('change',function(){
            document.getElementById('imageFileName').innerHTML = '';
            var files = $("#inputImages")[0].files;
            for (var i = 0; i < files.length; i++){
                document.getElementById('imageFileName').innerHTML += files[i].name + '<br>';
            }
        });


    </script>
    <script src="{!! asset('js/cep.js') !!}"></script>
@endsection
