$(function() {
  console.log("account-register ready");
  var $form = $("form"),
      $btn = $("form button"),
      empty = true;

  $btn.attr("disabled", true).addClass("disabled")
      .text("preencha todos os campos");

  $("form input").on("change", function() {

    $("form input").each(function() {
      empty = $(this).val() === "";
    });

    if (empty) {
      $btn.attr("disabled", true).addClass("disabled");
    }
    else {
      $btn.attr("disabled", false).removeClass("disabled")
          .text("registre-se");
    }
  });

  $btn.on("click", function() {
    $btn.attr("disabled", true).addClass("disabled")
        .text("procurando servidor mais próximo...");
    $form.submit();
  });
});
