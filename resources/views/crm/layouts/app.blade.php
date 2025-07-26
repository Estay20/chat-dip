<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель управления</title>

    <!-- Bootstrap CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/style.css')}}">



    <style>
              body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        #sidebar {
            background: #1e1e1e;
            color: #fff;
            min-height: 100vh;
            width: 250px;
            position: fixed;
        }

        #sidebar .logo {
            display: block;
            width: 100px;
            height: 100px;
            margin: 20px auto;
            background-size: cover;
            background-position: center;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        #sidebar ul.components {
            padding-left: 0;
        }

        #sidebar ul li {
            padding: 10px 20px;
        }

        #sidebar ul li a {
            color: #ddd;
            display: block;
            text-decoration: none;
            transition: 0.3s;
        }

        #sidebar ul li a:hover,
        #sidebar ul li.active > a {
            color: orange;
            background: #2a2a2a;
            border-left: 4px solid orange;
            padding-left: 16px;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .table-wrapper {
            margin-top: 20px;
        }

        .table-custom {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table-custom thead {
            background-color: #2d2d2d;
            color: #fff;
        }

        .table-custom th,
        .table-custom td {
            vertical-align: middle;
            padding: 16px;
            font-size: 14px;
            border: none;
        }

        .table-custom tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .navbar {
            background-color: #fff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .navbar .btn-primary {
            background-color: #f8aa35;
            border-color: #f8aa35;
            color: #fff;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
        }

        .navbar .btn-primary:hover {
            background-color: #e89b28;
            border-color: #e89b28;
        }

        .navbar .nav-link,
        .navbar span {
            color: #333;
            font-weight: 500;
            margin-left: 15px;
        }

        h2 {
            font-weight: bold;
        }
        body {
      font-family: Arial, sans-serif;
    }

    #notification-container {
      position: fixed;
      top: 20px;
      right: 20px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      z-index: 9999;
    }

    .notification {
      display: flex;
      align-items: center;
      background-color: #fff;
      border-left: 5px solid #4caf50;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      min-width: 280px;
      max-width: 400px;
      transition: opacity 0.3s ease;
    }

    .notification-icon {
      font-size: 20px;
      margin-right: 10px;
    }

    .notification.success { border-color: #4caf50; }
    .notification.info    { border-color: #2196f3; }
    .notification.warning { border-color: #ff9800; }
    .notification.error   { border-color: #f44336; }
    .notification.bot     { border-color: #9c27b0; }

    .notification.success .notification-icon { color: #4caf50; }
    .notification.info    .notification-icon { color: #2196f3; }
    .notification.warning .notification-icon { color: #ff9800; }
    .notification.error   .notification-icon { color: #f44336; }
    .notification.bot     .notification-icon { color: #9c27b0; }

    .notification-message {
      flex: 1;
    }
    </style>
</head>
<body>

<div class="wrapper d-flex align-items-stretch">

    @include('crm.layouts.navigation')

    <!-- Page Content -->
    <div class="content">
    @yield('content')
</div>
    <!-- Модальное окно -->
    @include('crm.layouts.menu')
</div>

<div id="notification-container"></div>

<!-- Скрипты -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function showNotification(message, type = 'success', iconOverride = '') {
    const container = document.getElementById('notification-container');

    const notif = document.createElement('div');
    notif.classList.add('notification', type);

    const icon = document.createElement('span');
    icon.classList.add('notification-icon');

    // Иконки по типу
    if (iconOverride) {
      icon.innerHTML = iconOverride;
    } else {
      switch (type) {
        case 'success': icon.innerHTML = '✅'; break;
        case 'info':    icon.innerHTML = 'ℹ️'; break;
        case 'warning': icon.innerHTML = '⚠️'; break;
        case 'error':   icon.innerHTML = '❌'; break;
        case 'bot':     icon.innerHTML = '🤖'; break;
        default:        icon.innerHTML = '🔔';
      }
    }

    const text = document.createElement('div');
    text.classList.add('notification-message');
    text.textContent = message;

    notif.appendChild(icon);
    notif.appendChild(text);
    container.appendChild(notif);

    // Удалить через 6 секунд
    setTimeout(() => {
      notif.style.opacity = '0';
      setTimeout(() => notif.remove(), 300);
    }, 6000);
  }

  const crmMessages = [
    { message: 'Новый клиент добавлен в систему.', type: 'success' },
    { message: 'Истекает срок товара!', type: 'warning' },
  ];

  const botMessages = [
    'Совет: обновляйте карточку клиента после звонка для актуальности данных.',
    'Напоминание: вы давно не просматривали открытые сделки.',
    'AI Insight: клиенты, зарегистрированные более 7 дней назад, чаще требуют повторной коммуникации.',
    'Подсказка: завершайте задачи вовремя, чтобы не терять клиентов.',
    'AI-бот: проверьте активность по приоритетным лидам.',
  ];

  // Показывать уведомления от системы каждые 20 секунд
  setInterval(() => {
    const random = crmMessages[Math.floor(Math.random() * crmMessages.length)];
    showNotification(random.message, random.type);
  }, 20000);

  // Показывать уведомления от ИИ-бота каждые 45 секунд
  setInterval(() => {
    const randomMessage = botMessages[Math.floor(Math.random() * botMessages.length)];
    showNotification(randomMessage, 'bot', '🤖');
  }, 15000);

  // Сразу показать приветствие от бота
  showNotification('🤖 Привет! Я ваш ИИ-бот помощник. Я буду подсказывать полезные советы для работы в CRM.', 'bot', '🤖');
</script>
</body>
</html>