const toggleBtn = document.querySelector(".toggle-btn");
const body = document.body;

if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('bgdark');
    toggleBtn.textContent = 'Toggle Light Mode';
}

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