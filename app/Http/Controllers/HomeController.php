<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Clients;
use App\Tasks;
use App\Projects;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirect_user', ['only' => 'index']);
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->authorize('super-admin', Auth::user()->roles);
        $tasks = Tasks::orderBy('created_at', 'desc')->paginate(6);

        $data = [
            'tasks' => $tasks,
        ];
        return view('admin.dashboard')->with($data);
    }

    public function projectRender(Request $request) {

        // return $request;


        $client_id = $request->client_id;
    

        if ($request->project != 'all_059') {
            $tasks = Tasks::where('clients_id', '=', $client_id)
                                ->where('task_related_to', '=', $request->project)->get();
        } 

        if ($request->project == 'all_059') {
            $tasks = Tasks::where('clients_id', '=', $client_id)->get();
        } 



        $projects = Projects::where('clients_id', $client_id)->get();

        $data = [
            'projects' => $projects,
            'tasks' => $tasks,
        ];

    

        return $data;
        
    }
}
