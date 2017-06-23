<div class="main-container">
  <div class="main wrapper clearfix">
    <article>
      <?php $this->load->view("layouts/breadcumb") ?>
      <?php $user = $card->getUser();
            $currUserUsername = $this->AuthService->getCurrentUserUsername() ?>
      <div class="card">
        <div class="card-block">
          <h3 class="card-title">Consulta #<?=$card->getId()?></h3>
          <p class="card-text"><?=$card->getWhatafield()?></p>
          <p>
            <small style="color:gray">
              <?php $a = "Criado em "
                . $card->getCreatedAt()->format('\<\s\t\r\o\n\g\>d/m/Y\<\/\s\t\r\o\n\g\> á\s\ \<\s\t\r\o\n\g\>H:i:s\<\/\s\t\r\o\n\g\>')
                ."<br>Última modificação em "
                . $card->getLastModifiedAt()->format('\<\s\t\r\o\n\g\>d/m/Y\<\/\s\t\r\o\n\g\> á\s\ \<\s\t\r\o\n\g\>H:i:s\<\/\s\t\r\o\n\g\>');
                  echo $a;
              ?>
            </small>
          </p>
          <?php if ($user->getUsername() === $currUserUsername): ?>
            <a href="#" class="card-link">Edit</a>
            <a href="#" class="card-link">Archive</a>
          <?php endif; ?>
          <a href="<?= base_url(). "{$this->uri->uri_string}/actions"?>" class="card-link">Diagnostics</a>
        </div>
      </div>
      <?php $this->load->view("attachment/list", array("attachments"=>$card->getAttachment())) ?>
    </article>
    <?php if ($user->getUsername() !== $currUserUsername): ?>
      <aside>
        <div class="row justify-content-center">

          <div alt="Profile photo" class="profile-photo" style="background-image: url(https://randomuser.me/api/portraits/women/<?=$user->getId()?>.jpg)"></div>

          <h3 class="profile-name">
            <?=trim("{$user->getFirstName()} {$user->getLastName()}")?>
          </h3>

          <p class="text-center">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in.
          </p>
        </div>
      </aside>
    <?php else: ?>
      <aside>
        <h3>aside</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices.</p>
      </aside>
    <?php endif; ?>
  </div>
</div>
