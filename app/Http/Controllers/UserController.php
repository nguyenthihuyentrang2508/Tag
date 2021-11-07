<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Session;
class UserController extends Controller
{
    public function __construct() {     $this->middleware('auth');      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Tạo vai trò và quyền
        // Role::create(['name' => 'guest']);
        // Role::create(['name' => 'uploader']);
        // Permission::create(['name' => 'add chapter']);
        // Permission::create(['name' => 'edit chapter']);
        // Permission::create(['name' => 'delete chapter']);
        // Permission::create(['name' => 'add genre']);
        // Permission::create(['name' => 'edit genre']);
        // Permission::create(['name' => 'delete genre']);

        
        // $role = Role::find(2);
        // $permission = Permission::find(10);
        
        //Cấp quyền cho vai trò và cấp vai trò cho cái quyền đó
        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        //Đồng bộ
        // $role->syncPermissions($permissions);
        // $permission->syncRoles($roles);

        //Xóa quyền
        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role);

        //Cấp vai trò và xóa vai trò cho user        
        //auth()->user()->assignRole('uploader');
        // auth()->user()->removeRole('admin');

        //Đồng bộ cấp nhiều vai trò
        // auth()->user()->syncRoles(['admin', 'uploader']);

        //Cấp quyền cho user và gỡ quyền
        // auth()->user()->givePermissionTo('add story');
        // auth()->user()->revokePermissionTo('add story');

        //Đồng bộ cấp nhiều quyền
        // auth()->user()->syncPermissions(['admin', 'uploader']);
        
        $user = User::with('roles','permissions')->paginate(8);
        $admin = User::role('admin')->paginate(8); 
        $uploader = User::role('uploader')->paginate(8); 
        return view('admincp.user.index', compact('user','admin','uploader'));
    }
    public function phanvaitro($id){
        $user = User::find($id);
        // $name_roles = $user->roles->first()->name;
        $role = Role::orderBy('id','DESC')->get();
        $permission = Permission::orderBy('id','DESC')->get();
        $all_column_roles = $user->roles->first();
        return view('admincp.user.phanvaitro',compact('user','role','all_column_roles','permission'));
    }
    public function phanquyen($id){
        $user = User::find($id);
        // $name_roles = $user->roles->first()->name;
        // $role = Role::orderBy('id','DESC')->get();
        $name_roles = $user->roles->first()->name;
        $permission = Permission::orderBy('id','DESC')->get();
        $all_column_roles = $user->roles->first();
        //Lấy quyền ra
        $get_per_via_role = $user->getPermissionsViaRoles();
        return view('admincp.user.phanquyen',compact('user','all_column_roles','permission','name_roles', 'get_per_via_role'));
    }
    public function insert_roles(Request $request,$id){
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);
        $role_id = $user->roles->first()->id;
        // $user->removeRole($data['role']);
        // $user->assignRole($data['role']);

        
        return redirect()->back()->with('status','Phân vai trò cho user thành công');
    }
    public function insert_permission(Request $request,$id){
        $data = $request->all();
        $user = User::find($id);
        
        $role_id = $user->roles->first()->id;
        
        // $user->removeRole($data['role']);
        // $user->assignRole($data['role']);

        //Cấp quyền
        $role = Role::find($role_id);
        $role->syncPermissions($data['permission']);
        

        return redirect()->back()->with('status','Phân quyền cho user thành công');
    }
    public function add_permission(Request $request){
        $data = $request->all();
        $permission = new Permission();
        $permission->name = $data['permission'];
        $permission->save();
        return redirect()->back()->with('status','Thêm quyền thành công');
    }
    public function impersonate($id){
        $user = User::find($id);
        if($user){
            Session::put('impersonate',$user->id);

        }
        return redirect('/home');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.userProfile')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
            'intro' => 'max:255', 
            ],
            [    
                'intro.max' => 'Dòng giới thiệu không được dài quá 255 ký tự'
            ]
        );
        $user = User::find($id);
        $user->intro = $data['intro'];

        $get_image = $request->image;
        if($get_image){
            $path = 'public/uploads/avatar/'.$user->image;
            // if(file_exists($path)){
            //     unlink($path);
            // }
    
            $path = 'public/uploads/avatar/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            
            $user->image = $new_image;
        }    
        $user->save();
        return redirect()->back()->with('status','Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('status','Đã xóa user thành công');
    }

    public function timkiem(Request $request){
        $data = $request->all();
        $tukhoa = $data['tukhoa'];
        // $user = User::find(auth()->user()->id);   
        $admin = User::role('admin')->get(); 
        $uploader = User::role('uploader')->get(); 
        $list_user = User::with('roles','permissions')->where('name','LIKE','%'.$tukhoa.'%')->orWhere('email','LIKE','%'.$tukhoa.'%')->get();
        return view('admincp.user.search')->with(compact('list_user','tukhoa','uploader','admin'));
    }

    public function timkiem_ajax(Request $request){
        $data = $request->all();

        if($data['keywords']){
            $user = User::with('roles','permissions')->where('name','LIKE', '%'.$data['keywords'].'%')->orWhere('email','LIKE', '%'.$data['keywords'].'%')->get();

            $output = '
                <div class="dropdown-menu" style="display: block";>
            ';

            foreach($user as $key => $tr){
                $output .= '
                 <a herf="#" class="li_timkiem_ajax dropdown-item">'.$tr->name.'</a>         
                ';
            }
            $output .= '</div>';
            echo $output;
        }
    }

    public function settings(Request $request, $id)
    {
        $data = $request->validate(
            [
            'name' => 'max:50', 
            'email' => 'max:50|unique:users|email',
            ],
            [    
                'name.max' => 'Tên không được dài quá 50 ký tự',
                'email.max' => 'Tên không được dài quá 50 ký tự',
                'email.unique' => "Email này đã tồn tại"
            ]
        );
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        $get_image = $request->image;
        if($get_image){
            $path = 'public/uploads/avatar/'.$user->image;
            // if(file_exists($path)){
            //     unlink($path);
            // }
    
            $path = 'public/uploads/avatar/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            
            $user->image = $new_image;
        }    
        $user->save();
        return redirect()->back()->with('status','Lưu thành công');
    }

    public function change_password(Request $request, $id)
    {
        $data = $request->validate(
            [
            'password' => 'required|max:50|min:8|confirmed', 
            ],
            [    
                'password.max' => 'Mật khẩu không được dài quá 50 ký tự',
                'password.min' => 'Mật khẩu không được ít hơn 8 ký tự',
                'password.requireds' => 'Bắt buộc phải nhập mật khẩu',

            ]
        );
        $user = User::find($id);
        $user->password =  Hash::make($data['password']);
        

        $user->save();
        return redirect()->back()->with('status','Đổi mật khẩu thành công');
    }
}
