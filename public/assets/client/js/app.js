(function() {
   let loader = document.querySelector(".loader");
document.addEventListener("DOMContentLoaded", function (e) {
   if(loader) {
      loader.style.display = "none";
   }
   // menu
   const menuIcon = document.querySelector(".topbar__menu--icon");
   const menu = document.querySelector(".menu");
   menuIcon.onclick = (e) => {
      menu.classList.toggle("active__menu");
   };
   let dropdowns = document.querySelectorAll(".dropdown > i");
    dropdowns.forEach((dropdown) => {
        dropdown.addEventListener("click", function (e) {
            let submenu = this.nextElementSibling;
            submenu.style.display = submenu.style.display === "block" ? "none" : "block";
            dropdown.classList.toggle("fa-caret-down")
            dropdown.classList.toggle("fa-caret-up")
        });
    });
   document.onclick = (e) => {
      if (e.target.classList.contains("menu")) {
         e.target.classList.remove("active__menu");
      }
   };
   // search
   const iconSearch = document.querySelector(".topbar__search--icon");
   const formSearch = document.querySelector(".form-search");
   iconSearch.onclick = (e) => {
      let height = formSearch.scrollHeight;
      formSearch.style.height = `${height}px`;
      formSearch.classList.toggle("active__height");
      if (!formSearch.classList.contains("active__height")) {
         formSearch.style.height = "0px";
      }
   };
      const tabContainers = document.querySelectorAll('.tabs');
      tabContainers.forEach(container => {
         const tabLinks = container.querySelectorAll('.tab--link');
         const tabContents = container.querySelectorAll('.tab--content');

         tabLinks.forEach(link => {
            link.addEventListener('click', () => {
                  tabLinks.forEach(link => link.classList.remove('tab--active'));
                  link.classList.add('tab--active');
                  tabContents.forEach(content => content.classList.remove('tab__content--active'));
                  const tabName = link.dataset.tab;
                  tabContents.forEach(content => {
                     if (content.dataset.tab === tabName) {
                        content.classList.add('tab__content--active');
                     }
                  });
            });
         });
      });
   });
    const dropdownList = document.querySelector(".dropdown_list");
    const dropdownInput = document.querySelector(".dropdown_input")
    const dropdownItem =  document.querySelectorAll(".dropdown_item")
    if(dropdownInput) {
        dropdownInput.addEventListener("click", function(e ) {
            dropdownList.classList.toggle('dropdown-active')
            console.log(e.target);
        })
    }
    if(dropdownItem) {
        [...dropdownItem].forEach((item) => item.addEventListener("click", function (e) {
            dropdownItem.forEach(item => item.classList.remove("dropdown-item-active"));
            let dropdownValue = e.target.textContent;
            dropdownInput.value = dropdownValue;
            e.target.classList.add("dropdown-item-active");
            dropdownList.classList.remove("dropdown-active");
        }))
    }
}
)();
