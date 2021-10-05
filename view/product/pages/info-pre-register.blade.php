<!-- Pré-Cadastro -->
@if(isset($options['tenant']) || isset($options['vendor']))
<div class="row">
    @if(isset($options['tenant']))
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-weight-light">Organização*</label>
                            <select class="form-control" id="tenant_id" name="tenant_id" onchange="tenantFilter();" required>
                                <option value="">selecione</option>
                                @foreach($options['tenant'] as $key => $value)
                                    <option value="{{$value->id}}" {!!$value->id == ( $product->tenant_id ?? old('tenant_id'))? 'selected' : ''!!} >{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(isset($options['vendor']))
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-weight-light">Incorporadora*</label>
                            <select class="form-control" name="vendor_id" id="vendor_id" required onchange="specialistFilter();">
                                    <option value="" class="default">selecione</option>
                                @foreach($options['vendor'] as $key => $value)
                                    <option value="{{$value->id}}"
                                        class='hide tenant_{{$value->tenant_id}}'
                                        style="display: {!! isset($options['tenant'])? 'none':''!!};"
                                        {!!$value->id == ( $product->vendor_id ?? old('vendor_id'))? 'selected' : ''!!} >
                                        {{$value->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endif
@if(file_exists(storage_path('app/errors/' . $product->id . '/error.txt')))
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if(file_exists(storage_path('app/errors/' . $product->id . '/error.txt')))
                <p>Encontramos erros no arquivo de importação</p>
                <div class="row">
                    <div class="col-12">
                        <a href="{!! route('product.download', $product) !!}" class="btn btn-danger" role="btn">Download <i class="fas fa-download"></i></i></a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p>Informações Iniciais</p>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Nome*</label>
                            <input type="text" class="form-control {!! $errors->has('name') ? 'is-invalid' : '' !!}" placeholder="Florada Raízes" name="name" id="name" value="{!!$product->name ?? old('name') !!}" required>
                            @if($errors->has('name'))
                            <div class="invalid-feedback">{!! $errors->first('name') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Previsão de término</label>
                            <input type="date" class="form-control {!! $errors->has('estimated_conclusion') ? 'is-invalid' : '' !!}" placeholder="estimated_conclusion" name="estimated_conclusion" id="estimated_conclusion" value="{!!$product->estimated_conclusion ? $product->estimated_conclusion->format('Y-m-d') : old('estimated_conclusion') !!}" >
                            @if($errors->has('estimated_conclusion'))
                            <div class="invalid-feedback">{!! $errors->first('estimated_conclusion') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Tipo de empreendimento</label>
                            <select class="form-control" id="type" name="type" >
                                <option value="">selecione</option>
                                @foreach($product::TYPES as $key => $value)
                                <option value="{{$key}}" {!! $key==( $product->type ?? old('type'))? 'selected' : ''!!} >{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Status de empreendimento</label>
                            <select class="form-control" id="product_status" name="product_status" >
                                <option value="">selecione</option>
                                @foreach($product::STATUS as $key => $value)
                                <option value="{{$key}}" {!! $key==( $product->product_status ?? old('product_status'))? 'selected' : ''!!} >{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-weight-light">Responsável pela prospecção</label>
                            <input type="text" class="form-control {!! $errors->has('responsible_for') ? 'is-invalid' : '' !!}" placeholder="Responsável pela prospecção" name="responsible_for" id="responsible_for" value="{!!$product->responsible_for ?? old('responsible_for') !!}" >
                            @if($errors->has('responsible_for'))
                            <div class="invalid-feedback">{!! $errors->first('responsible_for') !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p>Dados dos atendentes</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-light">Coordenador</label>
                            <select class="form-control" name="coordinator_id" id="coordinator_id" >
                                <option value="" class="default">selecione</option>
                                @foreach($coordinators as $key => $value)
                                <option value="{{$value->id}}" class='hide_cordinator cordinator_{{$value->tenant_id}}{{$value->vendor_id? '_'.$value->vendor_id:''}}' {!!$value->id == ( $product->coordinator_id ?? old('coordinator_id'))? 'selected' : ''!!} >
                                    {{$value->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-light">Especialistas</label>
                            <select id="specialists" class="especialistas" name="specialists[]" multiple="multiple" data-placeholder="Selecione os especialistas" style="width: 100%;" >
                                @foreach($specialists as $key => $value)
                                <option class="specialist-opt specialist_{{$value->tenant_id}}{{$value->vendor_id? '_'.$value->vendor_id:''}}" value="{!! $value->id!!}" data-tenant='{{$value->tenant_id}}' {!! ( $product->specialists->contains($value->id) ?? old('specialists'))? 'selected' : ''!!}
                                    >{!!$value->name!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p>Dados de Localização</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">CEP</label>
                            <input type="text" onblur="pesquisacep(this.value);" onkeyup="mascara('#####-###',this,event,true)" maxlength="9" class="form-control {!! $errors->has('postcode') ? 'is-invalid' : '' !!}" placeholder="CEP" name="postcode" id="postcode" value="{!!$product->postcode ?? old('postcode') !!}" >
                            @if($errors->has('postcode'))
                            <div class="invalid-feedback">{!! $errors->first('postcode') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">Número</label>
                            <input type="text" class="form-control {!! $errors->has('number') ? 'is-invalid' : '' !!}" placeholder="222" name="number" id="number" value="{!!$product->number ?? old('number') !!}" >
                            @if($errors->has('number'))
                            <div class="invalid-feedback">{!! $errors->first('number') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">Complemento</label>
                            <input type="text" class="form-control {!! $errors->has('complement') ? 'is-invalid' : '' !!}" placeholder="KM 52" name="complement" id="complement" value="{!!$product->complement ?? old('complement') !!}">
                            @if($errors->has('complement'))
                            <div class="invalid-feedback">{!! $errors->first('complement') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-weight-light">Endereço</label>
                            <input type="text" readonly class="form-control {!! $errors->has('street') ? 'is-invalid' : '' !!}" placeholder="Av. Paulista, 2222 5º andar sala 555 - Bela Vista" name="street" id="street" value="{!!$product->street ?? old('street') !!}" >
                            @if($errors->has('street'))
                            <div class="invalid-feedback">{!! $errors->first('street') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">Bairro</label>
                            <input readonly type="text" class="form-control {!! $errors->has('neighborhood') ? 'is-invalid' : '' !!}" placeholder="Vila Mariana" name="neighborhood" id="neighborhood" value="{!!$product->neighborhood ?? old('neighborhood') !!}">
                            @if($errors->has('neighborhood'))
                            <div class="invalid-feedback">{!! $errors->first('neighborhood') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">Cidade</label>
                            <input readonly type="text" class="form-control {!! $errors->has('city') ? 'is-invalid' : '' !!}" placeholder="São Paulo" name="city" id="city" value="{!!$product->city ?? old('city') !!}" >
                            @if($errors->has('city'))
                            <div class="invalid-feedback">{!! $errors->first('city') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">UF</label>
                            <select readonly class="form-control {!! $errors->has('state') ? 'is-invalid' : '' !!}" name="state" id="state_id" >
                                <option value="">selecione</option>
                                @foreach(estadosBrasileiros() as $key => $uf)
                                <option value="{{$key}}" {{ $product->state == $key  || old('state') == $key ? 'selected' : ''}}>{!!$key!!}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                            <div class="invalid-feedback">{!! $errors->first('state') !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">Zona UTM</label>
                            <input type="text" class="form-control {!! $errors->has('utm') ? 'is-invalid' : '' !!}" placeholder="" name="utm" id="utm" value="{!!$product->utm ?? old('utm') !!}" >
                            @if($errors->has('utm'))
                            <div class="invalid-feedback">{!! $errors->first('utm') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">Latitude</label>
                            <input type="text" class="form-control {!! $errors->has('lat') ? 'is-invalid' : '' !!}" placeholder="-10.925591" name="lat" id="lat" value="{!!$product->lat ?? old('lat') !!}" >
                            @if($errors->has('lat'))
                            <div class="invalid-feedback">{!! $errors->first('lat') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-light">Longitude</label>
                            <input type="text" class="form-control {!! $errors->has('long') ? 'is-invalid' : '' !!}" placeholder="-37.023920" name="long" id="long" value="{!!$product->long ?? old('long') !!}" >
                            @if($errors->has('long'))
                            <div class="invalid-feedback">{!! $errors->first('long') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-light">Ajuste Norte Coordenada Mercator</label>
                            <input type="text" class="form-control {!! $errors->has('offset_north') ? 'is-invalid' : '' !!}" placeholder="0" name="offset_north" id="offset_north" value="{!! $product->offset_north ?? old('offset_north') !!}">
                            @if($errors->has('offset_north'))
                            <div class="invalid-feedback">{!! $errors->first('offset_north') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-light">Ajuste Leste Coordenada Mercator</label>
                            <input type="text" class="form-control {!! $errors->has('offset_east') ? 'is-invalid' : '' !!}" placeholder="0" name="offset_east" id="offset_east" value="{!!$product->offset_east ?? old('offset_east') !!}">
                            @if($errors->has('offset_east'))
                            <div class="invalid-feedback">{!! $errors->first('offset_east') !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
