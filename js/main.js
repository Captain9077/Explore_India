// main.js

// Toggle mobile navbar menu
document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarCollapse = document.querySelector(".navbar-collapse");

    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener("click", function () {
            navbarCollapse.classList.toggle("show");
        });
    }
});

// Smooth scroll to top
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

// Auto-hide alerts after 5 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => alert.style.display = 'none');
}, 5000);

// Confirm booking
function confirmBooking(hotelName) {
    return confirm(`Do you really want to book "${hotelName}"?`);
}

// Star rating visual feedback
function highlightStars(starContainerId, value) {
    const stars = document.querySelectorAll(`#${starContainerId} .star`);
    stars.forEach((star, index) => {
        if (index < value) {
            star.classList.add('text-warning');
        } else {
            star.classList.remove('text-warning');
        }
    });
}


    function scrollHotel(direction) {
      const container = document.getElementById('hotelScroll');
      const scrollAmount = 300;
      if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
      } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      }
    }

    // Optional: Auto scroll every 4 seconds
    setInterval(() => {
      scrollHotel('right');
    }, 4000);
