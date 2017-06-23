<div class="main-container">
  <div class="main wrapper clearfix">
    <article>
      <div class="card">
        <div class="card-block">
          <h3 class="card-title">Anexo #<?=$attach->getId()?></h3>

          <?php if ($attach->getThumbUrl() !== null): ?>
            <p>
              <img src="<?=$attach->getThumbUrl()?>" alt="<?=$attach->getAlt()?>">
            </p>
          <?php endif; ?>

          <p class="card-text"><?=$attach->getOriginalName()?></p>

          <p>
            <small style="color:gray">
              <?php $a = "Criado por <strong>"
                . $attach->getCreatedBy()
                ."</strong> em "
                . $attach->getCreatedAt()->format('\<\s\t\r\o\n\g\>d/m/Y\<\/\s\t\r\o\n\g\> á\s\ \<\s\t\r\o\n\g\>H:i:s\<\/\s\t\r\o\n\g\>')
                ."<br>Última modificação por <strong>"
                . $attach->getLastModifiedBy()
                ."</strong> em "
                . $attach->getLastModifiedAt()->format('\<\s\t\r\o\n\g\>d/m/Y\<\/\s\t\r\o\n\g\> á\s\ \<\s\t\r\o\n\g\>H:i:s\<\/\s\t\r\o\n\g\>');
                  echo $a;
              ?>
            </small>
          </p>
          <a href="#" class="card-link">Edit</a>
          <a href="#" class="card-link">Archive</a>
          <a href="<?=base_url() ."attachments/{$attach->getId()}/download"?>" target="_blank" class="card-link">Download</a>
        </div>
      </div>
    </article>
    <aside>
      <h3>aside</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices.</p>
    </aside>
  </div>
</div>
