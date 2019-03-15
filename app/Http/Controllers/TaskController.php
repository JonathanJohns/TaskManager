<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use App\Projects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $tasks = Tasks::where('clients_id', Auth::user()->clients_id )->orderBy('created_at', 'desc')->paginate(6);

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

        // $image = $request->file('image')->hashName();
        // return $image;
        // return Auth::user()->clients_id;

        $subject = $request->subject ;
        $priority = $request->priority ;
        $description = $request->description ;
        $related_to = $request->task_related_to ;
        $user = Auth::id();

        $task = new Tasks;
        $task->subject = $subject;
        $task->priority = $priority;
        $task->description = $description;
        $task->task_related_to = $related_to;
        $task->users_id = $user;
        $task->clients_id = Auth::user()->clients_id;






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
        $tasks = Tasks::find($id);
        $tasks->status = 1;
        $tasks->save();

        $success = [
            'message' => 'success',
            'description' => 'Marked as Done',
            'id' => $id,
        ];

        return $success;
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


    public function taskShow(Request $request, $id) {

        //gets specified tasks based on client and date

    }

    public function selectProject() {

        $client_id = Auth::user()->clients_id;

        return Projects::where('clients_id', $client_id)->get();
    }
}
