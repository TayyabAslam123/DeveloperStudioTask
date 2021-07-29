<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Session;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title='USERS';
        $headings= ["name"=>"Name","email"=>"Email"];
        ## all users
        $values=User::where('isadmin',0)->get();
        $url="user";
        ## making form to add user via array
        $data = [
           
            ['name'=>'NAME', "type"=>"text", "attrib"=>'required="required" name="name" maxlength="200"'],
            ['name'=>'EMAIL', "type"=>"email", "attrib"=>'required="required" name="email" maxlength="200"'],
            ['name'=>'PASSWORD', "type"=>"password", "attrib"=>'required="required" name="password" maxlength="200"'],
            ['name'=>'SET PERMISSION', "type"=>"select", "data"=>['0'=>"read only",'1'=>"edit access"], "attrib"=>'name="permission" ']];
          
        return view('user.index',compact('title','headings','values','url','data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $var = new User;
            $var->name = $request->name;
            $var->email = $request->email;
            $var->password = Hash::make($request->password);
            $var->permission = $request->permission;
          $var->save();
            Session::flash('message', 'ADDED SUCCESSFULLY');
            Session::flash('alert-class', 'alert-success'); 
            return redirect('/user');
       }
       catch(Exception $e){
                Session::flash('message', $e->getMessage());
                Session::flash('alert-class', 'alert-danger'); 
                return redirect('/user');
            }
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            User::findOrFail($id)->delete();
            Session::flash('message', 'DELETED SUCCESSFULLY');
            Session::flash('alert-class', 'alert-success'); 
            return redirect('/user');
        }
            catch(Exception $e)
              {
                
                Session::flash('message', $e->getMessage());
                Session::flash('alert-class', 'alert-danger'); 
                return redirect('/user');
              }
    }



}