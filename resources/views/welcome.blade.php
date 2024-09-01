<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>

.navbar-brand {
      font-size: 1.75rem;
      font-weight: bold;
      color: #007bff; 
    }

    .navbar-nav .nav-link {
      margin-left: 15px;
    }

 


    .main-title {
      margin-top: 50px; 
    }

    .main-image {
      display: block;
        width: 60%;
      height: 60%;
      margin: 20px auto; 
    }

  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid shadow">
      <a class="navbar-brand m-3 text-body" href="/">BetterCareer</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav me-5">
          <li class="nav-item ">
            <a class="nav-link" href="{{route('login')}}"><button class=" btn btn-info">Login</button></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}"><button class="btn btn-light">Register</button></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container text-center">
    <h1 class="main-title">Welcome to Better Carrer Website</h1>
    <p class="text-muted">Welcome to Better Career, your go-to platform for career development and opportunities. <br>
    Explore our resources to elevate your professional journey. 
    Stay tuned for exciting updates 
    <br>and new features that will help you achieve your career goals.</p>






    
    <img src='{{asset("images/imageb.jpg")}}' alt="Website Image" class="main-image">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
