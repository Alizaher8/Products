<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Section;
use App\Models\Product;
use  App\Http\Controllers\Controller;

class FrontSectionController extends Controller
{

    public function showSections()
    {
       $sections= Section::get();

        return  response()->json($sections);
   }
   public function showProducts(Request $request)
    {
        $sectionId = $request->query('section_id');

        // Query the products based on the section_id
        $products = Product::where('section_id', $sectionId)->get();
        return response()->json($products);
   }
   public function showOneProduct(Request $request)
    {
        $productId = $request->query('product_id');

        // Query the products based on the section_id
        $oneProduct = Product::where('id', $productId)->get();
        return response()->json($oneProduct);
   }
}
