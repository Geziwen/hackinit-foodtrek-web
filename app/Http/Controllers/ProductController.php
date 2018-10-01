<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function plant(Request $request) {
        $user = Auth::user();
        $user->products()->create([
            'type_id' => $request->get('type_id'),
        ]);

    }

    public function harvest(Request $request, $id) {
        $product = Product::find($id);
        try {
            $this->authorize('harvest', $product);
        } catch (AuthorizationException $exception) {
            return ['status' => 404, 'msg' => 'unauthorized.'];
        }
        $product->update('harvested_at', Carbon::now());
        return ['status' => 200, 'msg' => 'success'];
    }

}
