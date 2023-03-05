<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        try {
            $product = new Product([
                'name' => $request->input('name'),
                'category_id' => $request->input('category'),
                'description' => $request->input('description'),
                'date_time' => Carbon::parse($request->input('date'))->toDateTimeString()
            ]);
            $product->save();

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            Log::error($e);
            return response('Unable to create product', 400);
        }
    }

    public function show($id)
    {
        try {
            $entity = Product::find($id);
            return response()->json(['entity' => $entity]);
        } catch (Exception $e) {
            Log::error($e);
            return response('Unable to get product', 400);
        }
    }
    public function update(Request $request, $id )
    {
        try {
            $product_entity = Product::find($id);
            $data = [
                'name' => $request->input('name'),
                'category_id' => $request->input('category'),
                'description' => $request->input('description'),
                'date_time' => Carbon::parse($request->input('date'))->toDateTimeString()];

            log::info('new data: '.json_encode($data));

            $product_entity->update($data);

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            Log::error($e);
            return response('Unable to update product', 400);
        }

    }

    public function destroy($id)
    {
        try {
            Product::destroy($id);
            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            Log::error($e);
            return response('Unable to delete product', 400);
        }
    }
}
