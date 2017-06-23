$(function() {
  console.log("account-login.js ready");
  $("form button").on("click", function() {
    $("form button").attr("disabled", true).addClass("disabled")
        .text("signing in...");
      $("form").submit();
  });
});
