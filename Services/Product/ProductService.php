<?php

namespace App\Services\Admin\Product;

use App\Models\Product;
use App\Repository\Admin\Product\ProductRepositoryInterface;

final class ProductService implements ProductServiceInterface
{
    protected $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function dashboard()
    {
        return $this->repository->dashboard();
    }

    public function index($item)
    {
        return $this->repository->index($item);
    }

    public function find($id)
    {
        return new Product();
    }


    public function store($data):Product
    {
        $data = $this->floats($data);
        $data['meta_url'] = $this->makeProductUrl($data);
        $product = $this->repository->store($data);
        $product = $this->amenities($product, $data);
        if (isset($data['specialists'])) {
            $product = $this->specialists($product, $data['specialists']);
        }
        return $product;
    }

    public function update($data, Product $product): bool
    {
        $data = $this->floats($data);
        $data['meta_url'] = $this->makeProductUrl($data);
        $success = $this->repository->update($product->id, $data);
        if ($success) {
            $product = $this->amenities($product, $data);
            if (isset($data['specialists'])) {
                $product = $this->specialists($product, $data['specialists']);
            }
        }
        return $success;
    }

    public function destroy(Product $product): bool
    {
        return $this->repository->destroy($product);
    }


    private function amenities(Product $product, $data)
    {
        $amenity = [];
        if (isset($data['amenities'])) {
            $amenity = array_merge($amenity, $data['amenities']);
        }
        if (isset($data['safety'])) {
            $amenity = array_merge($amenity, $data['safety']);
        }
        if (isset($data['recreations'])) {
            $amenity = array_merge($amenity, $data['recreations']);
        }
        $product->amenities()->sync([]);
        $product->amenities()->attach($amenity);

        return $product;
    }

    public function specialists(Product $product, $data = null)
    {
        $product->specialists()->sync([]);
        $product->specialists()->attach($data);
        return $product;
    }

    private function floats($data)
    {
        if (isset($data['total_area'])) {
            $data['total_area'] = $this->convert($data['total_area']);
        }
        if (isset($data['total_area_of_itens'])) {
            $data['total_area_of_itens'] = $this->convert($data['total_area_of_itens']);
        }
        if (isset($data['green_area'])) {
            $data['green_area'] = $this->convert($data['green_area']);
        }
        if (isset($data['common_area'])) {
            $data['common_area'] = $this->convert($data['common_area']);
        }
        return $data;
    }

    private function convert($number)
    {
        if (strpos($number, ',')) {
            $number = str_replace('.', '', $number);
            $number = str_replace(',', '.', $number);
        }
        return number_format($number, 2, '.', '');
    }

    public function status(Product $product)
    {
        $product->update(['active' => !$product->active]);
        return $product;
    }

    // Create the SEO URL when it's not set.
    public function makeProductUrl($data)
    {
        if (!$data['meta_url']) {
            $url = str_replace(' ', '-', $data['name']) .
                '-' . $this->checkTypeOfLand($data['state']) .
                '-a-venda-em-' . $data['state'];

            return strtolower($url);
        }

        return $data['meta_url'];
    }

    // Check the type of land and return its type.
    public function checkTypeOfLand($state = null): string
    {
        $typeof = '';

        if ($state) {
            switch ($state) {
                case 'AC, BA, CE, ES, MA, MT, PA, PR, PI, RJ, RS, SP, SE, TO':
                    $typeof = 'terreno';
                    break;
                case 'MG, GO':
                    $typeof = 'lote';
                    break;
                default:
                    $typeof = 'terreno';
                    break;
            }
        }

        return $typeof;
    }
}