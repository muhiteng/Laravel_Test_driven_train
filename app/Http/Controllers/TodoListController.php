<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index(){

        $list=TodoList::all();
        return Response($list);
    }
    public function show(TodoList $todolist){

       
        return Response($todolist);
    }
    public function store(TodoListRequest $request)
    {
        $todo_list = TodoList::create($request->all());

        return $todo_list;
    }
    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
    public function update(TodoListRequest $request, TodoList $todo_list)
    {
        $todo_list->update($request->all());
        return $todo_list;
    }
}
