<html>
  <head>
    <meta http-equiv="Content-Type"  content="text/html charset=UTF-8" />
    <title>Novo diagnóstico para você</title>
    <link rel="shortcut icon" href="<?=base_url()?>static/images/icons/favicon.ico">
  </head>
  <body>
    <p>
      Ola <?=$name?>,
    </p>
    <p>
      Tudo bom?
    </p>
    <p>
      Um novo diagnóstico foi emitido para sua consulta em
      <a href="<?=base_url()?>">Odonto - Consultas médicas e odontológicas</a>.
    </p>
    <p>
      Consulta #<?=$cardId?><br>
      <?=$cardWhatafield?>
    </p>
    <p>
      Diagnóstico #<?=$actionId?><br>
      <?=$actionWhatafield?>
    </p>
    <p>
      Você pode seguir o link a seguir para
      <!--&nbsp;--><a href="<?= base_url() ."cards/{$cardId}/actions/{$actionId}"?>">ver mais detalhes</a>
      a respeito do diagnóstico e do emissor.
    </p>
    <p>
      Lembrando que você deve estar autenticado com seu usuário/e-mail e senha!
    </p>
  <p>
    <span>Atenciosamente,</span>
    <br>
    <em>
      <a href="https://litoraldev.herokuapp.com/">CRUDZERA GROUP</a>
    </em>
  </p>
  </body>
</html>
