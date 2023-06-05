<?php

namespace App\Http\Controllers;
use DB;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class UserController extends Controller
{
   
    public function index()
    {
      
        $data = User::orderBy('id', 'asc')->paginate(5);        
    
        return view('users.index', compact('data'));
    } 
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);
             $input = $request->all();
        $input['profile_image'] = $request->image_name;
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        $user = User::create($input);
        return redirect()->route('users')
                        ->with('success','User updated successfully');
    
      
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
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'confirmed',
        ]);
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = $request->password;
        if(!empty($input['password'])) { 
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));    
        }
        $input['role_id'] = $request->role_id;
        $input['status_id'] = $request->status_id;
    //     print_r($input);

    // die();
        $user = User::find($id);
        $user->update($input);
    
       
        return redirect()->route('users')
            ->with('success', 'User updated successfully.');
    }
     public function publish($id){
        
        $publish =  User::find($id);
        $publish->status_id = 0;
        $publish->save();
        return redirect('users');
    } 
    public function unpublish($id){
        $publish =  User::find($id);
        $publish->status_id = 1;
        $publish->save();
        return redirect('users');
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
        return redirect()->route('users')
            ->with('success', 'User Delete successfully.');
    }
}
