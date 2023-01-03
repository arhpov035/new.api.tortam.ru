<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductShowResourse;
use App\Models\Product;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Mail;
use Mail;
use App\Mail\MailNotify;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($skip = 0)
    {
        $products = Product::where('published', true)->with(['user', 'category'])->skip($skip)->take(12)->get();
        $productCollection = ProductIndexResource::collection($products);
        return response($productCollection);
    }

    public function mail()
    {
        $data = [
            'subject' => 'Cambo Tutorial mail',
            'body' => 'Hello first email'
        ];

        try {
            Mail::to('arhipov035@gmail.com')->send(new MailNotify($data));
            return response()->json(['Great check you ']);
        }catch (Exception $th) {
            return response()->json(['Sorry Error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = new Product([
            'user_id' => $request->input('user_id'),
            'category_id' => $request->input('category_id'),
            'slug' => $request->input('slug'),
            'name' => $request->input('name'),
            'image' => $request->input('image'),
            'intro_text' => $request->input('intro_text'),
            'description' => $request->input('description'),
            'published' => $request->input('published'),
        ]);

        return response($product->save());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
//        $product = Product::where('published', true)->with(['user', 'category'])->findOrFail($id);
        $product = Product::whereSlug($slug)->where('published', true)->firstOrFail();
        return response(new ProductShowResourse($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(ProductUpdateRequest $request, $slug)
    public function update(Request $request, $slug)
    {
//        $product = Product::findOrFail(1);
//        $product = Product::whereSlug($slug)->firstOrFail();
//        $product = Product::where('published', true)->whereSlug($slug)->with(['category'])->firstOrFail();
        $product = Product::where('published', true)->whereSlug($slug)->firstOrFail();
//        $product->category_id = $request->input('category_id');

        $product->slug = $request->input('slug');
        $product->name = $request->input('name');
        $product->published = $request->input('published');

//        $product->image = $request->input('image');
//        $product->intro_text = $request->input('intro_text');
//        $product->description = $request->input('description');

        return response($product->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        return response($product->delete());
    }
}
