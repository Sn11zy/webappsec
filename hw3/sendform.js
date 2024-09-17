const form = document.querySelector("#commentForm")

async function sendform() {
  const formData = new FormData(form);
  const response = await fetch(window.location.href, {
    method: "POST",
    headers: {"ANTI-CSRF":"1"},
    body: formData,
    credentials: "include"
  });
  document.body.innerHTML = await response.text();

}

form.addEventListener("submit", (event) => {
  event.preventDefault();
  sendform()
})
