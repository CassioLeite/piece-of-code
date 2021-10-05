<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Amenity;
use Storage;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\User\UserServiceInterface;
use App\Services\Admin\Product\ProductServiceInterface;
use App\Services\Admin\ProductImage\ProductImageService;
use App\Repository\Admin\Amenity\AmenityRepositoryInterface;
use App\Repository\Admin\Product\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $service;
    protected $userService;
    protected $amenityRepository;
    protected $productImageService;
    protected $product;

    public function __construct( ProductRepositoryInterface $repository,  ProductServiceInterface $service, UserServiceInterface $userService, AmenityRepositoryInterface $amenityRepository, ProductImageService $productImageService)
    {
        $this->middleware('can:product:index')->only('index');
        $this->middleware('can:product:create')->only(['create','store']);
        $this->middleware('can:product:update')->only(['show','update']);
        $this->middleware('can:product:destroy')->only('destroy');
        $this->service = $service;
        $this->repository = $repository;
        $this->userService = $userService;
        $this->amenityRepository = $amenityRepository;
        $this->productImageService = $productImageService;
    }

    public function list( $item)
    {
        try {
            $products = $this->service->index($item);
            return view('admin.product.list', compact('products'))->with('label', 'empreendimento');
        } catch (\Exception $e) {
            return view('admin.product.list', compact('products'))->withErrors('Não foi possível listar os Produtos');
        }
    }

    public function find()
    {
        try {
            $products = $this->repository->find();
            return view('admin.product.index', compact('products' ));
        } catch (\Exception $e) {
            return view('admin.product.index', compact('products' ))->withErrors('Não foi possível listar os Produtos');
        }
    }

    public function create()
    {
        $product = new Product();
        $amenity = new Amenity();
        $options = $this->userService->getOptions();
        $specialists = $this->userService->specialists();
        $coordinators = $this->userService->coordinators();
        $options['amenity'] = $this->amenityRepository->options();
        return view('admin.product.create', compact('product', 'options', 'amenity', 'coordinators', 'specialists'));
    }

    public function store(Request $request)
    {
        try {
            $product = $this->service->store($request->all());
            if ($request->hasFile('images')) {
                $product = $this->productImageService->store($product, $request['images']);
            }
            return redirect()->route('product.show', $product)->with('success', $product->name . ' adicionado com sucesso!!');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->withInput()->withErrors($e);
        }
    }
    public function download(Product $product){
        return response()->download( storage_path('app/errors/' . $product->id . '/error.txt')  , 'error.txt' );
    }

    public function show( Product $product)
    {
        $amenity = new Amenity();
        $this->product = $product;
        $specialists = $this->userService->specialists()->where('tenant_id', $this->product->tenant_id);
        $specialists = $specialists->filter(function($item) {
            if(is_null($item->vendor_id) || $item->vendor_id == $this->product->vendor_id)
                return $item;
        });
        $coordinators = $this->userService->coordinators()->where('tenant_id', $product->tenant_id);
        $coordinators = $coordinators->filter(function($item) {
            if(is_null($item->vendor_id) || $item->vendor_id == $this->product->vendor_id)
                return $item;
        });
        $options['amenity'] = $this->amenityRepository->options();
        return view('admin.product.edit', compact('product', 'options', 'amenity','coordinators','specialists'));
    }

    public function preview( Product $product)
    {
        return view('admin.product.preview', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $this->service->update($request->all(), $product);
            if ($request->hasFile('images')) {
                $$product = $this->productImageService->store($product, $request['images']);
            }
            return redirect()->route('product.show',[$product])->with('success', $product->name . ' atualizado com sucesso!!');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->withErrors('Não foi possível atualizar o Empreendimento');
        }
    }

    public function destroy(Request $request, Product $product)
    {
        try {
            $this->service->destroy($product);
            return back()->with('success', $product->name . ' deletado com sucesso!!');
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withErrors('Erro ao excluir o empreendimento.')->withInput();
        }
    }

    public function destroyImage( $id)
    {
        try {
            $product = $this->productImageService->destroy($id);
            return redirect()->route('product.show', $product)->with('success', 'deletado com sucesso!!');
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withErrors('Erro ao excluir imagem.')->withInput();
        }
    }

    public function destroyAllImages($id) {
        try {
            $product = $this->productImageService->destroyAllImages($id);
            return redirect()->route('product.show', $product)->with('success', 'deletado com sucesso!!');
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withErrors('Erro ao excluir imagens.')->withInput();
        }
    }

    public function nextImage(Request $request, $image)
    {
        try {
            $image = ProductImage::find($image);
            $this->productImageService->next($image);
            return redirect()->action('Admin\Product\ProductController@show', $image->product)->with('success', $image->description . ' ordenado com sucesso!!');
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withErrors('Não foi possivel.')->withInput();
        }
    }

    public function previousImage(Request $request, $image)
    {
        try {
            $image = ProductImage::find($image);
            $this->productImageService->previousImage($image);
            return redirect()->action('Admin\Product\ProductController@show', $image->product)->with('success', $image->description . ' ordenado com sucesso!!');
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withErrors('Avançar.')->withInput();
        }
    }

    public function description(Request $request, $image)
    {
        try {
            $image = ProductImage::find($image);
            $this->productImageService->description($image, $request->all());
            return redirect()->action('Admin\Product\ProductController@show', $image->product)->with('success', $image->description . ' atualizado com sucesso!!');
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withErrors('Descrição.')->withInput();
        }
    }

    public function status(Product $product)
    {
        request()->merge($product->toArray());
        resolve('\App\Http\Requests\Admin\Product\UpdateProductRequest');
        $resp = $product->active ? 'Inativar' :'Ativar';
        try {
            $this->service->status($product);
            return redirect()->back()->with('success', $product->name . ' atualizado com sucesso!!');;
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withErrors('Não foi possível ' . $resp )->withInput();
        }
    }
}