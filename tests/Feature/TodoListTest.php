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
    public function test_while_storing_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

        $this->postJson(route('todo-list.store'))
            ->assertUnprocessable() // status 422= Unprocessable
            ->assertJsonValidationErrors(['name']);
    }
    public function test_delete_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy', $this->list->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->list->name]);
    }
    public function test_update_todo_list()
    {
        $this->patchJson(route('todo-list.update', $this->list->id), ['name' => 'updated name'])
            ->assertOk();

        $this->assertDatabaseHas('todo_lists', ['id' => $this->list->id, 'name' => 'updated name']);
    }

    public function test_while_updating_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

        $this->patchJson(route('todo-list.update', $this->list->id))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }
    
        

}
