window.addEventListener("load", init);

function init() {
  document.getElementById(`fl`).addEventListener("click", function (e) {
    let forgetForm = document.getElementById("forget");

    if (forgetForm.style.display === "none") {
      forgetForm.style.display = "block";
    } else {
      forgetForm.style.display = "none";
    }

    e.preventDefault();
  });
}

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
