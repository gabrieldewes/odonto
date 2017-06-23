<div class="header-container">
    <header class="wrapper clearfix">
      <h1 class="title"><a href="<?=base_url()?>">h1.title</a></h1>
      <nav class="my-navbar">
          <ul>
            <?php if ($this->AuthService->hasRole("ROLE_CONTRIBUTOR")): ?>
              <li><a href="<?=base_url()?>contributor/cards/pending">pendentes</a></li>
              <li class="item-lg"><a href="<?=base_url()?>contributor/cards/diagnosed">diagnosticadas</a></li>
              <!--<li><a href="<?=base_url()?>contributor">contribuinte</a></li>-->
            <?php elseif ($this->AuthService->hasRole("ROLE_USER")): ?>
              <li><a href="<?=base_url()?>cards">consultas</a></li>
              <li><a href="<?=base_url()?>cards/new">submeter</a></li>
              <li><a href="<?=base_url()?>cards/archive">arquivo</a></li>
            <?php elseif ($this->AuthService->hasRole("ROLE_ADMIN")): ?>
              <li><a href="<?=base_url()?>users">users</a></li>
              <li><a href="<?=base_url()?>actions">actions</a></li>
              <li><a href="<?=base_url()?>admin/cards">cards</a></li>
              <li><a href="<?=base_url()?>admin/attachments">attachs</a></li>
            <?php endif; ?>
            <?php if ($this->AuthService->isAnnonymous()): ?>
              <li><a href="<?=base_url()?>register">registre-se</a></li>
              <li><a href="<?=base_url()?>login">faça login</a></li>
            <?php else: ?>
              <!--<li><a href="<?=base_url()?>logout">sair</a></li>-->
              <li>
                <div title="My Profile" alt="Profile photo" class="profile-photo" onclick="javascript:location='<?=base_url() ."me/"?>'"
                  style="background-image: url(https://randomuser.me/api/portraits/women/<?=$this->AuthService->getCurrentUserId()?>.jpg)">
                </div>
              </li>
            <?php endif; ?>
          </ul>
      </nav>
  </header>
</div>
