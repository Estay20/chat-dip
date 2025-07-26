  @extends('crm.layouts.app')

@section('content')
<div class="container-fluid" style="margin-left: 10px;"> <!-- Сдвиг под sidebar -->
 <div class="table-wrapper">
<h2 class="mb-4">Панель управления</h2>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Месяц</th>
            <th scope="col">Новые заказы</th>
            <th scope="col">Закрытые заказы</th>
            <th scope="col">Количество проданных товаров</th>
            <th scope="col">Расходы</th>
            <th scope="col">Доход</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Январь</td>
            <td>50 шт.</td>
            <td>38 шт.</td>
            <td>49 шт.</td>
            <td>480463 ₸</td>
            <td>1345796 ₸</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Февраль</td>
            <td>50 шт.</td>
            <td>38 шт.</td>
            <td>49 шт.</td>
            <td>480463 ₸</td>
            <td>1345796 ₸</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Март</td>
            <td>50 шт.</td>
            <td>38 шт.</td>
            <td>49 шт.</td>
            <td>480463 ₸</td>
            <td>1345796 ₸</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>Апрель</td>
            <td>50 шт.</td>
            <td>38 шт.</td>
            <td>49 шт.</td>
            <td>480463 ₸</td>
            <td>1345796 ₸</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>Май</td>
            <td>50 шт.</td>
            <td>38 шт.</td>
            <td>49 шт.</td>
            <td>480463 ₸</td>
            <td>1345796 ₸</td>
        </tr>
    </tbody>
</table>
</div>
</div>
@endsection

