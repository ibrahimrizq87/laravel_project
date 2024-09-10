<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to BetterCarrer</title>
  <link rel="icon" href="{{ asset('images/logoo.jpg') }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar-nav .nav-link {
      margin-left: 15px;
    }


    .overlay {
    background-color: rgba(0, 0, 0, 0.6); /* Black overlay with 60% opacity */
    z-index: 1; /* Make sure overlay is on top of the image */
}

/* Styling for the text */
.overlay-text {
    z-index: 2; /* Higher than the overlay so the text is visible */
    color: white;
  }

/* Adjust main title */
.main-title {
    font-size: 3rem;
    font-weight: bold;
}

/* Adjust paragraph text */
.text-muted {
    font-size: 1.2rem;
    line-height: 1.5;
    color: white;
 
}

/* Responsive adjustments */

  </style>
</head>

<body>

  <nav class="nav navbar navbar-expand-lg shadow-lg" style="height:60px">
    <div class="container-fluid">
      <a class="navbar-brand m-3 text-body" href="/"><img src="{{asset("images/word.jpg")}}" width="140" height="40" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav me-5">
          <li class="nav-item ">
            <a class="nav-link" href="{{route('login')}}"><button class="btn" style="background-color:#102C57;color:#ffffff">Login</button></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}"><button class="btn btn-light">Register</button></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 
  <div class="container-fluid p-0 position-relative">
    <div class="position-relative">
        <img src="{{ asset('images/imageb.jpg') }}" alt="Website Image" class="img-fluid w-100 h-50">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
        <div class="overlay-text position-absolute top-50 start-50 translate-middle text-center">
            <h1 class="main-title text-white">Welcome to Better Career Website</h1>
            <p class="text-muted" style="color:#ffffff">
                Welcome to Better Career, your go-to platform for career development and opportunities. <br>
                Explore our resources to elevate your professional journey. <br>
                Stay tuned for exciting updates and new features that will help you achieve your career goals.
            </p>
        </div>
    </div>
</div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js "></script>
</body>

</html>