<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Clients;
use App\Tasks;
use App\Projects;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    //

    public function __contruct() {
        $this->middleware('auth');
        
    }


    public function index() {
        $this->authorize('super-admin', Auth::user()->roles);
        return view('admin.pages.settings.index');
    }

    // Add client to database 

    public function storeClient(Request $request) {
        
        $failed = array('message' => 'failed', 'error' => "Please fill in the Client's name");
         $client = $request->name;
        $client_raw = strtolower(str_replace([' ', '-'], '_', $client));

        
        if ($request->filled('name')) {

            

            $clients = new Clients;

            $clients->client = $client;
            $clients->client_raw = $client_raw;

            if($clients->save()) {
                $success = array('message' => 'success' , 'name' => $client);

                return $success ;
            }


            

        } 

        return $failed;
    }


    public function showClient() {
        
        $client = Clients::all();

        return $client;
    }

    public function storeProject(Request $request) {

            // return $request;

            $failed = array('message' => 'failed', 'error' => "Please fill in the Project name");


            if ($request->filled('project_name')) {
                $project_name = $request->project_name;

                $project_name_raw = strtolower(str_replace([' ', '-'], '_', $project_name));

                $projects = new Projects;

                $projects->project_name = $project_name;
                $projects->project_name_raw = $project_name_raw;
                $projects->clients_id = $request->client_name;

                if($projects->save()) {
                    $success = array('message' => 'success' , 'name' => $project_name);

                    return $success ;
                }
            } else {
                return $failed;

            }



    }
}
