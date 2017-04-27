<?php
namespace LaraMod\Admin\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use LaraMod\Admin\Core\Models\Admin;
use Yajra\Datatables\Datatables;

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

    public function dataTable(){
        $items = Admin::select(['id','name', 'email', 'created_at']);
        return DataTables::of($items)
            ->addColumn('action', function($item){
                return '<a href="'.route('admin.admins.form', ['id' => $item->id]).'" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>'
                    .'<a href="'.route('admin.admins.delete', ['id' => $item->id]).'" class="btn btn-danger btn-xs require-confirm"><i class="fa fa-trash"></i></a>';
            })
            ->editColumn('created_at', function($item){
                return $item->created_at->format('d.m.Y H:i');
            })
            ->orderColumn('created_at $1','id $1')
            ->make('true');
    }


}