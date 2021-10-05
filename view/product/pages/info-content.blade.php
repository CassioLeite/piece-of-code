@if(isset($options['amenity'][$amenity::SAFETY]) || isset($options['amenity'][$amenity::AMENITY]) || isset($options['amenity'][$amenity::RECREATION]))
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p>Descrição e comodidades</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-weight-light">Descrição (resumo)</label>
                            <textarea type="text" class="form-control {!! $errors->has('short_description') ? 'is-invalid' : '' !!}" placeholder="Descrição completa" id="short_description" name="short_description" rows="3" >{!! $product->short_description ?? old('short_description') !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-weight-light">Descrição (completa)</label>
                            <textarea type="text" class="form-control {!! $errors->has('description') ? 'is-invalid' : '' !!}" placeholder="Descrição completa" id="description" name="description" rows="6" >{!! $product->description ?? old('description') !!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @isset($options['amenity'][$amenity::AMENITY])
                    <div class="col-md-4 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-light">Comodidade</label>
                                    <textarea  class="form-control {!! $errors->has('amenity_description') ? 'is-invalid' : '' !!}" placeholder="No Floarada Raízes, você encontra lotes com infraestrutura completa, equipados com rede de água, rede de esgoto, sistema de drenagem, asfalto com meio-fio, energia elétrica e iluminação" id="amenity_description" name="amenity_description" rows="2" >{!! $product->amenity_description ?? old('amenity_description') !!}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-light">Itens de Comodidade</label>
                                    <select class="select2" name="amenities[]" multiple="multiple" data-placeholder="Selecione os itens de comodidade" style="width: 100%;" >
                                        @foreach($options['amenity'][$amenity::AMENITY] as $amenity)
                                            <option value="{!! $amenity->id!!}" {!! ( $product->amenities->contains($amenity->id) ?? old('amenities'))? 'selected' : ''!!}  >{!!$amenity->name!!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset
                    @isset($options['amenity'][$amenity::RECREATION])
                    <div class="col-md-4 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-light">Lazer</label>
                                    <textarea  class="form-control {!! $errors->has('recreation_description') ? 'is-invalid' : '' !!}" placeholder="Com mais de 420 mil m² de área verde, próximo a praias incríveis e banhado pelo rio Sergipe e pelo Oceano Atlântico, o Floarada Raízes conta, também, com ampla estrutura de *, com piscina adulto e infantil, deck molhado, pier, lago, solarium" id="recreation_description" name="recreation_description" rows="2" >{!! $product->recreation_description ?? old('recreation_description') !!}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-light">Itens de Lazer</label>
                                    <select class="select2" name="recreations[]" multiple="multiple" data-placeholder="Selecione os itens de lazer" style="width: 100%;" >
                                        @foreach($options['amenity'][$amenity::RECREATION] as $recreation)
                                            <option value="{!! $recreation->id!!}" {!! ( $product->amenities->contains($recreation->id) ?? old('recreation'))? 'selected' : ''!!} >{!!$recreation->name!!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset
                    @isset($options['amenity'][$amenity::SAFETY])
                    <div class="col-md-4 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-light">Segurança</label>
                                    <textarea  class="form-control {!! $errors->has('safety_description') ? 'is-invalid' : '' !!}" placeholder="Com perímetro 100% fechado, o Florada Raízes conta, ainda, com portaria, seguranças e monitoramento 24 horas, garantindo segurança." id="safety_description" name="safety_description" rows="2" >{!! $product->safety_description ?? old('safety_description') !!}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-light">Itens de Segurança</label>
                                    <select class="select2" name="safety[]" multiple="multiple" data-placeholder="Selecione as comodidades" style="width: 100%;" >
                                        @foreach($options['amenity'][$amenity::SAFETY] as $safety)
                                            <option value="{!! $safety->id!!}" {!! ( $product->amenities->contains($safety->id) ?? old('safety'))? 'selected' : ''!!} >{!!$safety->name!!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <label class="font-weight-light">Fotos do empreendimento <br>Clique no botão abaixo e selecione todas as imagens que deseja enviar. Recomendamos os formatos <small class="text-cyan">jpg ou png</small></label>
                <label class="btn btn-secondary btn-lg btn-block btn-file pt-3 pb-3 ">
                        <i class="fa fa-cloud-upload-alt fa-1x" aria-hidden="true"></i>
                        <input type="file" id="inputImages" name="images[]" accept="image/x-png,image/gif,image/jpeg" multiple {{ $product->id ? '' : ''}} >
                </label>
                <small id="imageFileName" class="form-text text-muted"></small>
                @if($errors->has('images'))
                    <small id="teste" class="form-text text-danger">{!! $errors->first('images') !!} </small>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p>Vantagens</p>
                <div class="row">
                    <div class="col-sm ">
                        <div class="form-group">
                            <label class="font-weight-light">Vantagem 1</label>
                            <input type="text" class="form-control {!! $errors->has('advantage_first') ? 'is-invalid' : '' !!}" placeholder="Florada Raízes" name="advantage_first" id="advantage_first" value="{!!$product->advantage_first ?? old('advantage_first') !!}" >
                            @if($errors->has('advantage_first'))
                                <div class="invalid-feedback">{!! $errors->first('advantage_first') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm ">
                        <div class="form-group">
                            <label class="font-weight-light">Vantagem 2</label>
                            <input type="text" class="form-control {!! $errors->has('advantage_second') ? 'is-invalid' : '' !!}" placeholder="Florada Raízes" name="advantage_second" id="advantage_second" value="{!!$product->advantage_second ?? old('advantage_second') !!}" >
                            @if($errors->has('advantage_second'))
                                <div class="invalid-feedback">{!! $errors->first('advantage_second') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm ">
                        <div class="form-group">
                            <label class="font-weight-light">Vantagem 3</label>
                            <input type="text" class="form-control {!! $errors->has('advantage_third') ? 'is-invalid' : '' !!}" placeholder="Florada Raízes" name="advantage_third" id="advantage_third" value="{!!$product->advantage_third ?? old('advantage_third') !!}" >
                            @if($errors->has('advantage_third'))
                                <div class="invalid-feedback">{!! $errors->first('advantage_third') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm ">
                        <div class="form-group">
                            <label class="font-weight-light">Vantagem 4</label>
                            <input type="text" class="form-control {!! $errors->has('advantage_fourth') ? 'is-invalid' : '' !!}" placeholder="Florada Raízes" name="advantage_fourth" id="advantage_fourth" value="{!!$product->advantage_fourth ?? old('advantage_fourth') !!}" >
                            @if($errors->has('advantage_fourth'))
                                <div class="invalid-feedback">{!! $errors->first('advantage_fourth') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm ">
                        <div class="form-group">
                            <label class="font-weight-light">Vantagem 5</label>
                            <input type="text" class="form-control {!! $errors->has('advantage_fifth') ? 'is-invalid' : '' !!}" placeholder="Florada Raízes" name="advantage_fifth" id="advantage_fifth" value="{!!$product->advantage_fifth ?? old('advantage_fifth') !!}" >
                            @if($errors->has('advantage_fifth'))
                                <div class="invalid-feedback">{!! $errors->first('advantage_fifth') !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p>Ficha Técnica <br></p>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Área total (m²)</label>
                            <input type="text" class="form-control {!! $errors->has('total_area') ? 'is-invalid' : '' !!}" placeholder="341.16" name="total_area" id="total_area" value="{!!$product->total_area ?? old('total_area') !!}" >
                            @if($errors->has('total_area'))
                                <div class="invalid-feedback">{!! $errors->first('total_area') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Área total de lotes (m²)</label>
                            <input type="text" class="form-control {!! $errors->has('total_area_of_itens') ? 'is-invalid' : '' !!}" placeholder="172.60" name="total_area_of_itens" id="total_area_of_itens" value="{!!$product->total_area_of_itens ?? old('total_area_of_itens') !!}" >
                            @if($errors->has('total_area_of_itens'))
                                <div class="invalid-feedback">{!! $errors->first('total_area_of_itens') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Área verde (m²)</label>
                            <input type="text" class="form-control {!! $errors->has('green_area') ? 'is-invalid' : '' !!}" placeholder="341.16" name="green_area" id="green_area" value="{!!$product->green_area ?? old('green_area') !!}" >
                            @if($errors->has('green_area'))
                                <div class="invalid-feedback">{!! $errors->first('green_area') !!}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-light">Área comum (m²)</label>
                            <input type="text" class="form-control {!! $errors->has('common_area') ? 'is-invalid' : '' !!}" placeholder="172.60" name="common_area" id="common_area" value="{!!$product->common_area ?? old('common_area') !!}" >
                            @if($errors->has('common_area'))
                                <div class="invalid-feedback">{!! $errors->first('common_area') !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endisset