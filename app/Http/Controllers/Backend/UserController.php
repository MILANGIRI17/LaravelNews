<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
;

class UserController extends Controller
{
    public function index(){
        $users=User::orderBy('id','desc')->paginate(5); 
        return view('backend.pages.users.index',compact('users'));
    }

    public function insert(Request $request){
        if($request->isMethod('get')){
            return view('backend.pages.users.create');
        }
        if($request->isMethod('post')){
            $this->validate($request,[
                'name'=>'required|min:3|max:50',
                'username'=>'required|min:3|max:50|unique:users,username',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:3|max:20|confirmed',
                'password_confirmation'=>'required',
                'gender'=>'required',
                'user_type'=>'required',
                'image'=>'mimes:jpg,png,jpeg,gif'
            ]);
            $data['name']=$request->name;
            $data['username']=$request->username;
            $data['email']=$request->email;
            $data['password']=bcrypt($request->password);
            $data['gender']=$request->gender;
            $data['user_type']=$request->user_type;
           
            if($request->hasFile('image')){
                $file= $request->file('image');
                $ext=$file->getClientOriginalExtension();
                $imageName=md5(microtime()).'.'.$ext;
                $uploadPath=public_path('uploads/users');
                 
                if(!$file->move($uploadPath,$imageName)){
                    return redirect()->back();
                }
                $data['image']=$imageName;
            }
            if(User::create($data)){
                return redirect()->route('users')->with('success','Data was inserted');
            }else{
                return redirect()->back()->with('error','There was some problem');
            }

        }
    }
    //for deleting image files
    public function deleteFiles($id){
        $user=User::findOrFail($id);
        $userImage=public_path('uploads/users/'.$user->image);
        if(file_exists($userImage) && is_file($userImage)){
            unlink($userImage);
            return true;
        }
        return true;
    }
    public function delete(Request $request){
        $id=$request->criteria;
        $userObj=User::findOrFail($id);
        if($this->deleteFiles($id)&&$userObj->delete()){
            return redirect()->back()->with('success','User deleted successfully');
        }else{
            return redirect()->back()->with('error','cannot  delete User');
        }
    }


    //edit
    public function edit(Request $request){
        $id=$request->criteria;
        $userData=User::findOrFail($id);
        return view('backend.pages.users.edit',compact('userData'));
    }
    public function editAction(Request $request){
        if($request->isMethod('get')){
            return redirect()->back();
        }
        if($request->isMethod('post')){
            $id=$request->criteria; 
            $this->validate($request,[
                'name'=>'required|min:3|max:50',
                'username'=>'required|min:3|max:50|',[
                    Rule::unique('users','username')->ignore($id)
                ],
                'email'=>'required|email|',[
                    Rule::unique('users','email')->ignore($id)
                ],
                'gender'=>'required',
                'user_type'=>'required',
                'image'=>'mimes:jpg,png,jpeg,gif'
            ]);
            $data['name']=$request->name;
            $data['username']=$request->username;
            $data['email']=$request->email;
            $data['gender']=$request->gender;
            $data['user_type']=$request->user_type;
           
            if($request->hasFile('image')){
                $file= $request->file('image');
                $ext=$file->getClientOriginalExtension();
                $imageName=md5(microtime()).'.'.$ext;
                $uploadPath=public_path('uploads/users');
                 
                if($this->deleteFiles($id) && $file->move($uploadPath,$imageName)){
                    $data['image']=$imageName;
                }
                
            }
            if(User::findOrFail($id)->update($data)){
                return redirect()->route('users')->with('success','Data updated successfully');  
            }else{
                return redirect()->back()->with('error','There was some problem');
            }
        }
    }


    //update user status
    public function updateUserStatus(Request $request)
    {
        
        if($request->isMethod('get')){
            return redirect()->back();
        }
        if($request->isMethod('post')){
        $id=$request->criteria;
        $obj=User::findOrFail($id);
            if(isset($_POST['active'])){
                $obj->status=0;
                $msgType='error';
                $msg="User is Offline";
            } 
            if(isset($_POST['inactive'])){
                $obj->status=1;
                $msgType='success';
                $msg="User is Online";
            }

            if($obj->update()){
                return redirect()->back()->with($msgType,$msg);
            }
        }
    }

    public function updateUserType(Request $request)
    {
        
        if($request->isMethod('get')){
            return redirect()->back();
        }
        if($request->isMethod('post')){
        $id=$request->criteria;
        $obj=User::findOrFail($id);
            if(isset($_POST['admin'])){
                $obj->user_type='user';
                $msgType='error';
                $msg="Changed to user";
            } 
            if(isset($_POST['user'])){
                $obj->user_type='admin';
                $msgType='success';
                $msg="Changed to admin";
            }

            if($obj->update()){
                return redirect()->back()->with($msgType,$msg);
            }
        }
    }
}
