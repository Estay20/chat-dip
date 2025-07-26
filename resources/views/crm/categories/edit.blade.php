@extends('crm.layouts.app')

@section('content')

<h2 class="mb-4 text-center">Редактирование Категории</h2>

<form action="{{ route('category.update', $category) }}" method="POST" enctype="multipart/form-data" class="w-50 mx-auto">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input class="form-control" type="text" name="name" id="name" value="{{ $category->name }}" required>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Картинка</label>
        <input class="form-control" type="file" name="file" id="file">
    </div>

    @if($category->image)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $category->image) }}" width="100" alt="">
        </div>
    @endif

    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Обновить</button>
    </div>
</form>

@endsection
