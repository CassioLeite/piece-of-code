<!-- SEO -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p>Cadastro de SEO<br></p>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Meta Título (separado por " - ")</label>
                            <textarea type="text" class="form-control {!! $errors->has('meta_title') ? 'is-invalid' : '' !!}" placeholder="Reserva Central Parque - lote com infraestrutura completa em Botucatu - 1M2" id="meta_title" name="meta_title" rows="3" >{!! $product->meta_title ?? old('meta_title') !!}</textarea>
                            @if($errors->has('meta_title'))
                                <div class="invalid-feedback">{!! $errors->first('meta_title') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Meta Descrição (descrição no google)</label>
                            <textarea type="text" class="form-control {!! $errors->has('meta_description') ? 'is-invalid' : '' !!}" placeholder="Descrição completa." id="meta_description" name="meta_description" rows="3" >{!! $product->meta_description ?? old('meta_description') !!}</textarea>
                            @if($errors->has('meta_description'))
                                <div class="invalid-feedback">{!! $errors->first('meta_description') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Meta Chave (separado por " , ")</label>
                            <textarea type="text" class="form-control {!! $errors->has('meta_keywords') ? 'is-invalid' : '' !!}" placeholder="terreno, lote, academia, próximo ao centro de sp, segurança" id="meta_keywords" name="meta_keywords" rows="3" >{!! $product->meta_keywords ?? old('meta_keywords') !!}</textarea>
                            @if($errors->has('meta_keywords'))
                                <div class="invalid-feedback">{!! $errors->first('meta_keywords') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Meta URL  (separado por " - ")</label>
                            <textarea type="text" class="form-control {!! $errors->has('meta_url') ? 'is-invalid' : '' !!}" placeholder="reserva-central-parque-terrenos-a-venda-em-botucatu-sao-paulo" id="meta_url" name="meta_url" rows="3" >{!! $product->meta_url ?? old('meta_url') !!}</textarea>
                            @if($errors->has('meta_url'))
                                <div class="invalid-feedback">{!! $errors->first('meta_url') !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
