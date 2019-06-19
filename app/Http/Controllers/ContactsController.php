<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ContactsController extends Controller
{
    public function get(){
        $contacts = User::all();
        return response()->json($contacts);
    }
}
