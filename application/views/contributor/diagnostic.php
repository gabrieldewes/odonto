<div class="main-container">
  <div class="main wrapper clearfix">
    <?= $this->session->flashdata("alert") ?>
    <?php $this->load->view("layouts/breadcumb") ?>

    <?php
      $returnUrl = str_replace("/new", "", $this->uri->uri_string);
      $cardId = -1;
      if (is_numeric($this->uri->segment(3))):
        $cardId = $this->uri->segment(3);
      elseif (is_numeric($this->uri->segment(4))):
        $cardId = $this->uri->segment(4);
      endif;
    ?>

    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="<?=base_url() ."cards/{$cardId}/actions/create?returnUrl={$returnUrl}"?>">
      <legend>New Action</legend>
      <div class="form-group">
        <label class="col-md-6 control-label" for="whatafield">Descrição</label>
        <div class="col-md-12">
          <textarea rows="3" id="whatafield" name="whatafield" type="text" placeholder="What a text" class="form-control input-md" required=""><?=set_value('whatafield')?></textarea>
          <?= form_error("whatafield","<p class='text-danger'>", "</p>") ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-6 control-label" for="attachments">Anexos</label>
        <div class="col-md-12">
          <input value="<?=set_value('attachments')?>" id="attachments" name="attachments[]" type="file" multiple class="form-control input-md" />
          <?= form_error("attachments","<p class='text-danger'>", "</p>") ?>
          <p id="selected_attachments"></p>
        </div>
      </div>
      <br>
      <div class="form-group">
        <div class="col-md-12">
          <button type="submit" class="btn def-btn col-md-12" name="submit_form">salvar</button>
        </div>
      </div>
    </form>

  </div>
</div>
