<?php include('includes/header.php'); ?>
<section id="about-home">
        <h2> HOSTELS FOR MENS</h2>
        <p>Our college provides well-maintained and comfortable boys' hostels to ensure a healthy and productive living environment. We have multiple hostel blocks, each equipped with essential amenities and services to accommodate 350 to 400 students per block.</p>
    </section>
<div class="container mt-5">

<!--     
    <h2 class="text-center mb-4">Boys' Hostels</h2>

    
    <div class="bg-light p-4 mb-5 text-center">
        <p style="font: strong">Our college provides well-maintained and comfortable boys' hostels to ensure a healthy and productive living environment. We have multiple hostel blocks, each equipped with essential amenities and services to accommodate 350 to 400 students per block.</p>
    </div> -->

    <!-- Hostel 1: Paari Hostel -->
    <div class="row mb-5 d-flex align-items-stretch">
        <div class="col-md-4 d-flex">
            <img src="assets/images/hostels/b1.png" class="img-fluid rounded align-self-stretch" alt="Paari Hostel">
        </div>
        <div class="col-md-8">
            <div class="bg-light p-4 shadow rounded h-100">
                <h4>Boys Hostel 1</h4>
                <p>Boys' Hostel 1 is a well-maintained accommodation facility for up to 204 students. It provides a secure and comfortable environment to promote student well-being and academic focus. The rooms are non-AC, with communal washroom facilities located conveniently on each floor.<br><br>This hostel offers round-the-clock water and electricity, ensuring students have uninterrupted access to essential services.

                The hostel's amenities include high-speed Wi-Fi, a common lounge area with a TV, and indoor recreational facilities for games such as carrom, chess, and table tennis.<br>Additionally, the hostel is equipped with study spaces and quiet zones to aid in students' learning and concentration.<br>
                </p>
                <p><strong>Email:</strong> warden.paari@college.edu</p>
                <p><strong>Mobile:</strong> 8056016611</p>
            </div>
        </div>
    </div>

    <!-- Hostel 2: Kaari Hostel -->
    <div class="row mb-5 d-flex align-items-stretch">
        <div class="col-md-8">
            <div class="bg-light p-4 shadow rounded h-100">
                <h4>Boys Hostel 2</h4>
                <p>Boys' Hostel 2 accommodates around 201 students. It is known for its comfortable and student-friendly environment, fostering a sense of community among its residents. This hostel provides essential facilities, including non-AC rooms and shared washrooms on each floor. The hostel is fitted with high-speed internet and 24/7 electricity and water supply.
<br><br>
                The hostel mess is known for its hygienic food, offering a variety of vegetarian and non-vegetarian dishes throughout the day. Recreational spaces and common rooms are available for students to relax and engage in social activities after study hours. The hostel also offers housekeeping services to ensure the premises are well-maintained.
                <br><br>
                Students living in Boys' Hostel 2 benefit from a conducive environment for academic and personal growth, with the warden actively engaging with students to address any concerns or needs.</p>
                <p><strong>Email:</strong> warden.kaari@college.edu</p>
                <p><strong>Mobile:</strong> 8056016612</p>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <img src="assets/images/hostels/b2.jpeg" class="img-fluid rounded align-self-stretch" alt="Kaari Hostel">
        </div>
    </div>

    <!-- Hostel 3: Senguttuvan Hostel -->
    <div class="row mb-5 d-flex align-items-stretch">
        <div class="col-md-4 d-flex">
            <img src="assets/images/hostels/b3.jpeg" class="img-fluid rounded align-self-stretch" alt="Senguttuvan Hostel">
        </div>
        <div class="col-md-8">
            <div class="bg-light p-4 shadow rounded h-100">
                <h4>Boys Hostel 3</h4>
                <p>Boys' Hostel 3, housing up to 153 students, provides a peaceful and conducive setting for academic focus. The hostel offers non-AC rooms, and students share washroom facilities that are cleaned regularly by housekeeping staff. Like the other hostels, Boys' Hostel 3 ensures 24/7 access to water, electricity, and high-speed Wi-Fi.
                <br><br>
                In addition to the academic support provided, the hostel offers several extracurricular opportunities, including a gym, indoor games, and a study hall where students can prepare for exams or group study. The hostel mess serves balanced meals, taking care of students' nutritional needs with strict hygiene standards.
                <br><br>
                The hostel management ensures the safety and well-being of all residents, providing regular health checks and maintaining a positive atmosphere for students to succeed in their academic journey.</p>
                <p><strong>Email:</strong> warden.senguttuvan@college.edu</p>
                <p><strong>Mobile:</strong> 8056016613</p>
            </div>
        </div>
    </div>
</div>

<style>
        #about-home{
        background-image: linear-gradient(rgba(50, 50, 50, 0.8), rgba(20, 20, 20, 0.5)), url("assets/images/hostels/Boys-Hostel.jpg");
        width: 100%;
        height: 80vh;
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding-top: 40px;
    }
    #about-home h2{
        color: #fff;
        font-size: 2.2rem;
        letter-spacing: 1px;
    }
    #about-home p{
        margin-top: 10px;
        width: 50%;
        color: #fff;
        font-size: 0.9rem;
        line-height: 25px;
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    .rounded {
        border-radius: 10px;
    }
    .shadow {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .h-100 {
        height: 100%;
    }
    .hidden {
        opacity: 0;
        transform: translateY(20px); /* Start with a slight downward offset */
        transition: opacity 0.5s ease, transform 0.5s ease; /* Transition for smooth effect */
    }
    .visible {
        opacity: 1;
        transform: translateY(0); /* Move to original position */
    }
</style>

<script>
// Function to check if an element is in the viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Function to add the visible class to elements in the viewport
function handleScroll() {
    const elements = document.querySelectorAll('.hidden');
    elements.forEach((el) => {
        if (isInViewport(el)) {
            el.classList.add('visible');
            el.classList.remove('hidden'); // Remove the hidden class
        }
    });
}

// Attach the scroll event listener
window.addEventListener('scroll', handleScroll);

// Initial check for elements in the viewport
document.addEventListener('DOMContentLoaded', handleScroll);
</script>

<?php include('includes/footer.php'); ?>
