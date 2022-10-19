<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    private $list;

    public function setUp(): void
    {
        parent::setUp();
       
        $this->list = $this->createTodoList([
            'name' => 'my list'
           
        ]);
    }
    // public function test_fetch_todo_list()
    // {
        // 1 prepare 
        // 2 action 
        // 3 assert 
    //}
    public function test_fetch_all_todo_list()
    {
       // $this->createTodoList(['name'=>'my list']);
        $response = $this->getJson(route('todo-list.index'))->json();

        $this->assertEquals(1, count($response));
        $this->assertEquals('my list', $response[0]['name']);
    }
    public function test_fetch_single_todo_list()
    {
        $response = $this->getJson(route('todo-list.show', $this->list->id))
            ->assertOk()
            ->json();
    }
    public function test_store_new_todo_list()
    {
        //make not store in db
        // create store in db 
        $list = TodoList::factory()->make();
        $response = $this->postJson(route('todo-list.store'), ['name' => $list->name])
            ->assertCreated()
            ->json();

        $this->assertEquals($list->name, $response['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $list->name]);
    }

        

}
