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
class CategoriesController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }

    public function getHome($module)
    {
        $cats = Category::where('module', $module)->orderBy('name', 'ASC')->get();
        $data = ['cats' => $cats];
        return view('admin.categories.home', $data);

    }

    public function postCategoryAdd(Request $request)
    {
        $rules = [
    		'name'                              => 'required',
    		'file'                              => 'required',
        ];

        $messages = [
            'name.required'                     => 'Se requiere un nombre para crear la categoria.',
            'file.required'                     => 'Se requiere un icono para crear la categoria.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');

        else:

            $c = new Category;
            $c ->module             = e($request->input('module'));
            $c ->name               = e($request->input('name'));
            $c ->slug               = Str::slug($request->input('name'));
            $c ->file               = e($request->input('file'));

            if($c->save()):

                return back()->with('message', ' Clasificacón guardada con éxito.')->with('typealert', 'success');

            endif;

        endif;

    }

    public function getCategoryEdit($id)
    {
        $cat = Category::find( $id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    public function postCategoryEdit(Request $request, $id)
    {
        $rules = [
    		'name'                              => 'required',
    		'file'                              => 'required',
        ];

        $messages = [
            'name.required'                     => 'Se requiere un nombre para crear la categoria.',
            'file.required'                     => 'Se requiere un icono para crear la categoria.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');

        else:

            $c = Category::find( $id);
            $c ->module             = e($request->input('module'));
            $c ->name               = e($request->input('name'));
            $c ->slug               = Str::slug($request->input('name'));
            $c ->file               = e($request->input('file'));

            if($c->save()):

                return back()->with('message', ' Clasificacón guardada con éxito.')->with('typealert', 'success');

            endif;

        endif;

    }

    public function getCategoryDelete($id)
    {
        $c = Category::find( $id);

        if($c->delete()):

            return back()->with('message', ' Clasificacón elminada con éxito.')->with('typealert', 'success');

        endif;
    }
}
