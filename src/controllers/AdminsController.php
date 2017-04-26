<?php
namespace LaraMod\Admin\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use LaraMod\Admin\Core\Models\Admin;

class AdminsController extends Controller
{

    private $data = [];
    public function __construct()
    {
        config()->set('admincore.menu.admins.active', true);
    }
    public function index()
    {
        $this->data['users'] = Admin::paginate(20);
        return view('adminusers::admins.list', $this->data);
    }

    public function getForm(Request $request)
    {
        $this->data['user'] = $request->has('id') ? Admin::find($request->get('id')) : new Admin();

        return view('adminusers::admins.form', $this->data);
    }

    public function postForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.admins.form')
                ->withErrors($validator)
                ->withInput();
        }


        $user = $request->has('id') ? Admin::find($request->get('id')) : new Admin();
        try{
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if($request->has('password')){
                $user->password = Hash::make($request->get('password'));
            }
            $user->save();
        }catch (\Exception $e){
            return redirect()->back()->withInput()->withErrors(['message' => $e->getMessage()]);
        }

        return redirect()->route('admin.admins')->with('message', [
            'type' => 'success',
            'text' => 'User saved.'
        ]);
    }

    public function delete(Request $request){
        if(!$request->has('id')){
            return redirect()->route('admin.admins')->with('message', [
                'type' => 'danger',
                'text' => 'No ID provided!'
            ]);
        }
        try {
            Admin::find($request->get('id'))->delete();
        }catch (\Exception $e){
            return redirect()->route('admin.admins')->with('message', [
                'type' => 'danger',
                'text' => $e->getMessage()
            ]);
        }

        return redirect()->route('admin.admins')->with('message', [
            'type' => 'success',
            'text' => 'User deleted'
        ]);
    }


}