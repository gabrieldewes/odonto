<div class="main-container">
  <div class="main wrapper clearfix">
    <article>
      <?= $this->session->flashdata("alert") ?>
      <?php $this->load->view("layouts/breadcumb.php") ?>
      <?php foreach ($diagnostics as $index => $action): ?>
        <div class="card">
          <div class="card-block">
            <h3 class="card-title">#<?=$action->getId()?></h3>
            <p class="card-text"><?=$action->getWhatafield()?></p>

            <p>
              <small style="color:gray">
                <?php $a = "Criado por <strong>"
                  . $action->getCreatedBy()
                  ."</strong> em "
                  . $action->getCreatedAt()->format('\<\s\t\r\o\n\g\>d/m/Y\<\/\s\t\r\o\n\g\> á\s\ \<\s\t\r\o\n\g\>H:i:s\<\/\s\t\r\o\n\g\>')
                  ."<br>Última modificação por <strong>"
                  . $action->getLastModifiedBy()
                  ."</strong> em "
                  . $action->getLastModifiedAt()->format('\<\s\t\r\o\n\g\>d/m/Y\<\/\s\t\r\o\n\g\> á\s\ \<\s\t\r\o\n\g\>H:i:s\<\/\s\t\r\o\n\g\>');
                    echo $a;
                ?>
              </small>
            </p>

            <a href="<?= base_url() ."{$this->uri->uri_string}/{$action->getId()}"?>" class="card-link">View</a>
            <?php if ($action->getUser()[0]->getUsername() === $this->AuthService->getCurrentUserUsername()): ?>
              <a href="#" class="card-link">Edit</a>
              <a href="#" class="card-link">Archive</a>
            <?php endif; ?>
          </div>
        </div>
        <br>
      <?php endforeach; ?>
      <?php if (empty($diagnostics)): ?>
        <p>
          <h4>
            <small>Nada para mostrar.</small>
          </h4>
        </p>
      <?php endif; ?>
    </article>

    <aside>
      <h3>aside</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices.</p>
    </aside>
  </div>
</div>
