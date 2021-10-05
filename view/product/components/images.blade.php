@if($product->images->count() > 0 )
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p>Gestão de imagens</p>
                <div class="row">
                    <div class="col-md-12">
                        <form id="delete-form-{{ $product->id }}" action="{{route('productAllImages.destroy', $product)}}"  method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="{{ $product->id }}" class="btn btn-outline-danger btn-xs delete-button-images float-right">Deletar Imagens <i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    @foreach ($product->images()->orderBy('order')->get() as $img)
                        <div class="col-md-2 ">
                            <div class="card ml-2" >
                                <img src="{{ $img->url }}" class="card-img-top" height="150px" >

                                <div class="card-body">
                                    <form action="{{route('productImage.description', $img)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label class="font-weight-light"><small>Texto alternativo*</small></label>
                                            <input type="text" class="form-control form-control-sm {!! $errors->has('description') ? 'is-invalid' : '' !!}" placeholder="Texto alternativo" name="description" id="description" value="{!!$img->description ?? old('description') !!}" required>
                                            @if($errors->has('description'))
                                                <div class="invalid-feedback">{!! $errors->first('description') !!}</div>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-block btn-teal btn-xs"> SALVAR</button>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="row justify-content-center">
                                        @if (!$loop->first)
                                        <div class="col-4">
                                            <form action="{{route('productImage.previous', $img)}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-dark btn-xs"><i class="fas fa-arrow-left"></i></button>
                                            </form>
                                        </div>
                                        @endif
                                        <div class="col-4">
                                            <form id="delete-form-{{ $img->id }}" action="{{route('productImage.destroy', $img)}}"  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="{{ $img->id }}" class="btn btn-outline-danger btn-xs delete-button"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                        @if (!$loop->last)
                                        <div class="col-4">
                                            <form action="{{route('productImage.next', $img)}}"   method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-dark btn-xs"><i class="fas fa-arrow-right"></i></button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($loop->first)
                            <p class="text-center">Capa</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
