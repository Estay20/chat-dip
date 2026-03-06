# Chat-Dip
Дипломный проект
**CRM-система для малого бизнеса** на PHP и Laravel.
Проект позволяет управлять клиентами, задачами и содержит систему переписки между пользователями.

---

## 🚀 Возможности

* Регистрация и авторизация пользователей
* Управление клиентами
* Управление задачами
* Система переписки (чат) между пользователями
* CRUD операции

---

## 🛠 Стек технологий

**Backend:** PHP, Laravel, MySQL, REST API
**Frontend:** HTML, CSS, Bootstrap, Blade
**Версионный контроль:** Git / GitLab

---

## 📂 Структура проекта

```
app/                # Контроллеры и модели
routes/             # Web и API маршруты
resources/views/    # Blade шаблоны
database/migrations/ # Миграции базы данных
```

---

## ⚙️ Установка

1. Клонировать проект:

```bash
git clone https://github.com/Estay20/chat-dip.git
```

2. Перейти в папку проекта:

```bash
cd chat-dip
```

3. Установить зависимости:

```bash
composer install
```

4. Настроить `.env`:

```bash
cp .env.example .env
```

5. Сгенерировать ключ приложения:

```bash
php artisan key:generate
```

6. Выполнить миграции базы данных:

```bash
php artisan migrate
```

7. Запустить локальный сервер:

```bash
php artisan serve
```

---

## 👨‍💻 Автор

Estay
GitHub: https://github.com/Estay20
