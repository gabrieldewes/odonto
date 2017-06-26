<div class="main-container">
  <div class="main wrapper clearfix">
    <article>
      <?php $this->load->view("layouts/breadcumb.php") ?>
      <div class="card">
        <div class="card-block">
          <h3 class="card-title">Diagnóstico #<?=$diagnostic->getId()?></h3>
          <p class="card-text"><?=$diagnostic->getWhatafield()?></p>
          <p>
            <small style="color:gray">
              <?php $a = "Criado em "
                . $diagnostic->getCreatedAt()->format('\<\s\t\r\o\n\g\>d/m/Y\<\/\s\t\r\o\n\g\> á\s\ \<\s\t\r\o\n\g\>H:i:s\<\/\s\t\r\o\n\g\>')
                ."<br>Última modificação em "
                . $diagnostic->getLastModifiedAt()->format('\<\s\t\r\o\n\g\>d/m/Y\<\/\s\t\r\o\n\g\> á\s\ \<\s\t\r\o\n\g\>H:i:s\<\/\s\t\r\o\n\g\>');
                  echo $a;
              ?>
            </small>
          </p>
          <?php if ($diagnostic->getCreatedBy() === $this->AuthService->getCurrentUserUsername()): ?>
            <a href="#" class="card-link">Edit</a>
            <a href="#" class="card-link">Archive</a>
          <?php endif; ?>
        </div>
      </div>
      <?php $this->load->view("attachment/list", array("attachments"=>$diagnostic->getAttachment())) ?>
    </article>
    <aside>
      <?php $user = $diagnostic->getUser()[0] ?>
      <div class="row justify-content-center">

        <div alt="Profile photo" class="profile-photo"
          style="background-image: url(<?=$user->getAvatarUrl()?>)"></div>

        <h3 class="title">
          <?=trim("{$user->getFirstName()} {$user->getLastName()}")?>
        </h3>

        <p class="text-center">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in.
        </p>
      </div>
    </aside>
  </div>
</div>
