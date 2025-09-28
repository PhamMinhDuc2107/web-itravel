// alerts.js
document.addEventListener("DOMContentLoaded", () => {
  const alerts = document.querySelectorAll(".flash-alert");

  alerts.forEach(alert => {
    // khi alert vừa load, thêm class wave để chạy hiệu ứng lan sóng
    alert.classList.add("wave");

    // auto close sau 4 giây
    const autoClose = setTimeout(() => closeAlert(alert), 4000);

    // gắn sự kiện cho nút close
    const closeBtn = alert.querySelector(".flash-close");
    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        clearTimeout(autoClose);
        closeAlert(alert);
      });
    }
  });

  function closeAlert(alert) {
    alert.style.animation = "fadeOut .35s ease forwards";
    setTimeout(() => {
      alert.remove();
    }, 350); // chờ animation xong mới remove
  }
});
