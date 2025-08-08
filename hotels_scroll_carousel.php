<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels Scroll Carousel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .hotel-card {
        min-width: 280px;
        max-width: 280px;
        height: 420px;
        /* total height of card */
        display: flex;
        flex-direction: column;
    }

    .hotel-card img {
        height: 180px;
        object-fit: cover;
    }

    .hotel-card .card-body {
        flex-grow: 1;
        padding: 1rem;
    }
</style>

<body>
    <!-- Hotel Deals Horizontal Scroll -->
    <section class="py-3 bg-light">
        <div class="container">
            <h3 class="mb-4 fw-bold text-center text-danger">Top Hotel Deals for You</h3>

            <div class="position-relative">
                <!-- Scrollable Container -->
                <div id="hotelScroll" class="d-flex overflow-auto px-2 gap-3 pb-3" style="scroll-behavior: smooth;">

                    <!-- Hotel Card 1 -->
                    <div class="card flex-shrink-0 hotel-card">
                        <img src="images/hotel-1.jpg" class="card-img-top" alt="Hotel 1">
                        <div class="card-body">
                            <h5 class="card-title">Taj Palace, Delhi</h5>
                            <p class="card-text">5-star luxury in the heart of India’s capital.</p>
                            <p class="mb-1"><strong>₹9,500/night</strong></p>
                            <span class="badge bg-success">★ 4.8 (2,312)</span>
                        </div>
                    </div>

                    <!-- Hotel Card 2 -->
                    <div class="card flex-shrink-0 hotel-card">
                        <img src="images/beach resort.jpg" class="card-img-top" alt="Hotel 2">
                        <div class="card-body">
                            <h5 class="card-title">Leela Beach Resort, Goa</h5>
                            <p class="card-text">Ocean view rooms with complimentary breakfast.</p>
                            <p class="mb-1"><strong>₹6,800/night</strong></p>
                            <span class="badge bg-success">★ 4.5 (1,045)</span>
                        </div>
                    </div>

                    <!-- Hotel Card 3 -->
                    <div class="card flex-shrink-0 hotel-card">
                        <img src="images/jaipur palace-2.jpg" class="card-img-top" alt="Hotel 3">
                        <div class="card-body">
                            <h5 class="card-title">Jaipur Palace</h5>
                            <p class="card-text">Live like royalty in this heritage palace stay.</p>
                            <p class="mb-1"><strong>₹7,200/night</strong></p>
                            <span class="badge bg-success">★ 4.7 (934)</span>
                        </div>
                    </div>

                    <!-- Hotel Card 4 -->
                    <div class="card flex-shrink-0 hotel-card">
                        <img src="images/The Oberoi, Mumbai.jpeg" class="card-img-top" alt="Hotel 4">
                        <div class="card-body">
                            <h5 class="card-title">The Oberoi, Mumbai</h5>
                            <p class="card-text">Iconic sea-facing luxury hotel with fine dining.</p>
                            <p class="mb-1"><strong>₹10,400/night</strong></p>
                            <span class="badge bg-success">★ 4.9 (1,210)</span>
                        </div>
                    </div>

                    <!-- Hotel Card 5 -->
                    <div class="card flex-shrink-0 hotel-card">
                        <img src="images/treehouse.jpg" class="card-img-top" alt="Hotel 5">
                        <div class="card-body">
                            <h5 class="card-title">Treehouse Stay, Manali</h5>
                            <p class="card-text">Cozy treehouse in the lap of the Himalayas.</p>
                            <p class="mb-1"><strong>₹4,900/night</strong></p>
                            <span class="badge bg-success">★ 4.6 (672)</span>
                        </div>
                    </div>

                    <!-- Hotel Card 6 -->
                    <div class="card flex-shrink-0 hotel-card">
                        <img src="images/hotel-3.jpg" class="card-img-top" alt="Hotel 6">
                        <div class="card-body">
                            <h5 class="card-title">Ramada, Varanasi</h5>
                            <p class="card-text">Convenient hotel close to Ganga ghats.</p>
                            <p class="mb-1"><strong>₹5,200/night</strong></p>
                            <span class="badge bg-success">★ 4.3 (423)</span>
                        </div>
                    </div>

                    <!-- Hotel Card 7 -->
                    <div class="card flex-shrink-0 hotel-card">
                        <img src="images/hotel-4.jpg" class="card-img-top" alt="Hotel 7">
                        <div class="card-body">
                            <h5 class="card-title">Lalit Grand, Udaipur</h5>
                            <p class="card-text">Overlooks Lake Pichola with rooftop dining.</p>
                            <p class="mb-1"><strong>₹8,300/night</strong></p>
                            <span class="badge bg-success">★ 4.7 (1,113)</span>
                        </div>
                    </div>

                    <!-- Hotel Card 8 -->
                    <div class="card flex-shrink-0 hotel-card">
                        <img src="images/hotel-5.jpg" class="card-img-top" alt="Hotel 8">
                        <div class="card-body">
                            <h5 class="card-title">Jungle Stay, Jim Corbett</h5>
                            <p class="card-text">Eco-luxury resort in the forest reserve area.</p>
                            <p class="mb-1"><strong>₹5,700/night</strong></p>
                            <span class="badge bg-success">★ 4.4 (802)</span>
                        </div>
                    </div>

                </div>

                <!-- Scroll Arrows -->
                <button onclick="scrollHotel('left')"
                    class="btn btn-dark position-absolute top-50 start-0 translate-middle-y z-3 ms-2">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button onclick="scrollHotel('right')"
                    class="btn btn-dark position-absolute top-50 end-0 translate-middle-y z-3 me-2">
                    <i class="bi bi-chevron-right"></i>
                </button>

            </div>
        </div>
    </section>
</body>

</html>