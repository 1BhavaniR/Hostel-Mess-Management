<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Overview</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Section styles */
        .section {
            padding: 50px 0;
            text-align: center;
        }
        /* Hover animation styles */
        .hostel-card {
            cursor: pointer;
            transition: transform 0.5s ease-in-out, background-color 0.5s ease;
            padding: 40px;
            border-radius: 15px;
            background-color: #f8f9fa;
            margin: 30px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .hostel-card:hover {
            transform: translateY(-10px) scale(1.05);
            background-color: #ffc107;
        }
        .hostel-card h3 {
            font-size: 24px;
            font-family: 'Raleway', sans-serif;
        }
        .hostel-card p {
            font-size: 18px;
            color: #555;
        }
        /* Scroll smooth */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

<!-- Content at the top -->
<div class="container text-center mt-5">
    <h1 class="mb-4">Hostel Information</h1>
    <p class="lead">Explore the details of our Boys' and Girls' Hostels.</p>
</div>

<!-- Girls Hostel Section -->
<div id="girls" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="hostel-card" id="girlsHostel">
                    <h3>Girls Hostel</h3>
                    <p>Click to view G1 and G2 Hostels</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Girls Hostel Details -->
<div id="girlsDetails" class="section" style="display: none;">
    <div class="container">
        <h2 class="mb-4">Girls Hostel Details</h2>
        <ul>
            <li>G1 Hostel - Facilities and information</li>
            <li>G2 Hostel - Facilities and information</li>
        </ul>
    </div>
</div>

<!-- Boys Hostel Section -->
<div id="boys" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="hostel-card" id="boysHostel">
                    <h3>Boys Hostel</h3>
                    <p>Click to view B1, B2, and B3 Hostels</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Boys Hostel Details -->
<div id="boysDetails" class="section" style="display: none;">
    <div class="container">
        <h2 class="mb-4">Boys Hostel Details</h2>
        <ul>
            <li>B1 Hostel - Facilities and information</li>
            <li>B2 Hostel - Facilities and information</li>
            <li>B3 Hostel - Facilities and information</li>
        </ul>
    </div>
</div>

<script>
    // Show Girls Hostel details when clicked
    $('#girlsHostel').click(function() {
        $('html, body').animate({
            scrollTop: $('#girlsDetails').offset().top
        }, 800);
        $('#girlsDetails').slideDown();
    });

    // Show Boys Hostel details when clicked
    $('#boysHostel').click(function() {
        $('html, body').animate({
            scrollTop: $('#boysDetails').offset().top
        }, 800);
        $('#boysDetails').slideDown();
    });
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
