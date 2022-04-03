<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />

  <!-- Ziggy routes -->
  @routes

  <script src="{{ mix('/js/app.js') }}" defer></script>

  @inertiaHead
</head>

<body class="h-100">
  @inertia
</body>

</html>