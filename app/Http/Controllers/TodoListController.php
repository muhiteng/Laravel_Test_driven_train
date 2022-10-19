<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index(){

        $list=TodoList::all();
        return Response($list);
    }
    public function show($id){

        $list=TodoList::find($id);
        return Response($list);
    }
}
