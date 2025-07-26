@extends('crm.layouts.app')

@section('content')
<h2 class="mb-4 text-center">Создание Категории</h2>
<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="w-50 mx-auto">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input class="form-control" type="text" name="name" id="name" required>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Картинка</label>
        <input class="form-control" type="file" name="file" id="file">
    </div>

    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Создать</button>
    </div>
</form>
@endsection
