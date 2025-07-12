<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Klinik Gigi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .topbar { background-color: #2dc997; color: white; padding: 5px 0; }
    .navbar-brand span { color: #2dc997; font-weight: bold; }
    .hero-section { background-image: url('https://source.unsplash.com/1200x600/?hospital'); background-size: cover; background-position: center; }
    .hero-overlay { background-color: rgba(255, 255, 255, 0.8); padding: 60px 20px; }
  </style>
</head>
<body>

@if (!isset($hideNavbar) || !$hideNavbar)
    @include('partials.navbar')
@endif


  <main class="container-fluid p-0">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
