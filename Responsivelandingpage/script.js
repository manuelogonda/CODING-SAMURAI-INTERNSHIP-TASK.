const heroBtn = document.querySelector('.lp-hero-btn');
const headerBtn = document.querySelector('.lp-cta-btn');
const signupSection = document.getElementById('signup');

function scrollToSignup() {
  signupSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

heroBtn.addEventListener('click', scrollToSignup);
headerBtn.addEventListener('click', scrollToSignup);