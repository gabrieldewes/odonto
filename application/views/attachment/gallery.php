<?php foreach ($attachments as $index => $attachment): ?>
  <?php if ($attachment->getIsImage()): ?>
    <h4>Galeria</h4>
    <?php break; ?>
  <?php endif; ?>
<?php endforeach; ?>
<div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
  <?php foreach ($attachments as $key => $attach): ?>
    <?php if ($attach->getIsImage()): ?>
      <!--<div class="d-inline-block card">
        <div class="card-block">
        --><figure class="d-inline-block --card --card-block" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="<?=$attach->getUrl()?>" itemprop="contentUrl" data-size="<?="{$attach->getImageWidth()}x{$attach->getImageHeight()}"?>">
              <img src="<?=$attach->getThumbUrl()?>" itemprop="thumbnail" alt="<?=$attach->getAlt()?>" />
            </a>
            <figcaption itemprop="caption description"><?=$attach->getAlt()?></figcaption>
          </figure>
        <!--</div>
      </div>-->
    <?php endif; ?>
  <?php endforeach; ?>
</div>
<?php $this->load->view("layouts/photoswipe") ?>
