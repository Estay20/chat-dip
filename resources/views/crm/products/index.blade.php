@extends('crm.layouts.app')

@section('content')
<h2 class="mb-4">📈 Товары</h2>
<a href="{{route('product.create')}}" type="button" class="btn btn-primary mb-4">Создать</a>
<table class="table">
  <tbody>
    @foreach($products as $product)
    <tr>
      <th scope="row">{{$product->id}}</th>
      <td><img src="{{ asset('storage/' . $product->image) }}" width="50" alt=""></td>
      <td>{{$product->name}}</td>
      <td>{{$product->category->name}}</td>
      <td>{{$product->count}} шт.</td>
      <td>{{$product->cost}} ₸</td>
      <td>
        <a href="{{route('product.edit', $product)}}" type="button" class="btn btn-primary">Редактировать</a>
        <form action="{{ route('product.destroy', $product) }}" method="POST" style="display: inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить этот товар?')">Удалить</button>
      </form>

      </td>

    </tr>

    @endforeach
    </tr>
  </tbody>
</table>
@endsection