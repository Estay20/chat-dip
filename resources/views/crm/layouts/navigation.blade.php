<nav id="sidebar">
    <div class="p-4 pt-5">
        @php
            $avatar = Auth::user()->avatar ? 'images/' . Auth::user()->avatar : 'images/default.png';
        @endphp

        <a href="#" class="img logo rounded-circle mb-5"
           style="background-image: url('{{ asset('storage/' . $avatar) }}')">
        </a>

        <ul class="list-unstyled components mb-5">
            @include('crm.layouts.link', ['route' => '/crm', 'linkname' => 'Панель управления', 'name' => 'dashboard'])
            @include('crm.layouts.link', ['route' => route('order.index'), 'linkname' => 'Заказы', 'name' => 'orders'])
            @include('crm.layouts.link', ['route' => route('tasks.index'), 'linkname' => 'Задачи', 'name' => 'tasks'])
            @include('crm.layouts.link', ['route' => route('category.index'), 'linkname' => 'Категории', 'name' => 'categories'])
            @include('crm.layouts.link', ['route' => route('product.index'), 'linkname' => 'Товары', 'name' => 'products'])
            @include('crm.layouts.link', ['route' => route('user.index'), 'linkname' => 'Пользователи', 'name' => 'users'])
        </ul>
    </div>
</nav>