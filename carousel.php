<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore India Carousel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS  */
        .custom-carousel-item {
            background-color: #ff5a5f;
            border-radius: 8px;
            overflow: hidden;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .custom-carousel-item .row {
            height: 100%;
            width: 100%;
            margin: 0;
        }

        .custom-carousel-img {
            height: 100%;
            overflow: hidden;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            position: relative;
        }

        .custom-carousel-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .image-credit {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85em;
        }

        .custom-carousel-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            color: white;
            padding: 20px 40px;
            text-align: left;
        }

        .custom-carousel-content h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .custom-carousel-content p {
            font-size: 1.1rem;
            margin-bottom: 25px;
        }

        .custom-carousel-content .btn-primary {
            background-color: white;
            color: #ff5a5f;
            border: none;
            padding: 10px 25px;
            font-weight: bold;
            border-radius: 25px;
        }

        .custom-carousel-content .btn-primary:hover {
            background-color: #f0f0f0;
            color: #ff5a5f;
        }

        @media (max-width: 767.98px) {
            .custom-carousel-item {
                height: auto;
                flex-direction: column;
            }

            .custom-carousel-img {
                width: 100%;
                height: 250px;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
                border-bottom-left-radius: 0;
            }

            .custom-carousel-content {
                width: 100%;
                padding: 30px 20px;
                text-align: center;
                align-items: center;
            }

            .custom-carousel-content h1 {
                font-size: 2rem;
            }

            .custom-carousel-content p {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>


    <div class="container my-2">
        <div id="ExploreIndiaCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="custom-carousel-item">
                        <div class="row g-0">
                            <div class="col-md-7 custom-carousel-img">
                                <img src="images/surrfing.jpg" class="d-block w-100"
                                    alt="Diver with Octopus">
                                <span class="image-credit">@925laceyc</span>
                            </div>
                            <div class="col-md-5 custom-carousel-content">
                                <h1>Book the best part of your trip</h1>
                                <p>Browse unforgettable things to do—right here.</p>
                                <a href="destinations.php" class="btn btn-primary">Find things to do</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="custom-carousel-item" style="background-color: #1a64d1;">
                        <div class="row g-0">
                            <div class="col-md-7 custom-carousel-img">
                                <img src="images/breathtaking landscape.jpg"
                                    class="d-block w-100" alt="Mountain View">
                                <span class="image-credit">@explorer_life</span>
                            </div>
                            <div class="col-md-5 custom-carousel-content">
                                <h1>Discover breathtaking landscapes</h1>
                                <p>Explore majestic mountains and serene valleys.</p>
                                <a href="destinations.php" target="_blank" class="btn btn-primary">Start exploring</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="custom-carousel-item" style="background-color: #008489;">
                        <div class="row g-0">
                            <div class="col-md-7 custom-carousel-img">
                                <img src="images/beach.jpg" class="d-block w-100"
                                    alt="Beach Relaxation">
                                <span class="image-credit">@Explore_India_travels</span>
                            </div>
                            <div class="col-md-5 custom-carousel-content">
                                <h1>Relax on pristine beaches</h1>
                                <p>Find your perfect spot under the sun.</p>
                                <a href="destinations.php" class="btn btn-primary">Find beaches</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#ExploreIndiaCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#ExploreIndiaCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#ExploreIndiaCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#ExploreIndiaCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#ExploreIndiaCarousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>