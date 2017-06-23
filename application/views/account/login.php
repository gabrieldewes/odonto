<div class="main-container">
  <div class="main wrapper clearfix">

    <?= $this->session->flashdata("alert") ?>

    <div class="">
      <form class="form-horizontal" method="post" action="<?=base_url()?>auth">
        <legend>Sign in to odonto</legend>

        <div class="form-group">
          <label class="col-md-6 control-label" for="login">Usuário ou e-mail</label>
          <div class="col-md-12">
            <input id="login" name="login" type="text" placeholder="Seu usuário ou e-mail" class="form-control input-md" required="">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-6 control-label" for="password">Senha</label>
          <div class="col-md-12">
            <input id="password" name="password" type="password" placeholder="Sua senha" class="form-control input-md" required="">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <button type="submit" class="btn def-btn col-md-12" name="submit_form">sign in</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
