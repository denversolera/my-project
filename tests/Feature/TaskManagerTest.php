<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_can_be_created_edited_completed_and_deleted(): void
    {
        $this->post(route('tasks.store'), [
            'task_name' => 'Read Laravel docs',
            'description' => 'Review routing and Blade.',
            'due_date' => '2026-10-20',
        ])->assertRedirect(route('tasks.index'));

        $task = Task::firstOrFail();
        $this->assertSame('Pending', $task->status);
        $this->get(route('tasks.index'))->assertOk()->assertSee('Read Laravel docs');

        $this->put(route('tasks.update', $task), [
            'task_name' => 'Practice Laravel CRUD',
            'description' => 'Build the task manager.',
            'due_date' => '2026-10-21',
        ])->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'task_name' => 'Practice Laravel CRUD']);

        $this->patch(route('tasks.status', $task), ['status' => 'Completed'])
            ->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'status' => 'Completed']);

        $this->delete(route('tasks.destroy', $task))->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_task_name_is_required(): void
    {
        $this->from(route('tasks.create'))
            ->post(route('tasks.store'), ['task_name' => ''])
            ->assertRedirect(route('tasks.create'))
            ->assertSessionHasErrors('task_name');

        $this->assertDatabaseCount('tasks', 0);
    }
}