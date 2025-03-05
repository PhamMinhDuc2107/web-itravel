document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".contact__form");
    const nameInput = form.querySelector("input[name='name']");
    const emailInput = form.querySelector("input[name='email']");
    const phoneInput = form.querySelector("input[name='phone']");
    const contentInput = form.querySelector("textarea[name='content']");
    const referenceInput = form.querySelector(".dropdown_input");
    const dropdownList = form.querySelector(".dropdown_list");
    const btnSubmitForm = form.querySelector(".btn-submit-contact");

    const nameErr = form.querySelector(".name-err");
    const emailErr = form.querySelector(".email-err");
    const phoneErr = form.querySelector(".phone-err");
    const contentErr = form.querySelector(".content-err");
    const referenceErr = form.querySelector(".reference-err");

    function validateInput(input, errorElement, validationFn) {
        const errorMessage = validationFn(input.value.trim());
        errorElement.textContent = errorMessage;
        errorElement.style.color = errorMessage ? "red" : "inherit";
        return !errorMessage;
    }

    function validateDropdown(input, errorElement) {
        const value = input.textContent.trim();
        const errorMessage = value === "Chọn vấn đề cần tư vấn" ? "Vui lòng chọn vấn đề." : "";
        errorElement.textContent = errorMessage;
        errorElement.style.color = errorMessage ? "red" : "inherit";
        return !errorMessage;
    }

    function validateName(value) {
        return value === "" ? "Vui lòng nhập họ và tên." : "";
    }

    function validateEmail(value) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return !emailPattern.test(value) ? "Email không hợp lệ." : "";
    }

    function validatePhone(value) {
        const phonePattern = /^(0[0-9]{9,10})$/;
        return !phonePattern.test(value) ? "Số điện thoại không hợp lệ (10-11 chữ số)." : "";
    }

    function validateContent(value) {
        return value === "" ? "Vui lòng nhập nội dung." : "";
    }

    function validateForm() {
        let isValid = true;

        isValid &= validateInput(nameInput, nameErr, validateName);
        isValid &= validateInput(emailInput, emailErr, validateEmail);
        isValid &= validateInput(phoneInput, phoneErr, validatePhone);
        isValid &= validateInput(contentInput, contentErr, validateContent);
        isValid &= validateDropdown(referenceInput, referenceErr);

        return Boolean(isValid);
    }

    form.addEventListener("submit", function (event) {
        btnSubmitForm.disabled = true;

        if (!validateForm()) {
            event.preventDefault();
            btnSubmitForm.disabled = false;
        }
    });

    dropdownList.addEventListener("click", function (event) {
        if (event.target.classList.contains("dropdown_item")) {
            referenceInput.textContent = event.target.textContent;
            referenceErr.textContent = "";
        }
    });
});
