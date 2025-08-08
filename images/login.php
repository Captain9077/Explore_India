<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login to access</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<style>
  body {
    position: relative;
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 0.9;
  }

  .container-fluid {
    box-shadow: 0px 0px 20px -10px #7e7e7e;
    border-radius: 2px;
    width: 85%;
  }
</style>

<body>
  <div class="container-fluid">
    <div class="row mt-xxl-5">
      <div class="col-md-5 m-auto mt-5">
        <center class="p-xl-5 mb-5">

          <!-- 👇 बस यही line बदली गई है -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="email" class="form-label"><strong> Email address</strong></label>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label"><strong>Password</strong></label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
          <br>
          <a href="index.php"><button class="btn btn-primary">
              <h6>Home</h6>
            </button></a>
        </center>
      </div>
    </div>
  </div>
</body>

</html>

