<div class="main-container">
  <div class="main wrapper clearfix">
    <article>
      <?= $this->session->flashdata("alert") ?>
      <?php $this->load->view("layouts/breadcumb") ?>
      <?php foreach ($cards as $index => $card): ?>
        <div class="card">
          <div class="card-block">
            <h3 class="card-title">#<?=$card->getId()?></h3>
            <p class="card-text"><?=$card->getWhatafield()?></p>

            <?php if ($card->getDeleted()): ?>
              <a href="<?=base_url(). "cards/{$card->getId()}/recover"?>" class="card-link">
                Recover
              </a>
            <?php else: ?>
              <a href="<?=base_url()?>cards/<?=$card->getId()?>" class="card-link">
                View
              </a>
              <a href="<?=base_url()?>cards/<?=$card->getId()?>/actions" class="card-link">
                Diagnostics
              </a>
              <a href="<?=base_url(). "cards/{$card->getId()}/archive"?>" class="card-link">
                Archive
              </a>
            <?php endif; ?>

          </div>
        </div>
        <br>
      <?php endforeach; ?>
      <?php if ($cards->count() === 0): ?>
        <p>
          <h4>
            <small>Nada para mostrar.</small>
          </h4>
        </p>
      <?php endif; ?>
      <div class="justify-content-center pagination-lg">
        <?=$pagination?>
      </div>
    </article>
    <aside>
      <h3>aside</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices.</p>
    </aside>
  </div>
</div>
