// Generate a simple numeric captcha
function generateCaptcha() {
    const num1 = Math.floor(Math.random() * 10);
    const num2 = Math.floor(Math.random() * 10);
    const captchaValue = num1 + num2;
    document.getElementById("captcha").textContent = `${num1} + ${num2} = ?`;
    return captchaValue;
}

let currentCaptcha = generateCaptcha();

document.getElementById("contactForm").addEventListener("submit", function(e) {
    const input = parseInt(document.getElementById("captchaInput").value);
    if (input !== currentCaptcha) {
        e.preventDefault(); // prevent form submission
        document.getElementById("errorMsg").textContent = "Captcha is incorrect!";
        document.getElementById("successMsg").textContent = "";
        currentCaptcha = generateCaptcha(); // regenerate captcha
        document.getElementById("captchaInput").value = "";
    } else {
        document.getElementById("errorMsg").textContent = "";
        document.getElementById("successMsg").textContent = "Captcha correct, submitting...";
    }
});
