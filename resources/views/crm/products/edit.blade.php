@extends('crm.layouts.app')

@section('content')
<h2 class="mb-4">Редактирование товара</h2>

<form action="{{ route('product.update', $product) }}" style="max-width: 600px" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @csrf

  <div class="mb-3">
    <label for="name" class="form-label">Название</label>
    <input class="form-control" type="text" id="name" name="name" value="{{ $product->name }}">
  </div>

  <div class="mb-3">
    <label for="category" class="form-label">Категория</label>
    <select name="category_id" class="form-control" id="category">
      @foreach($categories as $category)
      @if($category->id == $product->category()->value('id'))
      <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
      @else
      <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
          {{ $category->name }}
        </option>
      @endif

      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="count" class="form-label">Количество</label>
    <input class="form-control" type="text" name="count" id="count" value="{{ $product->count }}">
  </div>

  <div class="mb-3">
    <label for="self_cost" class="form-label">Себестоимость</label>
    <input class="form-control" type="text" name="self_cost" id="self_cost" value="{{ $product->self_cost }}">
  </div>

  <div class="mb-3">
    <label for="cost" class="form-label">Стоимость</label>
    <input class="form-control" type="text" name="cost" id="cost" value="{{ $product->cost }}">
  </div>

  <div class="mb-3">
    <label for="formFile" class="form-label">Картинка</label>
    <input class="form-control" type="file" id="formFile" name="file">
  </div>

  <div class="mb-3">
    @if($product->image)
      <img src="{{ asset('storage/'.$product->image) }}" width="100" alt="Превью товара">
    @endif
  </div>

  <div class="mb-3">
    <button type="submit" class="btn btn-primary">Сохранить</button>
  </div>
</form>
@endsection
