@extends('crm.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📝 Задачи</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Форма для добавления задачи -->
    <form method="POST" action="{{ route('tasks.store') }}" class="mb-4">
        @csrf
        <div class="row g-3">
            <div class="col">
                <input name="title" class="form-control" placeholder="Название задачи">
            </div>
            <div class="col">
                <input name="due_date" type="date" class="form-control">
            </div>
            <div class="col">
                <select name="status" class="form-select">
                    <option value="new">Новая</option>
                    <option value="progress">В работе</option>
                    <option value="done">Выполнена</option>
                </select>
            </div>
            <div class="col">
                <button class="btn btn-primary">➕ Добавить</button>
            </div>
        </div>
    </form>

    <!-- Таблица с задачами -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Дедлайн</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $i => $task)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>
                        <!-- Кнопка удаления -->
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Удалить задачу?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                        <!-- Модальное окно для редактирования (можно добавить позже) -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
