<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Management System : @yield('title')</title>

  <link href="/css/app.css" rel="stylesheet">
</head>

<body class="auth-page">
  <main class=" flex items-center justify-center" style="height: 100%">

    <div class="auth-container drop-shadow-lg rounded-md overflow-hidden bg-white" style="width: 480px">
      <div class="auth-page-title px-6 py-3 bg-primary">
        <h2 class="text-white text-center font-normal">@yield('title')</h2>
      </div>
      <div class="auth-page-content p-6">
        @yield('content')
      </div>
    </div>
  </main>
</body>

</html>