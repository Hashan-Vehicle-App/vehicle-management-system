<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Management System : @yield('title')</title>

  <link href="/css/app.css" rel="stylesheet">
</head>

<body class="auth-page">
  <main class="d-flex align-items-center justify-content-center" style="height: 100%">

    <div class="auth-container rounded overflow-hidden bg-white" style="width: 480px">
      <div class="auth-page-title px-4 py-3 bg-primary">
        <h4 class="text-white text-center mb-0">@yield('title')</h4>
      </div>
      <div class="auth-page-content p-4">
        @yield('content')
      </div>
    </div>


    <a href="/" class="position-fixed" style="bottom: 20px;">Go to Home</a>
  </main>
</body>

</html>