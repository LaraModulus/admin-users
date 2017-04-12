<?php
namespace LaraMod\AdminUsers;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
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
            'email' => 'required|email',
            'password' => 'confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.users.form')
                ->withErrors($validator)
                ->withInput();
        }


        $user = $request->has('id') ? User::find($request->get('id')) : new User();
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

        return redirect()->route('admin.users')->with('message', [
            'type' => 'success',
            'text' => 'User saved.'
        ]);
    }

    public function delete(Request $request){
        if(!$request->has('id')){
            return redirect()->route('admin.users')->with('message', [
                'type' => 'danger',
                'text' => 'No ID provided!'
            ]);
        }
        try {
            User::find($request->get('id'))->delete();
        }catch (\Exception $e){
            return redirect()->route('admin.users')->with('message', [
                'type' => 'danger',
                'text' => $e->getMessage()
            ]);
        }

        return redirect()->route('admin.users')->with('message', [
            'type' => 'success',
            'text' => 'User deleted'
        ]);
    }


}