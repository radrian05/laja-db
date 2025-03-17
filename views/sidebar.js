const $toggle = document.querySelector(".toggle")
const $sidebar = document.querySelector(".sidebar");
const $main = document.querySelector(".main");
const $closeSidebarButton = document.querySelector(".closeSidebarButton");

$toggle.addEventListener('click', () => {
    $sidebar.classList.toggle("is-open");
    $toggle.classList.toggle("is-open");
});

$closeSidebarButton.addEventListener('click', () => {
    $sidebar.classList.remove("is-open");
    $toggle.classList.remove("is-open");
});