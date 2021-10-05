<?php

namespace App\Repository\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function all();
    public function dashboard();
    public function index($item);
    public function find($id = null);
    public function store($data): Product;
    public function update($id, $data): bool;
    public function destroy($id): bool;
    public function addCategory(Category $category, $products): bool;
}