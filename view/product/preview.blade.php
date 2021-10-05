<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{!! asset('plugins/fontawesome-free/css/all.css') !!}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body{
                font-family: "Montserrat", sans-serif;
            }
            #myCarousel .list-inline {
                white-space:nowrap;
                overflow-x:auto;
            }

        #myCarousel .carousel-indicators {
            position: static;
            left: initial;
            width: initial;
            margin-left: initial;
        }

        #myCarousel .carousel-indicators > li {
            width: initial;
            height: initial;
            text-indent: initial;
        }

        #myCarousel .carousel-indicators > li.active img {
            opacity: 0.7;
        }
        </style>
</head>
@php $images = $product->images()->orderBy('order')->get() @endphp
<body class="pt-5">
    <div class="container-fluid">
        <div class="row m-4">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12" id="slider">
                        <div id="myCarousel" class="carousel slide shadow">
                            <!-- main slider carousel items -->
                            <div class="carousel-inner pb-4">
                                @foreach($images as $key => $image)
                                <div class="{{$loop->first ? 'active' : ''}} carousel-item" data-slide-number="$key">
                                    <img src="{{$image->url}}" class="w-100">
                                </div>
                                @endforeach
                            </div>
                            <!-- main slider carousel nav controls -->
                            <ul class="carousel-indicators list-inline mx-auto px-2">
                                @foreach($images as $key => $image)
                                <li class="list-inline-item {{$loop->first ? 'active' : ''}}">
                                    <a id="carousel-selector-0" class="selected" data-slide-to="{{$key}}" data-target="#myCarousel">
                                        <img src="{{$image->url}}" class="img-fluid">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                    <!--/main slider carousel-->

            </div>
            <div class="col-md-6 border rounded pl-5 pr-5 pb-2 pt-3">
                <h1 class="font-italic" style="font-size: 1.5rem;">{{$product->name}}</h1>
                <p class="text-muted"> <i class="fas fa-map-marked-alt"></i>
                    <small > {{$product->street}} - {{$product->city}}/{{$product->state}}
                    </small>
                </p>
                <p class="text-muted">{{$product->short_description}}</p>
                <h2 class="font-italic pt-2" style="font-size: 1rem;">BENEFÍCIOS PARA VOCÊ:</h2>
                <p class="font-weight-light">
                    - {{$product->advantage_first}} <br>
                    - {{$product->advantage_second}} <br>
                    - {{$product->advantage_third}} <br>
                @if(strlen($product->advantage_fourth) > 1)
                    - {{$product->advantage_fourth}} <br>
                @endif
                @if(strlen($product->advantage_fifth) > 1)
                    - {{$product->advantage_fifth}} <br>
                @endif
                </p>
                <h3 class="text-primary pt-1" style="font-size: 1rem;">Previsão de entrega: {{$product->estimated_conclusion->formatLocalized('%b %Y')}}</h3>
                <h3 class="text-primary" style="font-size: 1rem;"> {{$product::TYPES[$product->type]}}</h3>
                @php $item = $product->items()->orderBy('base_price', 'asc')->whereAvailable(1)->first() @endphp
                <h4 class="pt-2 pb-1" style="font-size: 1rem;"> Mensais a partir de: <span> R$ {{ $item ? number_format($item->base_price/90 , 2, ',','.'): ''}}</span> </h3>
                <button class="btn btn-lg btn-warning btn-block text-white">AGENDE SUA VISITA</button>
            </div>
        </div>
        <div class="row m-4 border-bottom">
            <div class="col-12">
                <h2 class="font-italic pt-2" style="font-size: 1rem;">Características de Loteamento</h2>
            </div>
            <div class="col-12 pt-3">
                <ul style="list-style: none; ">
                    @foreach($product->amenities as $amenity)
                        <li class="pr-3" style="display:inline"><i class="{{$amenity->icon}} fa-2x text-success"></i> <span class="pl-2">{{$amenity->name}}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row m-4 border-bottom">
            <div class="col-md-4">
                <p>Comodidades</p>
                <p class="font-weight-light">{{$product->amenity_description}}</p>
            </div>
            <div class="col-md-4">
                <p>Lazer</p>
                <p class="font-weight-light">{{$product->safety_description}}</p>
            </div>
            <div class="col-md-4">
                <p>Segurança</p>
                <p class="font-weight-light">{{$product->recreation_description}}</p>
            </div>
        </div>
        <div class="row m-4 border-bottom">
            <div class="col-12 pb-5">
                <img src="{{asset('brand/map.png')}}" width="100%" class="image">
            </div>
            <div class="col-12">
                @php $items = $product->items()->whereAvailable(1)->paginate(10); @endphp
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="bg-light">
                            <th>LOTE</th>
                            <th>ÁREA (m²)</th>
                            <th >PREÇO M²</th>
                            <th >PREÇO</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{!! $item->code!!}</td>
                                    <td>{!! $item->area!!}</td>
                                    <td>R$ {!! number_format(($item->base_price/$item->area), 2, ',', '.')!!}</td>
                                    <td>R$ {!! number_format($item->base_price , 2, ',', '.') !!}</td>
                                    <td><button class="btn btn-success">SELECIONAR</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$items->links()}}
                </div>
            </div>
        </div>
        <div class="row m-4 border-bottom pb-5">
            @foreach($images->take(4) as $image)
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="{{$image->url}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-title font-italic">Terras Alpha São José dos Campos</p>
                        <p class="card-text">Lotes a partir de <strong>550m²</strong></p>
                        <p class="card-text"><small class="text-muted">Investimento a partir de</small><br>
                        <span class="text-primary">R$ 699,90 por mês</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row m-4 border-bottom pb-5">
            <div class="col-12">
                <h2 class="font-italic pt-2" style="font-size: 1rem;">Incorporadora</h2>
            </div>
            <div class="col-2">
                <img src="{{$product->vendor->image}}" alt="" width="130px;">
            </div>
            <div class="col-10">
                <h3>{{$product->vendor->name}}</h3>
                <p class="font-weight-light pt-3">{{$product->vendor->short_description}}</p>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>
