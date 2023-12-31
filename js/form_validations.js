function generateRandomCaptcha(length = 8, type = "mixed") {
  let characters = "";
  let captcha = "";

  switch (type) {
    case "alpha":
      characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      break;
    case "numeric":
      characters = "0123456789";
      break;
    case "alphanumeric":
      characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      break;
    default:
      characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  }

  const charLength = characters.length;

  for (let i = 0; i < length; i++) {
    captcha += characters.charAt(Math.floor(Math.random() * charLength));
  }

  return captcha;
}

function refreshCaptcha() {
  var newCaptcha = generateRandomCaptcha();
  document.getElementById("captchaText").innerText = newCaptcha;
}

function validateLoginForm() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  const captchaInput = document.getElementById("captcha");
  const captchaText = document.getElementById("captchaText");
  const captchaInputValue = captchaInput.value.trim().toLowerCase();
  const captchaTextValue = captchaText.textContent.trim().toLowerCase();

  if (isEmptyOrBlank(username)) {
    alert("Name must be filled out!");
    return false;
  } else if (isEmptyOrBlank(password)) {
    alert("Password can't be blank!");
    return false;
  } else if (password.length < 8) {
    alert("Too short of a password!");
    return false;
  } else if (username.length > 20) {
    alert("Too long of a username!");
    return false;
  } else if (!(captchaInputValue === captchaTextValue)) {
    alert("Invalid CAPTCHA. Please enter the correct CAPTCHA text.");
    captchaInput.value = "";
    refreshCaptcha();
    return false;
  } else {
    return true;
  }
}

function validateSignUpForm() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var repassword = document.getElementById("repassword").value;
  const captchaInput = document.getElementById("captcha");
  const captchaText = document.getElementById("captchaText");
  const captchaInputValue = captchaInput.value.trim().toLowerCase();
  const captchaTextValue = captchaText.textContent.trim().toLowerCase();

  if (password != repassword) {
    alert("Both passwords should match!");
    return false;
  } else if (isEmptyOrBlank(username)) {
    alert("Name must be filled out!");
    return false;
  } else if (isEmptyOrBlank(password)) {
    alert("Password can't be blank!");
    return false;
  } else if (isEmptyOrBlank(repassword)) {
    alert("Password can't be blank!");
    return false;
  } else if (password.length < 8) {
    alert("Too short of a password!");
    return false;
  } else if (username.length > 20) {
    alert("Too long of a username!");
    return false;
  } else if (!(captchaInputValue === captchaTextValue)) {
    alert("Invalid CAPTCHA. Please enter the correct CAPTCHA text.");
    captchaInput.value = "";
    refreshCaptcha();
    return false;
  } else {
    return true;
  }
}

function validateAccountSettingsForm() {
  var cpassword = document.getElementById("cpassword").value;
  var npassword = document.getElementById("npassword").value;
  if (isEmptyOrBlank(cpassword)) {
    alert("Current password must be filled out!");
    return false;
  } else if (isEmptyOrBlank(npassword)) {
    alert("Password can't be blank!");
    return false;
  } else if (cpassword.length < 8) {
    alert("Too short of a password!");
    return false;
  } else if (npassword.length < 8) {
    alert("Too short of a password!");
    return false;
  } else if (npassword == cpassword) {
    alert("Passwords cannot be identical!");
    return false;
  } else {
    return true;
  }
}

function validateAddAmount() {
  var amount = document.getElementById("addAmount").value;
  var desc = document.getElementById("addDesc").value;
  if (isEmptyOrBlank(amount)) {
    alert("Amount must be filled out!");
    return false;
  } else if (amount <= 0) {
    alert("Invalid amount!\nUse Subtract for reducing.");
    return false;
  } else if (isEmptyOrBlank(desc)) {
    alert("Invalid description");
    return false;
  } else {
    return true;
  }
}

function validateSubAmount() {
  var amount = document.getElementById("subAmount").value;
  var desc = document.getElementById("subDesc").value;
  if (isEmptyOrBlank(amount)) {
    alert("Amount must be filled out!");
    return false;
  } else if (amount <= 0) {
    alert("Invalid amount!");
    return false;
  } else if (isEmptyOrBlank(desc)) {
    alert("Invalid description");
    return false;
  } else {
    return true;
  }
}

function validateTransferAmount() {
  var amount = document.getElementById("transferAmount").value;
  var desc = document.getElementById("transferDesc").value;
  var fAccount = document.getElementById("transferFAccount").value;
  var tAccount = document.getElementById("transferTAccount").value;
  if (isEmptyOrBlank(amount)) {
    alert("Amount must be filled out!");
    return false;
  } else if (amount <= 0) {
    alert("Invalid amount!");
    return false;
  } else if (isEmptyOrBlank(desc)) {
    alert("Invalid description");
    return false;
  } else if (fAccount == tAccount) {
    alert("To and From accounts can't be same");
    return false;
  } else {
    return true;
  }
}

function getUpdatedDescription($logId) {
  var currentDesc = document.getElementById("currentDesc".concat($logId));
  var updatedDesc = prompt("Edit Description");
  // stop form submit if no desc or same desc
  if (updatedDesc == null || updatedDesc == currentDesc.value) {
    return false;
  } else if (isEmptyOrBlank(updatedDesc)) {
    alert("Invalid description");
    return false;
  } else {
    currentDesc.value = updatedDesc;
    return true;
  }
}

function undoTransactionConfirm() {
  var confirmation = confirm(
    "Are you sure to undo this transaction?\nThis will remove all transactions done after the selected transaction aswell."
  );
  return confirmation;
}

function isEmptyOrBlank(string) {
  if (string == "" || string === "" || !string || /^\s*$/.test(string)) {
    return true;
  } else {
    return false;
  }
}
