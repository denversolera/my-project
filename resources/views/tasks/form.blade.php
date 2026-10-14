@extends('layouts.app')

@php($editing = $task->exists)

@section('title', $editing ? 'Edit task' : 'Add task')

@section('content')
    <div class="form-shell">
        <a class="subtitle" href="{{ route('tasks.index') }}">&larr; All tasks</a>
        <h1>{{ $editing ? 'Edit task' : 'Add a task' }}</h1>
        <form class="form-card" action="{{ $editing ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
            @csrf
            @if ($editing)
                @method('PUT')
            @endif

            <div class="field">
                <label for="task_name">Task name</label>
                <input id="task_name" name="task_name" type="text" value="{{ old('task_name', $task->task_name) }}" maxlength="255" required autofocus>
                @error('task_name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="description">Description <span class="hint" style="display:inline">(optional)</span></label>
                <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
                @error('description') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="due_date">Due date <span class="hint" style="display:inline">(optional)</span></label>
                <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
                @error('due_date') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <button class="button" type="submit">{{ $editing ? 'Save changes' : 'Add task' }}</button>
                <a class="button secondary" href="{{ route('tasks.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection