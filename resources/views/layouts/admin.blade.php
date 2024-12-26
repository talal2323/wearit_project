<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WearIT</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    
</head>

<body>

<nav class="navbar navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">WearIT</a>
    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
    <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
    <a class="nav-link" href="{{ route('admin.categories.index') }}">Category</a>
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-link nav-link">Logout</button>
      </form>
  </div>
</nav>

@yield('content')    


<script src="{{ asset('js/main.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/1742a6fc29.js" crossorigin="anonymous"></script>

</body>