(function () {
  let loader = document.querySelector(".loader");
  document.addEventListener("DOMContentLoaded", function (e) {
    if (loader) {
      loader.style.display = "none";
    }
  });
  document.addEventListener("DOMContentLoaded", function (e) {
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
        submenu.style.display =
          submenu.style.display === "block" ? "none" : "block";
        dropdown.classList.toggle("fa-caret-down");
        dropdown.classList.toggle("fa-caret-up");
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
    // tab
    const tabContainers = document.querySelectorAll(".tabs");
    tabContainers.forEach((container) => {
      const tabLinks = container.querySelectorAll(".tab--link");
      const tabContents = container.querySelectorAll(".tab--content");

      tabLinks.forEach((link) => {
        link.addEventListener("click", () => {
          tabLinks.forEach((link) => link.classList.remove("tab--active"));
          link.classList.add("tab--active");
          tabContents.forEach((content) =>
            content.classList.remove("tab__content--active")
          );
          const tabName = link.dataset.tab;
          tabContents.forEach((content) => {
            if (content.dataset.tab === tabName) {
              content.classList.add("tab__content--active");
            }
          });
        });
      });
    });
  });
  // dropdown
  const dropdownList = document.querySelector(".dropdown_list");
  const dropdownInput = document.querySelector(".dropdown_input");
  const dropdownItem = document.querySelectorAll(".dropdown_item");
  if (dropdownInput) {
    dropdownInput.addEventListener("click", function (e) {
      dropdownList.classList.toggle("dropdown-active");
    });
  }
  if (dropdownItem) {
    [...dropdownItem].forEach((item) =>
      item.addEventListener("click", function (e) {
        dropdownItem.forEach((item) =>
          item.classList.remove("dropdown-item-active")
        );
        let dropdownValue = e.target.textContent;
        dropdownInput.setAttribute("value", dropdownValue);
        e.target.classList.add("dropdown-item-active");
        dropdownList.classList.remove("dropdown-active");
      })
    );
  }
  //     hotline
  let hotline = document.querySelector(".hotline");
  let hotlintBtn = document.querySelector(".hotline-btn");
  if(hotlintBtn) {
    hotlintBtn.addEventListener("click", function (e) {
    hotline.classList.toggle("active");
  });
  }
  // dialog
  const dialogHandler = () => {
  document.addEventListener("click", function (e) {
    const dialogBtn = e.target.closest(".dialog__btn");
    console.log(dialogBtn);
    if (!dialogBtn) return;

    const buttonType = dialogBtn.dataset.type;
    const buttonId = dialogBtn.dataset.id;
    document.querySelectorAll(".dialog").forEach((dialog) => {
      const dialogType = dialog.dataset.type;
      const dialogId = dialog.dataset.id;

      if (buttonType === dialogType && buttonId === dialogId) {
        dialog.classList.add("dialog__active");
        const closeHandler = (e) => {
          if (
            e.target.classList.contains("dialog__close") ||
            e.target === dialog
          ) {
            dialog.classList.remove("dialog__active");
            dialog.removeEventListener("click", closeHandler);
          }
        };

        dialog.addEventListener("click", closeHandler);
      }
    });
  });
};
  dialogHandler();
})();

