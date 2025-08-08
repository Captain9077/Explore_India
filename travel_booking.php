<?php
include('db_connect.php');

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Please login first'); window.location.href='login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['travel_booking'] = [
        'trip_type' => $_POST['trip_type'],
        'mode' => $_POST['mode'],
        'from_city' => $_POST['from_city'],
        'to_city' => $_POST['to_city'],
        'departure_date' => $_POST['departure_date'],
        'return_date' => $_POST['trip_type'] == 'Round Trip' ? $_POST['return_date'] : null,
        'travellers' => $_POST['travellers'],
        'travel_class' => $_POST['travel_class']
    ];

    // Calculate mock amount
    $amount = 500 * $_POST['travellers']; // mock pricing

    $mode = urlencode($_POST['mode']);
    $name = urlencode($_POST['from_city'] . " to " . $_POST['to_city']);
    header("Location: mock_payment.php?type=$mode&name=$name&price=$amount");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Travel - Explore India</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }

        .booking-form {
            background: bisque;
            /* background-image: url('images/banaras-1.jpg'); */
            background-size: cover;
            background-position: center;
            opacity: 0.7;
            z-index: -1;
            padding: 40px;
            border-radius: 15px;
            margin: 20px auto;
            max-width: 800px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container booking-form">

        <form method="POST">
            <!-- Mode of Travel -->
            <div class="mb-3">
                <label class="fw-bold">Mode of Travel</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mode" id="modeFlight" value="Flight" checked>
                    <label class="form-check-label fw-bold" for="modeFlight">✈️ Flight</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mode" id="modeTrain" value="Train">
                    <label class="form-check-label fw-bold" for="modeTrain">🚆 Train</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mode" id="modeBus" value="Bus">
                    <label class="form-check-label fw-bold" for="modeBus">🚌 Bus</label>
                </div>
            </div>

            <!-- Trip Type -->
            <div class="mb-3">
                <label class="fw-bold">Trip Type</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="trip_type" value="One Way" id="oneWay" checked>
                    <label class="form-check-label fw-bold" for="oneWay">One Way</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="trip_type" value="Round Trip" id="roundTrip">
                    <label class="form-check-label fw-bold" for="roundTrip">Round Trip</label>
                </div>
            </div>

            <!-- City Suggestion Datalist -->
            <datalist id="cityList">
                <option value="New Delhi">
                <option value="Mumbai">
                <option value="Bangalore">
                <option value="Hyderabad">
                <option value="Kolkata">
                <option value="Chennai">
                <option value="Ahmedabad">
                <option value="Pune">
                <option value="Jaipur">
                <option value="Goa">
                <option value="Lucknow">
                <option value="Varanasi">
                <option value="Indore">
                <option value="Agra">
                <option value="Amritsar">
            </datalist>

            <!-- Travel Fields -->
            <div class="row">
                <div class="col-md-6 mb-3 ">
                    <label class="fw-bold">From</label>
                    <input type="text" name="from_city" class="form-control" placeholder="Departure city"
                        list="cityList" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">To</label>
                    <input type="text" name="to_city" class="form-control" placeholder="Destination city"
                        list="cityList" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Departure Date</label>
                    <input type="date" name="departure_date" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3 return-group" style="display: none;">
                    <label class="fw-bold">Return Date</label>
                    <input type="date" name="return_date" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Travellers</label>
                    <input type="number" name="travellers" class="form-control" min="1" value="1" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Travel Class</label>
                    <select name="travel_class" class="form-select" id="classSelect">
                        <option value="Economy">Economy</option>
                        <option value="Business">Business</option>
                        <option value="First">First</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button Centered -->
            <div class="text-center">
                <button type="submit" class="btn btn-danger mt-3 px-5 py-2 fw-bold">🔍 Book Now</button>
            </div>
        </form>
    </div>

    <script>
        const oneWay = document.getElementById('oneWay');
        const roundTrip = document.getElementById('roundTrip');
        const returnGroup = document.querySelector('.return-group');
        const modeRadios = document.querySelectorAll('input[name="mode"]');
        const classSelect = document.getElementById('classSelect');

        function updateClassOptions(mode) {
            let options = '';
            if (mode === 'Flight') {
                options += '<option value="Economy">Economy</option>';
                options += '<option value="Business">Business</option>';
                options += '<option value="First">First</option>';
            } else if (mode === 'Train') {
                options += '<option value="Sleeper">Sleeper</option>';
                options += '<option value="AC">AC</option>';
                options += '<option value="General">General</option>';
            } else if (mode === 'Bus') {
                options += '<option value="Sleeper">Sleeper</option>';
                options += '<option value="Seater">Seater</option>';
                options += '<option value="AC">AC</option>';
            }
            classSelect.innerHTML = options;
        }

        // Event Listeners
        modeRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                updateClassOptions(radio.value);
            });
        });

        oneWay.addEventListener('change', () => {
            returnGroup.style.display = 'none';
        });

        roundTrip.addEventListener('change', () => {
            returnGroup.style.display = 'block';
        });

        // Initial setup
        if (roundTrip.checked) returnGroup.style.display = 'block';
        updateClassOptions(document.querySelector('input[name="mode"]:checked').value);
    </script>

</body>

</html>