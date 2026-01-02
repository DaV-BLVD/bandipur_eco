const navbar = document.getElementById("navbar");
const menuToggle = document.getElementById("menu-toggle");
const mobileMenu = document.getElementById("mobile-menu");
const menuIcon = document.getElementById("menu-icon");
const mobileLinks = document.querySelectorAll(".mobile-link");

// 1. Scroll Effect (Navbar background & text color)
window.addEventListener("scroll", () => {
    if (window.scrollY > 80) {
        navbar.classList.add("bg-white", "shadow-lg", "py-3", "text-[#6d6d18]");
        navbar.classList.remove("bg-transparent", "py-4", "text-white");
    } else {
        navbar.classList.add("bg-transparent", "py-4", "text-white");
        navbar.classList.remove(
            "bg-white",
            "shadow-lg",
            "py-3",
            "text-gray-900"
        );
    }
});

// 2. Mobile Menu Toggle
menuToggle.addEventListener("click", () => {
    const isOpen = !mobileMenu.classList.contains("-translate-y-full");

    if (isOpen) {
        mobileMenu.classList.add("-translate-y-full");
        menuIcon.classList.replace("fa-times", "fa-bars");
    } else {
        mobileMenu.classList.remove("-translate-y-full");
        menuIcon.classList.replace("fa-bars", "fa-times");
    }
});

// 3. Close Mobile Menu when a link is clicked
mobileLinks.forEach((link) => {
    link.addEventListener("click", () => {
        mobileMenu.classList.add("-translate-y-full");
        menuIcon.classList.replace("fa-times", "fa-bars");
    });
});
