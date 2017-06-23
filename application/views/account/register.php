<div class="main-container">
  <div class="main wrapper clearfix">

    <?= $this->session->flashdata("alert") ?>

    <div class="">
      <form class="form-horizontal" method="post" action="<?=base_url()?>account/register">
        <legend>Registre-se agora!</legend>
        <p>Nós também não gostamos de formulários. Prometemos que será rápido.</p>
        <div class="form-group">
          <label class="col-md-6 control-label" for="first_name">Nome</label>
          <div class="col-md-12">
            <input value="<?=set_value('first_name')?>" id="first_name" name="first_name" type="text" placeholder="Seu nome" class="form-control input-md" required="">
            <?= form_error("first_name","<p class='text-danger'>", "</p>") ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-6 control-label" for="last_name">Sobrenome</label>
          <div class="col-md-12">
            <input value="<?=set_value('last_name')?>" id="last_name" name="last_name" type="text" placeholder="Seu sobrenome" class="form-control input-md">
            <?= form_error("last_name","<p class='text-danger'>", "</p>") ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-6 control-label" for="email">E-Mail</label>
          <div class="col-md-12">
            <input value="<?=set_value('email')?>" id="email" name="email" type="text" placeholder="Seu e-mail" class="form-control input-md" required="">
            <?= form_error("email","<p class='text-danger'>", "</p>") ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-6 control-label" for="username">Usuário</label>
          <div class="col-md-12">
            <input value="<?=set_value('username')?>" id="username" name="username" type="text" placeholder="Seu usuário" class="form-control input-md" required="">
            <?= form_error("username","<p class='text-danger'>", "</p>") ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-6 control-label" for="password">Senha</label>
          <div class="col-md-12">
            <input id="password" name="password" type="password" placeholder="Sua senha" class="form-control input-md" required="">
            <?= form_error("password","<p class='text-danger'>", "</p>") ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-6 control-label" for="password_confirm">Confirme sua senha</label>
          <div class="col-md-12">
            <input id="password_confirm" name="password_confirm" type="password" placeholder="Confirmação de senha" class="form-control input-md" required="">
            <?= form_error("password_confirm","<p class='text-danger'>", "</p>") ?>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <button type="submit" class="btn def-btn col-md-12" name="submit_form">registre-se</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
