@extends('crm.layouts.app')

@section('content')

<h2 class="mb-4">👤 Пользователи</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Аватар</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>

            <td>
                <img src="{{ asset('storage/images/' . ($user->avatar ?? 'default.jpg')) }}"
                     alt="avatar"
                     width="40"
                     height="40"
                     style="object-fit: cover; border-radius: 50%;">
            </td>

            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <!-- Кнопка для модального окна -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user{{ $user->id }}">
                    Обновить
                </button>

                <!-- Форма удаления -->
                <form action="{{ route('user.destroy', $user) }}" method="POST" enctype="multipart/form-data" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>

        <!-- Модальное окно -->
        <div class="modal fade" id="user{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{ $user->id }}">Обновить: {{ $user->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Форма обновления -->
                    <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name{{ $user->id }}" class="col-sm-3 col-form-label">Имя:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name{{ $user->id }}" value="{{ $user->name }}" placeholder="Имя пользователя">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email{{ $user->id }}" class="col-sm-3 col-form-label">Email:</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="email{{ $user->id }}" value="{{ $user->email }}" placeholder="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password{{ $user->id }}" class="col-sm-3 col-form-label">Пароль:</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" id="password{{ $user->id }}" placeholder="Новый пароль (необязательно)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="file{{ $user->id }}" class="col-sm-3 col-form-label">Аватар:</label>
                                <div class="col-sm-9">
                                    @if($user->avatar && $user->avatar !== 'default.jpg')
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/images/' . $user->avatar) }}"
                                                 alt="avatar"
                                                 width="80"
                                                 height="80"
                                                 style="object-fit: cover; border-radius: 8px;">
                                        </div>
                                    @endif
                                    <input type="file" name="file" class="form-control mb-2" id="file{{ $user->id }}">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Обновить</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @endforeach
    </tbody>
</table>

@endsection