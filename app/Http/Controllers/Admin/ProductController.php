<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Section;
use App\Models\Product;
use App\Http\Requests\Admin\SectionRequest;
use  App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{

    public function add(Request $request) : RedirectResponse
    {

        $request->validate([
            'name' => ['required','string'],
            'description' => ['required','string'],
            'image' => ['required','image','mimes:jpeg,png,jpg,gif'],
            'price' =>['required','integer']
        ]);


        $photo = $request->file('image');
        $manager = new ImageManager(new Driver());
        $image = $manager->read($photo);
        $image->resize(800, 800);

        // Generate a unique filename for the image
        $filename = time() . '_' . $photo->getClientOriginalName();
        $path = storage_path('app/public/Products/' . $filename);
        $image->save($path);

        $uploadedImagePaths[] = $filename;
        $jsonImagePaths = json_encode($uploadedImagePaths);

        Product::create([
            'product_name' => $request->name,
            'product_des' => $request->description,
            'product_image' => $jsonImagePaths,
            'product_price'=>$request->price,
            'section_id' => $request->section_id,
        ]);




        return Redirect::route('admin-products')->with('status', 'Section added successfully');
   }

   public function update(Request $request): RedirectResponse
   {

       $request->validate([
           'name' => ['required','string'],
           'description' => ['required', 'string'],

       ]);

       $section = Section::find($request->section_id);

       if (!$section) {
           return Redirect::route('admin-products')->with('error', 'Section not found');
       }

       if ($request->hasFile('image')) {

           $photo = $request->file('image');
           $manager = new ImageManager(new Driver());
           $image = $manager->read($photo);
           $image->resize(863, 458);

           // Generate a unique filename for the image
           $filename = time() . '_' . $photo->getClientOriginalName();
           $path = storage_path('app/public/Sections/' . $filename);
           $image->save($path);
           $uploadedImagePaths[] = $filename;
           $jsonImagePaths = json_encode($uploadedImagePaths);


           // Update section with new image
           $section->update([
               'section_name' => $request->name,
               'section_des' => $request->description,
               'section_image' => $jsonImagePaths,
           ]);
       } else {

           // Update section without changing the image
           $section->update([
               'section_name' => $request->name,
               'section_des' => $request->description,
           ]);
       }

       return Redirect::route('admin-products')->with('status', 'Section updated successfully');
   }

}
