const toggleBtn = document.querySelector(".toggle-btn");
const body = document.body;

if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('bgdark');
    toggleBtn.textContent = 'Toggle Light Mode';
}
//toggling back ground color
toggleBtn.addEventListener("click", () => {
    body.classList.toggle("bgdark");

    if (body.classList.contains("bgdark")) {
        toggleBtn.textContent = "Toggle Light Mode";
         localStorage.setItem('theme', 'dark');
    } else {
        toggleBtn.textContent = "Toggle Dark Mode";
        localStorage.removeItem('theme');
    }
})

//Animating roles 
const roles = ['FullStack Developer', 'Frontend Developer', 'Backend Developer', 'UI/UX Designer'];
const rolesSpan = document.getElementById('roles');
let roleIndex = 0;
function showNextRole() {
  rolesSpan.classList.remove('show');

  setTimeout(() => {
    rolesSpan.textContent = roles[roleIndex];
    rolesSpan.classList.add('show');

    roleIndex = (roleIndex + 1) % roles.length;
  }, 300); 
}
rolesSpan.textContent = roles[0];
rolesSpan.classList.add('show');
roleIndex = 1;

setInterval(showNextRole, 4000);


// Toggle extra content in services section
const toggleButtons = document.querySelectorAll('.toggle-btn');
toggleButtons.forEach(button => {
    button.addEventListener('click', () => {
        const extraContent = button.previousElementSibling;
        extraContent.classList.toggle('expanded');
        button.textContent = extraContent.classList.contains('expanded') 
            ? 'Learn More' 
            : 'Show Less';
    });
});

// Project filtering
const filterButtons = document.querySelectorAll('.filter-btn');
const projectCards = document.querySelectorAll('.project-card');

filterButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    // 1. Active state on buttons
    filterButtons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // 2. Get filter value
    const filter = btn.dataset.filter; 

    projectCards.forEach(card => {
      const category = card.dataset.category; 

      if (filter === 'all' || filter === category) {
        card.classList.remove('hidden');
      } else {
        card.classList.add('hidden');
      }
    });
  });
});
// Smooth scrolling for nav links
// About
const aboutShow = document.getElementById('about-show');
const aboutSection = document.getElementById('about-me');

aboutShow.addEventListener('click', () => {
  aboutSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
});

// Skills
const skillShow = document.getElementById('skill-show');
const skillsSection = document.getElementById('skills');

skillShow.addEventListener('click', () => {
  skillsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
});

// Services
const serviceShow = document.getElementById('service-show');
const servicesSection = document.getElementById('services');

serviceShow.addEventListener('click', () => {
  servicesSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
});

// Projects
const projectsShow = document.getElementById('projects-show');
const projectsSection = document.getElementById('projects');

projectsShow.addEventListener('click', () => {
  projectsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
});

// Contact
const contactShow = document.getElementById('contact-show');
const contactSection = document.getElementById('contact');

contactShow.addEventListener('click', () => {
  contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
});


