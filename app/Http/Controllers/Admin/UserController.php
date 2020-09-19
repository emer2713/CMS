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

class UserController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }

    public function getUsers($status)
    {

        if($status == 'all'):

            $users = User::orderBy('id', 'Desc')->paginate(25);

        else :

            $users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(25);

        endif;

        $data           = ['users' => $users];
        return view('admin.users.home', compact('users'));

    }

    public function getUserEdit($id)
    {
        $user           = User::findOrFail($id);
        $data           = ['user' => $user];
        return view('admin.users.users_edit', $data);

    }

    public function getUserBanned($id)
    {
        $user    = User::findOrFail($id);
        if($user->status == "100"):

            $user->status = "0";
            $msg = "Usuario activado con éxito.";

        else :

            $user->status = "100";
            $msg = "Usuario suspendido con éxito.";

        endif;

        if($user->save()):

            return back()->with('message', $msg)->with('typealert', 'success');

        endif;

        $data           = ['user' => $user];
        return view('admin.users.users_edit', $data);

    }

    public function getUserPermissions($id)
    {
        $user    = User::findOrFail($id);

        $data           = ['user' => $user];
        return view('admin.users.users_permissions', $data);

    }


    //validations
    public function postUserPermissions(Request $request, $id)
    {
        $user    = User::findOrFail($id);

        $permissions = [

                    'dashboard'                     => $request->input('dashboard'),

                    'user_list'                     => $request->input('user_list'),
                    'users_edit'                     => $request->input('users_edit'),
                    'users_banned'                   => $request->input('users_banned'),
                    'users_permissions'              => $request->input('users_permissions'),

                    'products'                      => $request->input('products'),
                    'products_add'                   => $request->input('products_add'),
                    'products_edit'                  => $request->input('products_edit'),
                    'products_delete'                => $request->input('products_delete'),
                    'product_gallery_add'            => $request->input('product_gallery_add'),
                    'product_gallery_delete'        => $request->input('product_gallery_delete'),

                    'categories'                    => $request->input('categories'),
                    'categories_add'                  => $request->input('categories_add'),
                    'categories_edit'                 => $request->input('categories_edit'),
                    'categories_delete'               => $request->input('categories_delete'),

                    ];
        $permissions = json_encode($permissions);
        $user->permissions = $permissions;

        if ($user->save()):
            return back()->with('message', 'Los permisos de ususario fueron actualizados con exito')->with('typealert', 'success');
        endif;

    }


}

