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
const roles = ['Full-Stack Developer', 'Frontend Developer', 'Backend Developer', 'UI/UX Designer'];
const rolesSpan = document.getElementById('roles');
let roleIndex = 0;
let charIndex = 0;
let isDeleting = false;

function typeRole() {
    const currentRole = roles[roleIndex];
    
    if (isDeleting) {
        rolesSpan.textContent = currentRole.substring(0, charIndex - 1);
        charIndex--;
    } else {
        rolesSpan.textContent = currentRole.substring(0, charIndex + 1);
        charIndex++;
    }
    
    let waitTime = 100;
    if (!isDeleting && charIndex === currentRole.length) {
        waitTime = 2000; // Pause at full word
        isDeleting = true;
    } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        roleIndex = (roleIndex + 1) % roles.length;
        waitTime = 500;
    }
    
    setTimeout(typeRole, waitTime);
}

typeRole();


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
