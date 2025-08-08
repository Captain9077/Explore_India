<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Popular Food to Eat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fefefe;
      font-family: 'Segoe UI', sans-serif;
    }

    .section-title {
      text-align: center;
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 30px;
    }

    .food-card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
      transition: all 0.3s;
      text-align: center;
      background-color: white;
    }

    .food-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .food-card img {
      height: 160px;
      object-fit: cover;
      width: 100%;
    }

    .food-info {
      padding: 10px 5px;
    }

    .food-info h6 {
      margin: 0;
      font-size: 1rem;
      font-weight: 600;
    }

    .food-info small {
      color: #777;
    }

    .highlight-section {
      margin-top: 60px;
      text-align: center;
    }

    .highlight-text h5 {
      color: #e85d04;
      font-weight: 700;
    }

    .highlight-text p {
      color: #444;
      margin-top: 10px;
    }

    .highlight-image img {
      /* width: 60%; */
      max-width: 400px;
      border-radius: 10px;
      margin: 0 auto;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-explore {
      margin-top: 15px;
      border: 2px solid #e85d04;
      color: #e85d04;
      font-weight: 500;
      border-radius: 30px;
      padding: 6px 20px;
      transition: all 0.3s ease;
    }

    .btn-explore:hover {
      background: #e85d04;
      color: white;
    }
  </style>
</head>

<body>

  <div class="container py-5">
    <h5 class="section-title">🍴 Popular Food to Eat</h5>

    <div class="row justify-content-center g-4">
      <!-- Food Cards -->
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="card food-card">
          <img src="images/Samosa.jpg" alt="Samosa">
          <div class="food-info">
            <h6>Samosa</h6>
            <small>Chhatarpur, MP</small>
          </div>
        </div>
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="card food-card">
          <img src="images/Ragi Mudda-1.jpg" alt="Ragi Mudda">
          <div class="food-info">
            <h6>Ragi Mudda</h6>
            <small>Ananthapur, Andhra</small>
          </div>
        </div>
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="card food-card">
          <img src="images/Hyderabadi Biryani.jpg" alt="Hyderabadi Biryani">
          <div class="food-info">
            <h6>Hyderabadi Biryani</h6>
            <small>Hyderabad, Telangana</small>
          </div>
        </div>
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="card food-card">
          <img src="images/Bambooshoot Stew.jpg" alt="Bambooshoot Stew">
          <div class="food-info">
            <h6>Bambooshoot Stew</h6>
            <small>Aizawl, Mizoram</small>
          </div>
        </div>
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="card food-card">
          <img src="images/Chicken Popti-1.jpg" alt="Chicken Popti">
          <div class="food-info">
            <h6>Chicken Popti</h6>
            <small>Raigad, Maharashtra</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Highlight Section -->
    <div class="highlight-section mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6 highlight-text">
          <h5>Let's explore the diverse and flavourful culinary landscape of India:</h5>
          <p>
            India, a realm adorned with vibrant hues, steeped in profound traditions, and brimming with remarkable
            regional cuisines. Dive deep into the flavors!
          </p>
          <a href="#" class="btn btn-explore">Explore</a>
        </div>
        <div class="col-md-6 mt-4 mt-md-0 d-flex justify-content-center align-items-center">
          <div class="highlight-image">
            <img src="images/indian dish.jpg" alt="Explore Indian Food">
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>