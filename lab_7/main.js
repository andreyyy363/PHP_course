$(document).ready(function () {
  // Переходи між сторінками
  $("#loginBtn").click(function () {
    window.location.href = "login.html";
  });

  $("#registerBtn").click(function () {
    window.location.href = "register.html";
  });

  $("#profileBtn").click(function () {
    window.location.href = "update_profile.html";
  });

  $("#logoutBtn").click(function () {
    window.location.href = "logout.php";
  });

  // Валідація форми реєстрації
  $("#registerForm").submit(function (e) {
    e.preventDefault();
    const password = $("#password").val();
    const confirmPassword = $("#confirmPassword").val();
    const email = $("#email").val();
    const username = $("#username").val();

    const validationMessage = validateForm(
      username,
      email,
      password,
      confirmPassword
    );
    if (validationMessage) {
      $("#registerMessage").text(validationMessage);
      return;
    }

    // Відправка AJAX-запиту на сервер
    $.ajax({
      type: "POST",
      url: "register.php",
      data: { username: username, email: email, password: password },
      success: function (response) {
        if (response === "success") {
          alert("Реєстрація успішна!");
          window.location.href = "index.php";
        } else {
          $("#registerMessage").text(response);
        }
      },
    });
  });

  // Валідація форми входу
  $("#loginForm").submit(function (e) {
    e.preventDefault();
    const email = $("#loginEmail").val();
    const password = $("#loginPassword").val();

    $.ajax({
      type: "POST",
      url: "login.php",
      data: { email: email, password: password },
      success: function (response) {
        if (response === "success") {
          alert("Вхід успішний!");
          window.location.href = "index.php";
        } else {
          $("#loginMessage").text(response);
        }
      },
    });
  });

  // Валідація форми оновлення профілю
  $("#editProfileForm").submit(function (e) {
    e.preventDefault();
    const username = $("#username").val();
    const email = $("#email").val();
    const password = $("#password").val();

    const validationMessage = validateForm(username, email, password);
    if (validationMessage) {
      $("#message").text(validationMessage);
      return;
    }

    $.ajax({
      url: "update_profile.php",
      type: "POST",
      data: { username: username, email: email, password: password },
      success: function (response) {
        if (response === "success") {
          alert("Профіль успішно змінено!");
          window.location.href = "index.php";
        } else {
          $("#loginMessage").text(response);
        }
      },
    });
  });

  function validateForm(username, email, password, confirmPassword) {
    if (!validateEmail(email)) {
      return "Невірний формат електронної пошти";
    }

    if (!validateUsername(username)) {
      return "Ім'я користувача повинно бути від 3 до 15 символів і містити тільки букви, цифри та підкреслення";
    }

    if (!validatePassword(password)) {
      return "Пароль повинен бути не менше 8 символів, містити хоча б одну велику літеру, одну малу літеру і одну цифру";
    }

    if (confirmPassword !== undefined && password !== confirmPassword) {
      return "Паролі не співпадають";
    }

    return null;
  }

  function validateEmail(email) {
    const regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    return regex.test(email);
  }

  function validateUsername(username) {
    const regex = /^[a-zA-Z0-9_]{3,15}$/;
    return regex.test(username);
  }

  function validatePassword(password) {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    return regex.test(password);
  }
});
