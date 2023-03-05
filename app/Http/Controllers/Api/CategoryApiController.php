<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryApiController extends Controller
{

    public function index()
    {
        return response()->json(Category::all());
    }
}
