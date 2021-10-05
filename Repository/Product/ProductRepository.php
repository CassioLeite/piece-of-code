<?php

namespace App\Repository\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use App\Repository\AbstractRepository;

class ProductRepository  extends AbstractRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function all()
    {
        return $this->model->orderBy('name')->get();
    }

    public function dashboard()
    {
        return $this->model->all()->groupBy('vendor_id');
    }

    public function index($name, $relationships = 'tenant')
    {
        return  $this->model->whereHas($relationships, function ($q) use ($name) {
            $q->whereName($name);
        })->with($relationships)->orderBy('name')->get();
    }

    public function store($data): Product
    {
        return $this->model->updateOrCreate([
            'tenant_id' => $data['tenant_id'],
            'vendor_id' => $data['vendor_id'],
            'name' => $data['name']
        ], $data);
    }

    public function getByTenant($id)
    {
        return $this->model->whereTenantId($id)->orderBy('name')->get();
    }

    public function addCategory(Category $category, $products): bool
    {
        Product::whereCategoryId($category->id)->update(['category_id' => null]);
        return Product::whereIn('id', $products)->update(['category_id' => $category->id]);
    }

    public function getAvailableProducts()
    {
        return $this->model->all()->count();
    }

    public function destroy($product): bool
    {
        return $product->delete($product->id);
    }
}