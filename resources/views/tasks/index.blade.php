@extends('layouts.app')

@section('title', 'Your tasks')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Your tasks</h1>
            <p class="subtitle">{{ $tasks->count() }} {{ \Illuminate\Support\Str::plural('task', $tasks->count()) }} on your list</p>
        </div>
        <a class="button" href="{{ route('tasks.create') }}">Add task</a>
    </div>

    @if ($tasks->isEmpty())
        <section class="empty">
            <h2>Your list is clear.</h2>
            <p>Add a task when something needs your attention.</p>
            <a class="button" href="{{ route('tasks.create') }}">Create your first task</a>
        </section>
    @else
        <div class="task-list">
            @foreach ($tasks as $task)
                <article class="task-row">
                    <div>
                        <div class="task-title">
                            <span>{{ $task->task_name }}</span>
                            <span class="badge {{ $task->status === 'Completed' ? 'complete' : '' }}">{{ $task->status }}</span>
                        </div>
                        @if ($task->description)
                            <p class="task-description">{{ $task->description }}</p>
                        @endif
                        <div class="task-meta">
                            @if ($task->due_date)
                                <span>Due {{ $task->due_date->format('M j, Y') }}</span>
                            @else
                                <span>No due date</span>
                            @endif
                        </div>
                    </div>
                    <div class="task-actions">
                        <form class="inline-form" action="{{ route('tasks.status', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}">
                            <button class="button secondary" type="submit">{{ $task->status === 'Pending' ? 'Complete' : 'Reopen' }}</button>
                        </form>
                        <a class="button secondary" href="{{ route('tasks.edit', $task) }}">Edit</a>
                        <form class="inline-form" action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button class="button danger" type="submit">Delete</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection