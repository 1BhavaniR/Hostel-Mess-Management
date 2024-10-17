<?php include('includes/header.php'); ?>

<div class="content">
    <div class="container about mt-5">
        <!-- Title and Background Paragraph -->
        <h2 class="text-center mb-4">About Our College Hostels</h2>
        <div class="bg-opacity p-4 mb-5 text-center fade-in">
            <p>Welcome to our college hostels! We provide a safe, comfortable, and supportive living environment for our students. Our hostels are designed to foster a sense of community while offering all the necessary facilities to ensure a pleasant stay.</p>
        </div>

        <!-- Boys' Hostels Row -->
        <div class="row text-center mb-5">
            <div class="col-md-12">
                <h3 class="text-center mb-4">Boys' Hostels</h3>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card hostel-card">
                    <img src="assets/images/hostels/boys-hostel.jpg" class="card-img-top" alt="Boys Hostel">
                    <div class="card-body">
                        <h5 class="card-title">Boys' Hostels</h5>
                        <p class="card-text">Explore comfortable and well-facilitated boys' hostels available on campus.</p>
                        <a href="mens-hostel.php" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Girls' Hostels Row -->
        <div class="row text-center">
            <div class="col-md-12">
                <h3 class="text-center mb-4">Girls' Hostels</h3>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card hostel-card">
                    <img src="assets/images/hostels/g1.jpeg" class="card-img-top" alt="Girls Hostel">
                    <div class="card-body">
                        <h5 class="card-title">Girls' Hostels</h5>
                        <p class="card-text">Safe and secure accommodation for female students, ensuring comfort and convenience.</p>
                        <a href="womens-hostel.php" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional CSS -->
<style>
/* General Styling */
.bg-opacity {
    background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for the background */
}

.card-img-top {
    height: 300px; /* Adjust the image height */
    object-fit: cover;
}
.text-center {
    color: #333; /* Darker, professional color */
}
.btn-primary {
    background-color: #007bff; /* College blue color */
    border-color: #007bff;
    transition: background-color 0.3s ease; /* Smooth button color change */
}
.btn-primary:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Interactivity and Hover Effects */
.hostel-card:hover {
    transform: translateY(-10px); /* Slight lift effect on hover */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card {
    border: none; /* Remove border */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Additional Styling for Smooth Transitions */
.fade-in {
    opacity: 0;
    animation: fadeIn 1s forwards;
}
@keyframes fadeIn {
    to {
        opacity: 1;
    }
}
</style>

<!-- Additional JavaScript -->
<script>
$(document).ready(function() {
    $('.fade-in').css('opacity', '1'); // Trigger fade-in effect
});
</script>

<?php include('includes/footer.php'); ?>
