$(function() {
  console.log("create-card.js ready");

  $form = $("form");
  $btn = $("form button");
  $text = $("form textarea");
  $files = $("form input[type=file]");

  $btn.attr("disabled", true)
      .addClass("disabled")
      .text("preencha todos os campos");

  $text.on("change", function() {
    verifyFields();
  });

  $files.on("change", function() {
    updateList();
    verifyFields();
  });

  $btn.on("click", function() {
    $btn.attr("disabled", true)
        .addClass("disabled")
        .text("aguarde...");
    $form.submit();
  });

  verifyFields = function() {
    var empty = false;
    if ($text.val() === ""
      || $files.val() === "")
    {
      empty = true;
    }

    if (empty) {
      $btn.attr("disabled", true)
          .addClass("disabled");
    }
    else {
      $btn.attr("disabled", false)
          .removeClass("disabled")
          .text("salvar");
    }
  };

  updateList = function() {
    var input = document.getElementById('attachments');
    var output = document.getElementById('selected_attachments');

    output.innerHTML = '<ul>';
    for (var i = 0; i < input.files.length; ++i) {
      output.innerHTML += '<li>' + input.files.item(i).name +' - '+ humanFileSize(input.files.item(i).size) +'</li>';
    }
    output.innerHTML += '</ul>';
  };

  humanFileSize = function(bytes, si) {
    var thresh = si ? 1000 : 1024;
    if (Math.abs(bytes) < thresh) {
      return bytes + ' B';
    }
    var units = si
        ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
        : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
    var u = -1;
    do {
      bytes /= thresh;
      ++u;
    }
    while (Math.abs(bytes) >= thresh && u < units.length - 1);

    return bytes.toFixed(1)+' '+units[u];
  };


});
