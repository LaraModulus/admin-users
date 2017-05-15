<?php

namespace LaraMod\Admin\Users\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{

    private $data = [];

    public function __construct()
    {
        config()->set('admincore.menu.users.active', true);
    }

    public function index()
    {
        $this->data['users'] = User::paginate(20);

        return view('adminusers::users.list', $this->data);
    }

    public function getForm(Request $request)
    {
        $this->data['user'] = $request->has('id') ? User::find($request->get('id')) : new User();

        return view('adminusers::users.form', $this->data);
    }

    public function postForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.users.form')
                ->withErrors($validator)
                ->withInput();
        }


        $user = $request->has('id') ? User::find($request->get('id')) : new User();
        try {
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if ($request->has('password')) {
                $user->password = Hash::make($request->get('password'));
            }
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['message' => $e->getMessage()]);
        }

        return redirect()->route('admin.users')->with('message', [
            'type' => 'success',
            'text' => 'User saved.',
        ]);
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) {
            return redirect()->route('admin.users')->with('message', [
                'type' => 'danger',
                'text' => 'No ID provided!',
            ]);
        }
        try {
            User::find($request->get('id'))->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('message', [
                'type' => 'danger',
                'text' => $e->getMessage(),
            ]);
        }

        return redirect()->route('admin.users')->with('message', [
            'type' => 'success',
            'text' => 'User deleted',
        ]);
    }

    public function dataTable()
    {
        $items = User::select(['id', 'name', 'email', 'created_at']);

        return DataTables::of($items)
            ->addColumn('action', function ($item) {
                return '<a href="' . route('admin.users.form',
                        ['id' => $item->id]) . '" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>'
                    . '<a href="' . route('admin.users.delete',
                        ['id' => $item->id]) . '" class="btn btn-danger btn-xs require-confirm"><i class="fa fa-trash"></i></a>';
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at->format('d.m.Y H:i');
            })
            ->orderColumn('created_at $1', 'id $1')
            ->make('true');
    }


}