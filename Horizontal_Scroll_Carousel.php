<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Explore India - Inspiration Carousel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    section.carousel-section {
      padding: 40px 0;
      background: #f8f9fa;
    }

    #carouselScroll {
      overflow-x: auto;
      scroll-behavior: smooth;
      display: flex;
      gap: 15px;
      padding-bottom: 15px;
      scroll-snap-type: x mandatory;
    }

    #carouselScroll::-webkit-scrollbar {
      display: none;
    }

    .scroll-card {
      flex: 0 0 auto;
      scroll-snap-align: center;
      width: 90vw;
      max-width: 350px;
      border: none;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .scroll-card video {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .scroll-card .card-body {
      padding: 1rem;
      text-align: center;
    }

    .scroll-card .card-body p {
      margin: 0;
      white-space: normal;
      font-weight: 500;
    }

    .scroll-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 10;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    .scroll-arrow i {
      font-size: 20px;
      color: #333;
    }

    .arrow-left {
      left: -20px;
    }

    .arrow-right {
      right: -20px;
    }

    .carousel-wrapper {
      position: relative;
    }

    @media (max-width: 576px) {
      .scroll-arrow {
        display: none !important;
      }

      .scroll-card {
        width: 90vw;
      }
    }
  </style>

</head>

<body>

  <section class="carousel-section">
    <div class="container carousel-wrapper">
      <h3 class="text-center fw-bold text-success mb-4">Inspiration to get you going</h3>

      <!-- LEFT ARROW -->
      <button class="btn scroll-arrow arrow-left" onclick="scrollCarousel('left')">
        <i class="bi bi-chevron-left"></i>
      </button>

      <!-- SCROLLABLE CARDS -->
      <div id="carouselScroll" class="d-flex">
        <div class="card scroll-card">
          <a href="destinations.php" class="text-black text-decoration-none">
            <video autoplay muted loop playsinline>
              <source src="videos/taj mahal video.mp4" type="video/mp4">
            </video>
            <div class="card-body text-center">
              <p class="fw-semibold mb-0">Stargaze around India</p>
            </div>
          </a>
        </div>

        <div class="card scroll-card">
          <a href="destinations.php" class="text-black text-decoration-none">
            <video autoplay muted loop playsinline>
              <source src="videos/video-1.mp4" type="video/mp4">
            </video>
            <div class="card-body text-center">
              <p class="fw-semibold mb-0">Explore art cities</p>
            </div>
          </a>
        </div>

        <div class="card scroll-card">
          <a href="destinations.php" class="text-black text-decoration-none">
            <video autoplay muted loop playsinline>
              <source src="videos/food trip-1.mp4" type="video/mp4">
            </video>
            <div class="card-body text-center">
              <p class="fw-semibold mb-0">13 delicious food trips</p>
            </div>
          </a>
        </div>

        <div class="card scroll-card">
          <a href="destinations.php" class="text-black text-decoration-none">
            <video autoplay muted loop playsinline>
              <source src="videos/himalayan adventure-1.mp4" type="video/mp4">
            </video>
            <div class="card-body text-center">
              <p class="fw-semibold mb-0">Himalayan Adventures</p>
            </div>
          </a>
        </div>

        <div class="card scroll-card">
          <a href="destinations.php" class="text-black text-decoration-none">
            <video autoplay muted loop playsinline>
              <source src="videos/desert safari.mp4" type="video/mp4">
            </video>
            <div class="card-body text-center">
              <p class="fw-semibold mb-0">Desert Safari</p>
            </div>
          </a>
        </div>
      </div>

      <!-- RIGHT ARROW -->
      <button class="btn scroll-arrow arrow-right" onclick="scrollCarousel('right')">
        <i class="bi bi-chevron-right"></i>
      </button>
    </div>
  </section>

  <script>
    const carousel = document.getElementById('carouselScroll');
    const scrollAmount = 320;

    function scrollCarousel(direction) {
      if (direction === 'left') {
        carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
      } else {
        carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      }
    }

    setInterval(() => {
      if (carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth) {
        carousel.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      }
    }, 3000);
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>