<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Form;

class UserController extends Controller
{
    public $title = 'User';
    public $uri = 'users';
    public $folder = 'user';

    public function __construct(User $table)
    {
        $this->middleware('permission', ['except' => ['index', 'data']]);
        $this->table = $table;
    }

    public function index()
    {
        $data['title'] = $this->title;
        $data['desc'] = 'List';
        $data['ajax'] = route($this->uri.'.data');
        $data['create'] = route($this->uri.'.create');
        return view($this->folder.'.index', $data);
    }

    public function data(Request $request)
    {
        if (!$request->ajax()) { return; }
        $data = $this->table->select([
            'id', 'name', 'email', 'role', 'created_at'
        ]);
        return DataTables::of($data)
        ->editColumn('role', function ($index) {
            if($index->role == 'senior_hrd') {
                return '<span class="label label-success">Senior HRD</span>';
            } else {
                return '<span class="label label-info">Staff HRD</span>';
            }
        })
        ->editColumn('created_at', function ($index) {
            return isset($index->created_at) ? $index->created_at->format('d F Y') : '-';
        })
        ->addColumn('action', function ($index) {
            $tag = Form::open(array("url" => route($this->uri.'.destroy',$index->id), "method" => "DELETE"));
            $tag .= "<div class='btn-group'>";
            $tag .= (auth()->user()->role == "senior_hrd") ? "<a href=".route($this->uri.'.edit',$index->id)." class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a>" : "";
            $tag .= (auth()->user()->role == "senior_hrd") ? " <button type='submit' class='delete btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>" : "";
            $tag .= "</div>";
            $tag .= Form::close();
            return $tag;
        })
        ->rawColumns(['id', 'role', 'action'])
        ->make(true);
    }

    public function create()
    {
        $data['title'] = $this->title;
        $data['desc'] = 'Create';
        $data['action'] = route($this->uri.'.store');
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $request->merge([
            'password' => bcrypt($request->password)
        ]);

        $this->table->create($request->all());
        return redirect(route($this->uri.'.index'))->with('success', 'User has been created');
    }

    public function edit($id)
    {
        $data['title'] = $this->title;
        $data['desc'] = 'Edit';
        $data['user'] = $this->table->find($id);
        $data['action'] = route($this->uri.'.update', $id);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
            'role' => 'required'
        ]);
        
        if(empty($request->password)){
            unset($request['password']);
        } else {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
        }

        $this->table->find($id)->update($request->all());

        return redirect(route($this->uri.'.index'))->with('success', 'User has been updated');
    }

    public function destroy($id)
    {
        $tb = $this->table->find($id);
        $tb->delete();
        return redirect(route($this->uri.'.index'))->with('success', 'User has been deleted');
    }
}
