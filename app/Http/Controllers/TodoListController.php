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
    public function show(TodoList $todolist){

       
        return Response($todolist);
    }
    public function store(Request $request)
    {
        $todo_list = TodoList::create($request->all());

        return $todo_list;
    }
}
