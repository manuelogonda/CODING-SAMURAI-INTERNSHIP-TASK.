const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.setAttribute('aria-expanded', 'false'); // ARIA init

menuBtn.addEventListener("click", () => {
  navLinks.classList.toggle("open");
  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-3-line");
  menuBtn.setAttribute('aria-expanded', isOpen); // ARIA toggle
});

// Close menu and scroll smoothly on nav link click
navLinks.querySelectorAll('a[href^="#"]').forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const targetId = link.getAttribute('href');
    const targetSection = document.querySelector(targetId);
    if (targetSection) {
      targetSection.scrollIntoView({ behavior: 'smooth' });
    }
    navLinks.classList.remove("open");
    menuBtnIcon.setAttribute("class", "ri-menu-3-line");
    menuBtn.setAttribute('aria-expanded', 'false');
  });
});


// Contact
const contactShow = document.getElementById('contact-show');
const contactSection = document.getElementById('footer');

contactShow.addEventListener('click', () => {
  contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
});



const scrollRevealOptions = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

// Animations (removed duplicate)
ScrollReveal().reveal(".header__content h1", scrollRevealOptions);
ScrollReveal().reveal(".header__btn", { ...scrollRevealOptions, delay: 500 });
ScrollReveal().reveal(".service__card", { ...scrollRevealOptions, interval: 500 });
ScrollReveal().reveal(".price__card", { ...scrollRevealOptions, interval: 500 });

const swiper = new Swiper(".swiper", {
  loop: true,
  pagination: { el: ".swiper-pagination" },
  a11y: { enabled: true } 
});

// Fixed email validation
const emailValidate = document.getElementById("emailValidate");
const subscribeForm = document.querySelector('.subscribe__form form');
const emailInput = document.querySelector('.subscribe__form input');
subscribeForm.addEventListener('submit', (e) => {
  if (!emailInput.value.includes('@') || !emailInput.value.includes('.')) {
    e.preventDefault();
    emailValidate.style.color = "red";
    emailValidate.textContent = 'Please enter a valid email';
    emailInput.focus();
  }else{
    emailValidate.style.color = "green";
    emailValidate.textContent = 'Thanks for subscribing';
  }
});

