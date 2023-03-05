<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function show($id)
    {
        $entity = Product::find($id);
        return Inertia::render('Products/Show', [
            'id' => $id,
            'entity' => $entity
        ]);
    }
}
