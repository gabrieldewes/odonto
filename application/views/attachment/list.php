<div class="main">
  <?php $this->load->view("attachment/gallery", array("attachments"=>$attachments)) ?>
  <div id="attachments">
    <?php foreach ($attachments as $index => $attachment): ?>
      <?php if (!$attachment->getIsImage()): ?>
        <h4>Anexos</h4>
        <?php break; ?>
      <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach ($attachments as $index => $attachment): ?>
      <?php if (!$attachment->getIsImage()): ?>
        <div class="d-inline-block card">
          <div class="card-block">
            <h4 class="card-title">Anexo #<?=$attachment->getId()?></h4>
            <p class="card-text overflow" title="<?=$attachment->getOriginalName()?>"><?=$attachment->getOriginalName()?></p>

            <a href="<?=base_url() ."attachments/{$attachment->getId()}"?>" class="card-link">View</a>
            <a href="<?=base_url() ."attachments/{$attachment->getId()}/download"?>" target="_blank" class="card-link">Download</a>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
