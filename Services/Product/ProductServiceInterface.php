<?php

namespace App\Services\Admin\Product;

use App\Models\Product;

interface ProductServiceInterface
{
    public function dashboard();

    public function index($item);

    public function store($data) :Product ;
    public function find($id);

    public function destroy(Product $product): bool;

    public function update($data, Product $product): bool;

    public function specialists(Product $product, $data = null);
}