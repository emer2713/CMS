<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use App\PGallery;
use App\Product;
use App\User;
use Config;
use Str;
use Image;

class ProductsController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }

    public function getHome()
    {
        $products = Product::with(['cat'])->orderBy('id', 'DESC')->paginate(20);
        $data = ['products' => $products];
        return view('admin.products.home', $data);

    }

    public function getProductAdd()
    {
        $cats = Category::where('module', 0)->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);

    }

    public function postProductAdd(Request $request)
    {
        $rules = [
    		'name'                              => 'required',
            'file'                              => 'required',
            'price'                             => 'required',
            'content'                           => 'required'
        ];

        $messages = [
            'name.required'                     => 'El nombre del producto es requerido.',
            'file.required'                     => 'Seleccione una imagen destacada del producto.',
            'file.image'                        => 'El archivo no es una imagen.',
            'price.required'                    => 'El precio del producto es requerido.',
            'content.required'                  => 'LA descripción del producto es requerida.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput() ;

        else:

            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('file')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_absolute = $upload_path.'/'.$path.'/'.$filename;

            $product = new Product;
            $product->status                = '0';
            $product ->name                 = e($request->input('name'));
            $product ->slug                 = Str::slug($request->input('name'));
            $product ->category_id          = $request->input('category');
            $product ->file_path            = date('Y-m-d');
            $product ->file                 = $filename;
            $product ->price                = $request->input('price');
            $product ->in_discount          = $request->input('indiscount');
            $product ->discount             = $request->input('discount');
            $product ->content              = e($request->input('content'));

            if($product->save()):

                if($request->hasFile('file')):
                    $fl = $request->file->storeAs($path, $filename, 'uploads');
                    $imag = Image::make($file_absolute);
                    $imag->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $imag->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;

                return redirect('/admin/products')->with('message', ' Prodcuto actualizado con éxito.')->with('typealert', 'success');

            endif;

        endif;
    }

    public function getProductEdit($id)
    {
        $product        = Product::findOrFail($id);
        $cats           = Category::where('module', 0)->pluck('name', 'id');
        $data           = ['cats' => $cats, 'product' => $product];
        return view('admin.products.edit', $data);
    }

    public function postProductEdit(Request $request, $id)
    {
        $rules = [
    		'name'                              => 'required',
            'price'                             => 'required',
            'content'                           => 'required'
        ];

        $messages = [
            'name.required'                     => 'El nombre del producto es requerido.',
            'price.required'                    => 'El precio del producto es requerido.',
            'content.required'                  => 'LA descripción del producto es requerida.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');

        else:

            $product                        = Product::findOrFail( $id);
            $imagepp                        = $product->file_path;
            $imagep                         = $product->file;
            $product->status                = e($request->input('status'));
            $product ->name                 = e($request->input('name'));
            $product ->category_id          = $request->input('category');
            $product ->slug                 = Str::slug($request->input('name'));
            if($request->hasFile('file')):

                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('file')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_absolute = $upload_path.'/'.$path.'/'.$filename;

                $product ->file_path            = date('Y-m-d');
                $product ->file                 = $filename;

            endif;

            $product ->price                = $request->input('price');
            $product ->in_discount          = $request->input('indiscount ');
            $product ->discount             = $request->input('discount ');
            $product ->content              = e($request->input('content'));

            if($product->save()):

                if($request->hasFile('file')):
                    $fl = $request->file->storeAs($path, $filename, 'uploads');
                    $imag = Image::make($file_absolute);
                    $imag->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $imag->save($upload_path.'/'.$path.'/t_'.$filename);
                    Storage::disk('uploads')->delete('/'.$imagepp.'/'.$imagep);
                    Storage::disk('uploads')->delete('/'.$imagepp.'/t_'.$imagep);
                endif;

                return back()->with('message', ' Prodcuto actualizado con éxito.')->with('typealert', 'success');

            endif;


        endif;

    }

    public function getProductDelete($id)
    {
        $product = Product::find( $id);

        if($product->delete()):

            return back()->with('message', ' Producto elminado con éxito.')->with('typealert', 'success');

        endif;
    }


    public function postProductGalleryAdd($id, Request $request)
    {

        $rules = [
    		'file_image'                        => 'required',
        ];

        $messages = [
            'file_image.required'               => 'Seleccione una imagen.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

        else:
            if($request->hasFile('file_image')):

                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');

                $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_absolute = $upload_path.'/'.$path.'/'.$filename;

               $g =new PGallery;
               $g->product_id = $id;
               $g->file_path = date('Y-m-d');
               $g->file_name = $filename;

               if($g->save()):

                    if($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                        $imag = Image::make($file_absolute);
                        $imag->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $imag->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;

                    return back()->with('message', ' Imagen guardada con éxito.')->with('typealert', 'success');

                endif;
            endif;
        endif;

    }

    public function getProductGalleryDelete($id, $gid)
    {
        $g = PGallery::findOrFail( $gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');

        if($g->product_id != $id):

            return back()->with('message', 'La imagen no se puede eliminar.')->with('typealert', 'danger');

        else:

            if($g->delete()):

                Storage::disk('uploads')->delete('/'.$path.'/'.$file);
                Storage::disk('uploads')->delete('/'.$path.'/t_'.$file);
                return back()->with('message', 'Imagen borrada con éxito.')->with('typealert', 'success');

            endif;

        endif;
    }

}

