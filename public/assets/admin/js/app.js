document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll(".dropdown").forEach((dropdown) => {
        let input = dropdown.querySelector('input');
        let dropdownMenu = dropdown.querySelector(".dropdown-menu");
        let inputParent = dropdown.querySelector('.parentId');
        if(dropdownMenu) {
            dropdownMenu.addEventListener('click', (e) => {
                if (e.target.classList.contains('dropdown-item')) {
                    inputParent.value = e.target.dataset.value;
                    input.value = e.target.textContent;
                }
            });
        }
    });
})