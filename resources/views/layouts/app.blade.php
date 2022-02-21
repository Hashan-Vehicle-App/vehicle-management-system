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
              <a href="#" class="active"><i class="fab fa-chrome mr-2"></i> Dashboard</a>
            </li>
            <li>
              <a href="#"><i class="fas fa-chart-line  mr-2"></i> Reports</a>
            </li>
            <li>
              <a href="#"><i class="fas fa-cog mr-2"></i> Settings</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    <div id="app-right-column" class="w-full">
      <header id="app-header" class="flex justify-between">
        <div class="page-title">
          Dashboard
        </div>

        <div class="header-nav">
          <ul>
            <li>
              <form action="{{ route('adminLogout') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-sm bg-primary leading-4 text-white"
                  style="font-weight: 500">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </header>

      <main>
        @yield('content')
      </main>
    </div>
  </div>

</body>

</html>