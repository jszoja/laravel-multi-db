<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class User extends Controller
{

    public function index( Request $request )
    {
        // set the database connection in the session
        if( $request->has('db') ) {
            $sessionVar = config('database.dynamic_connections.param');
            $request->session()->put( $sessionVar, ((int)$request->query('db')) );
        }

        // retrieve some course
        $courses = Course::where( 'active', 1 )->get();
        dump( $courses[0]->toArray() );
        $courses = Course::where( 'active', 0 )->get();
        dump( $courses[0]->toArray() );






    }


}
