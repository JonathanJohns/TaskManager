<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        //

        $tasks = Tasks::orderBy('created_at', 'desc')->paginate(6);

        $data = [
            'tasks' => $tasks,
        ];


        
        return view('admin.pages.task.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.pages.task.create');
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

        $subject = $request->subject ;
        $priority = $request->priority ;
        $description = $request->description ;
        $related_to = $request->task_related_to ;

        $task = new Tasks;
        $task->subject = $subject;
        $task->priority = $priority;
        $task->description = $description;
        $task->task_related_to = $related_to;






        if ($task->save()) {

            $success = array('message' => 'success', 'subject' => $subject , 'description' => $description , 'priority' => $priority, 'task_related_to' => ucwords(str_replace('_', ' ',$related_to)) , 'task_id' => $task->id  );
            return $success;
        }
        


        
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

        $profile = Tasks::find($id);

        return $profile->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
