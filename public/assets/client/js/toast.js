const toast = (title, msg, type, duration = 3000) => {
   let main = document.querySelector("#toast");
   if (!main) {
      main = document.createElement("div");
      main.setAttribute("id", `toast`);
      document.body.appendChild(main);
   }
   const toast = document.createElement("div");
   const autoRemove = setTimeout(function () {
      main.removeChild(toast);
   }, duration + 500);
   toast.onclick = (e) => {
      if (e.target.classList.contains("toast__close")) {
         main.removeChild(toast);
         clearTimeout(autoRemove);
      }
   };
   const icons = {
      success: "fa-solid fa-circle-check",
      warn: "fa-solid fa-circle-exclamation",
   };
   let icon = icons[type];
   toast.setAttribute("class", `toast toast--${type}`);
   toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${
      duration / 1000
   }s forwards`;
   toast.innerHTML = `
	<div class="toast__icon">
	<i class="${icon}"></i>
	</div>
	<div class="toast__body">
	<h3 class="toast__title">${title}</h3>
	<p class="toast__msg">${msg}</p>
	</div>
	<div class="toast__close">
	<i class="fa fa-times"></i>
	</div>
	`;
   main.appendChild(toast);
}