<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Management System : @yield('title')</title>

  <link href="/css/app.css" rel="stylesheet">
</head>

<body>

  <div id="app-container">
    <div id="app-left-column">
      <div class="inner-container">
        <div class="app-title">
          VMS APP
        </div>

        <nav class="app-nav">
          <ul>
            <li>
              <a href="{{ route('clientDashboard') }}" class="active">Dashboard</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    <div id="app-right-column" class="w-100">
      <header id="app-header" class="d-flex justify-content-between">
        <div class="page-title">
          @yield('title')
        </div>

        <div class="header-nav">
          <ul class="list-unstyled">
            <li>
              <form action="{{ route('userLogout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-default" style="font-weight: 500">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </header>

      <main class="page-content">
        @yield('content')
      </main>
    </div>
  </div>

</body>

</html>