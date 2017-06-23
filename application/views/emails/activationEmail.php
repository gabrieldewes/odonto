<html>
  <head>
    <title>Confirme sua conta</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/icons/favicon.ico">
  </head>
  <body>
    <p>
      Olá <?=$name?>,
    </p>
    <p>
      Tudo bom?
    </p>
    <p>
      Vimos que você criou uma nova conta em
      <a href="<?=base_url()?>">Odonto - Consultas médicas e odontológicas</a>, certo?
    </p>
    <p>
      Estamos lhe enviando este e-mail pois foi informado no formulário de cadastro.
    </p>
    <p>
      Se este é realmente seu e-mail, por gentileza,
      <!--&nbsp;--><a href="<?=base_url()?>account/activate?key=<?=$activationKey?>">confirme sua conta</a>.
    </p>
    <p>
      Caso contrário, simplesmente ignore-o.
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
