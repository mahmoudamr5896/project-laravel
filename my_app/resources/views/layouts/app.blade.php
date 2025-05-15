<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <title>@yield('title', 'Default Title')</title>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body>
  <!-- Add Bootstrap Icons or Font Awesome in your <head> -->
<!-- Add Bootstrap Icons CDN in <head> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <!-- Left: Facebook logo + Search -->
    <a class="navbar-brand text-primary "  me-2" href="#">
      <i  class="bi bi-facebook fs-1"></i>
    </a>
    <form class="d-none d-lg-block">
      <input class="form-control rounded-pill" type="search" placeholder="Search Facebook" aria-label="Search" style="width: 300px;">
    </form>

    <!-- Center Icons -->
    <div class="mx-auto d-flex gap-5  align-items-center">
      <a  href="/" class="text-black me-4 fs-3"><i class="bi pe-4 bi-house-door-fill"></i></a>
      <a href="#" class="text-black me-4 fs-3"><i class="bi pe-4 bi-play-btn"></i></a>
      <a href="#" class="text-black me-4 fs-3"><i class="bi pe-4 bi-shop"></i></a>
      <a href="#" class="text-black me-4 fs-3"><i class="bi pe-4 bi-people-fill"></i></a>
      <a href="#" class="text-black me-4 fs-3"><i class="bi pe-4 bi-collection-play"></i></a>
    </div>

    <!-- Right Icons -->
    <div class="d-flex align-items-center gap-3">
      <a href="#" class="text-black me-4 fs-3"><i class="bi bi-grid-3x3-gap-fill"></i></a>
      <a href="#" class="text-black fs-3"><i class="bi bi-chat-dots-fill"></i></a>
      <a href="#" class="text-black fs-3"><i class="bi bi-bell-fill"></i></a>
      <!-- <a href="#" class="text-black">
        <img src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="Profile" class="rounded-circle" width="32" height="32">
      </a> -->
      <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="{{ Auth::user()->profile_photo_url ?? 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}" alt="Profile" class="rounded-circle" width="32" height="32">
  </a>
  <ul class="dropdown-menu dropdown-menu-end text-white bg-dark shadow" aria-labelledby="profileDropdown" style="width: 300px;">
    <li class="px-3 py-2 d-flex align-items-center">
      <img src="{{ Auth::user()->profile_photo_url ?? 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}" alt="Profile" class="rounded-circle me-2" width="40" height="40">
      <div>
        <strong>{{ Auth::user()->name ?? 'Mahmoud'}}</strong><br>
        <small><a href="{{ route('profile.show') }}" class="text-white text-decoration-none">See all profiles</a></small>
      </div>
    </li>
    <li><hr class="dropdown-divider"></li>

    <li><a class="dropdown-item text-white d-flex align-items-center" href="#"><i class="bi bi-gear me-2"></i> Settings & Privacy</a></li>
    <li><a class="dropdown-item text-white d-flex align-items-center" href="#"><i class="bi bi-question-circle me-2"></i> Help & Support</a></li>
    <li><a class="dropdown-item text-white d-flex align-items-center" href="#"><i class="bi bi-moon me-2"></i> Display & Accessibility</a></li>
    <li><a class="dropdown-item text-white d-flex align-items-center" href="#"><i class="bi bi-chat-dots me-2"></i> Give Feedback <kbd class="ms-1">CTRL B</kbd></a></li>
    <li>
      <form action="{{ route('logout') }}" method="POST" class="dropdown-item text-white p-0 m-0">
        @csrf
        <button class="btn btn-link text-white d-flex align-items-center w-100 px-3 py-2" type="submit">
          <i class="bi bi-box-arrow-right me-2"></i> Log out
        </button>
      </form>
    </li>
  </ul>
    </div>
  </div>
</nav>





<div class="container-fluid mt-5">
    @yield('content')
</div>

<!-- Footer -->
<!-- <div class="container my-5">
  <footer class="bg-dark text-center text-lg-start text-white">
    <div class="container p-4">
      <div class="row mt-4">
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">See other books</h5>
          <ul class="list-unstyled mb-0">
            <li><a href="#!" class="text-white"><i class="fas fa-book fa-fw fa-sm me-2"></i>Bestsellers</a></li>
            <li><a href="#!" class="text-white"><i class="fas fa-book fa-fw fa-sm me-2"></i>All books</a></li>
            <li><a href="#!" class="text-white"><i class="fas fa-user-edit fa-fw fa-sm me-2"></i>Our authors</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Execution of the contract</h5>
          <ul class="list-unstyled">
            <li><a href="#!" class="text-white"><i class="fas fa-shipping-fast fa-fw fa-sm me-2"></i>Supply</a></li>
            <li><a href="#!" class="text-white"><i class="fas fa-backspace fa-fw fa-sm me-2"></i>Returns</a></li>
            <li><a href="#!" class="text-white"><i class="far fa-file-alt fa-fw fa-sm me-2"></i>Regulations</a></li>
            <li><a href="#!" class="text-white"><i class="far fa-file-alt fa-fw fa-sm me-2"></i>Privacy policy</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Publishing house</h5>
          <ul class="list-unstyled">
            <li><a href="#!" class="text-white">The BookStore</a></li>
            <li><a href="#!" class="text-white">123 Street</a></li>
            <li><a href="#!" class="text-white">05765 NY</a></li>
            <li><a href="#!" class="text-white"><i class="fas fa-briefcase fa-fw fa-sm me-2"></i>Send us a book</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Write to us</h5>
          <ul class="list-unstyled">
            <li><a href="#!" class="text-white"><i class="fas fa-at fa-fw fa-sm me-2"></i>Help in purchasing</a></li>
            <li><a href="#!" class="text-white"><i class="fas fa-shipping-fast fa-fw fa-sm me-2"></i>Check the order status</a></li>
            <li><a href="#!" class="text-white"><i class="fas fa-envelope fa-fw fa-sm me-2"></i>Join the newsletter</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2021 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
  </footer>
</div> -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
</body>
</html>
