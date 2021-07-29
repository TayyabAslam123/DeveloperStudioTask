<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use App\Task;
use Session;
use Exception;
class ListController extends Controller
{   
    
    private $url="task";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr=[];
        $task=Task::all();
        $lists=Listing::orderBy('id', 'DESC')->get();
        ## Making a key value pair for list and its task's
        ## Designing a key like
        ## Id-title-completedcount-incompletecount
        foreach($lists as $list){
            $completed=Task::where('list_id',$list->id)->where('status',1)->count();
            $incomplete=Task::where('list_id',$list->id)->where('status',0)->count();
            $arr[$list->id."-".$list->title."-".$completed."-".$incomplete]=Task::where('list_id',$list->id)->get();  
         }

        $url=$this->url;
        return view('list',compact('arr','url'));
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
        $list=new Listing;
        $list->title =$request->input('title');
        $list->save();
        Session::flash('message', 'LIST ADDED SUCCESSFULLY');
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
