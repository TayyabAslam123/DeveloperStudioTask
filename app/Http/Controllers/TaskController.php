<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Session;
use Exception;
class TaskController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        ## If we have attachment we will place it storage folder and save its name in data base
        if($request->hasFile('attachment')){
            $filenameWithExt=$request->file('attachment')->getClientOriginalName();
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension=$request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('attachment')->storeAs('public/files',$fileNameToStore);
        }
        ## File name is null if we have no attachment 
        else{$fileNameToStore=null; }
        ## Creation of new Task
        $task=new Task;
        $task->title =$request->title;
        $task->description=$request->description;
        $task->status=$request->status;
        $task->list_id =$request->list_id;
        $task->attachment=$fileNameToStore;
        $task->save();
        Session::flash('message', 'TASK ADDED SUCCESSFULLY');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('/list');
    }

    catch(Exception $e)
      {
         Session::flash('message', $e->getMessage());
         Session::flash('alert-class', 'alert-danger'); 
        return redirect('/list');
      }
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    ## Updation of Task
    public function update(Request $request, $id)
    {
        
          try{
            ## If we have attachment we will place it storage folder and save its name in data base
            if($request->hasFile('attachment')){
                $filenameWithExt=$request->file('attachment')->getClientOriginalName();
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension=$request->file('attachment')->getClientOriginalExtension();
                $fileNameToStore=$filename.'_'.time().'.'.$extension;
                $path=$request->file('attachment')->storeAs('public/files',$fileNameToStore);
                ##delete previous one
                $data=Task::where('id',$id)->first();
                 if(\File::exists(public_path('storage/files/'.$data->attachment))){
                  \File::delete(public_path('storage/files/'.$data->attachment));
               }
          
          
              }
     
            $var = Task::findOrFail($id);
            $var->title = $request->title;
            $var->description = $request->description;
            $var->status = $request->status;
            $var->list_id=$request->list_id;
            if($request->hasFile('attachment')){
            $var->attachment=$fileNameToStore;
            }
            $var->save();
            Session::flash('message', 'UPDATED SUCCESSFULLY');
            Session::flash('alert-class', 'alert-success'); 
             return redirect('/list');
        }
            catch(Exception $e)
              {
                Session::flash('message', $e->getMessage());
                Session::flash('alert-class', 'alert-danger'); 
               
        return redirect('/list');
              }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    ## Deletion of task
    public function destroy($id)
    {
        try{
            $data=Task::findOrFail($id);
            if(\File::exists(public_path('storage/files/'.$data->attachment))){
                \File::delete(public_path('storage/files/'.$data->attachment));
             }
            $data->delete();
            Session::flash('message', 'TASK DELETED SUCCESSFULLY');
            Session::flash('alert-class', 'alert-success'); 
            return redirect('/list');
        }
            catch(Exception $e)
              {
                
                Session::flash('message', $e->getMessage());
                Session::flash('alert-class', 'alert-danger'); 
                return redirect('/list');
              }
    }
}
