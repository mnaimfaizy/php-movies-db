/**
 * Modern UI JavaScript
 * Bootstrap 5 Compatible
 * Created: February 2026
 */

(function () {
  "use strict";

  // ===== Navbar Scroll Effect =====
  const navbar = document.querySelector(".modern-navbar");
  if (navbar) {
    window.addEventListener("scroll", function () {
      if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });
  }

  // ===== Hero Slider Auto-Play =====
  const heroSlider = document.querySelector(".hero-slider");
  if (heroSlider) {
    const slides = heroSlider.querySelectorAll(".hero-slide");
    let currentSlide = 0;

    function nextSlide() {
      slides[currentSlide].classList.remove("active");
      currentSlide = (currentSlide + 1) % slides.length;
      slides[currentSlide].classList.add("active");
    }

    // Auto-advance slides every 5 seconds
    if (slides.length > 1) {
      setInterval(nextSlide, 5000);
    }
  }

  // ===== Hero Search Enhancement =====
  const heroSearch = document.getElementById("heroSearch");
  if (heroSearch) {
    // Add debouncing for search input
    let searchTimeout;
    heroSearch.addEventListener("input", function (e) {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(function () {
        const query = e.target.value.trim();
        if (query.length >= 3) {
          // Trigger search suggestions (can be expanded)
          console.log("Search query:", query);
        }
      }, 300);
    });

    // Handle Enter key press
    heroSearch.addEventListener("keypress", function (e) {
      if (e.key === "Enter") {
        e.preventDefault();
        const query = e.target.value.trim();
        if (query) {
          window.location.href = "search.php?q=" + encodeURIComponent(query);
        }
      }
    });

    // Search button handler
    const searchBtn = document.querySelector(".hero-search button");
    if (searchBtn) {
      searchBtn.addEventListener("click", function () {
        const query = heroSearch.value.trim();
        if (query) {
          window.location.href = "search.php?q=" + encodeURIComponent(query);
        }
      });
    }
  }

  // ===== Smooth Scroll for Anchor Links =====
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });

  // ===== Movie Card Lazy Loading =====
  const movieCards = document.querySelectorAll(".movie-card");
  if ("IntersectionObserver" in window) {
    const cardObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("fade-in");
            cardObserver.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.1,
        rootMargin: "50px",
      },
    );

    movieCards.forEach((card) => {
      card.style.opacity = "0";
      card.style.transform = "translateY(20px)";
      card.style.transition = "opacity 0.5s ease, transform 0.5s ease";
      cardObserver.observe(card);
    });
  }

  // Fade-in class for observed elements
  const style = document.createElement("style");
  style.textContent = `
    .fade-in {
      opacity: 1 !important;
      transform: translateY(0) !important;
    }
  `;
  document.head.appendChild(style);

  // ===== Image Error Handling =====
  document
    .querySelectorAll('.movie-card-image img, img[src*="movie_poster"]')
    .forEach((img) => {
      img.addEventListener("error", function () {
        this.src = "assets/images/movie_poster/default.jpg";
        this.alt = "Movie Poster Not Available";
      });
    });

  // ===== Genre Filter Animation =====
  const genreButtons = document.querySelectorAll(".genre-filter-btn");
  if (genreButtons.length > 0) {
    genreButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        // Remove active class from all buttons
        genreButtons.forEach((b) => b.classList.remove("active"));
        // Add active class to clicked button
        this.classList.add("active");

        const genreId = this.dataset.genreId;
        if (genreId) {
          filterMoviesByGenre(genreId);
        }
      });
    });
  }

  function filterMoviesByGenre(genreId) {
    // Removed loading spinner
    // This would integrate with existing AJAX functionality
    // For now, redirect to genre page
    setTimeout(() => {
      window.location.href = "movie.php?genre_id=" + genreId;
    }, 300);
  }

  // ===== Year Filter Enhancement =====
  const yearSelect = document.getElementById("yearFilter");
  if (yearSelect) {
    yearSelect.addEventListener("change", function () {
      const year = this.value;
      if (year) {
        showLoading();
        setTimeout(() => {
          window.location.href = "movie.php?year=" + year;
        }, 300);
      }
    });
  }

  // ===== Initialize Tooltips (Bootstrap 5) =====
  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]',
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl),
  );

  // ===== Initialize Popovers (Bootstrap 5) =====
  const popoverTriggerList = document.querySelectorAll(
    '[data-bs-toggle="popover"]',
  );
  const popoverList = [...popoverTriggerList].map(
    (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl),
  );

  // ===== Back to Top Button =====
  const backToTopBtn = document.createElement("button");
  backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
  backToTopBtn.className = "back-to-top btn btn-primary";
  // ===== Scroll to Top Button =====
  const scrollToTopBtn = document.getElementById("scrollToTop");
  if (scrollToTopBtn) {
    window.addEventListener("scroll", function () {
      if (window.scrollY > 300) {
        scrollToTopBtn.classList.add("visible");
      } else {
        scrollToTopBtn.classList.remove("visible");
      }
    });

    scrollToTopBtn.addEventListener("click", function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  }

  // ===== Disable Empty Links =====
  document.querySelectorAll('a[href="#"]').forEach((link) => {
    link.addEventListener("click", function (e) {
      if (this.getAttribute("href") === "#") {
        e.preventDefault();
      }
    });
  });

  // ===== Form Validation Enhancement =====
  const forms = document.querySelectorAll(".needs-validation");
  forms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        showToast("Please fill all required fields correctly", "warning");
      }
      form.classList.add("was-validated");
    });
  });

  // ===== Fade In Animation on Scroll =====
  const fadeElements = document.querySelectorAll(".fade-in");
  if ("IntersectionObserver" in window && fadeElements.length > 0) {
    const fadeObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry, index) => {
          if (entry.isIntersecting) {
            entry.target.style.animationDelay = `${index * 0.05}s`;
            entry.target.classList.add("visible");
            fadeObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1 },
    );

    fadeElements.forEach((el) => {
      el.style.opacity = "0";
      fadeObserver.observe(el);
    });
  }

  // ===== Console Welcome Message =====
  console.log(
    "%c🎬 MNF Movies Database",
    "font-size: 20px; font-weight: bold; color: #e50914;",
  );
  console.log(
    "%cModern UI v2.0 - Powered by Bootstrap 5",
    "font-size: 12px; color: #888;",
  );
})();
