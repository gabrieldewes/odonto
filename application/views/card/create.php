<div class="main-container">
  <div class="main wrapper clearfix">

    <?= $this->session->flashdata("alert") ?>

    <?php $this->load->view("layouts/breadcumb") ?>

    <div class="">
      <form enctype="multipart/form-data" class="form-horizontal" method="post" action="<?=base_url()?>cards/create">
        <legend>Create card</legend>
        <div class="form-group">
          <label class="col-md-6 control-label" for="whatafield">What a field</label>
          <div class="col-md-12">
            <textarea rows="3" id="whatafield" name="whatafield" type="text" placeholder="What a text" class="form-control input-md" required=""><?=set_value('whatafield')?></textarea>
            <?= form_error("whatafield","<p class='text-danger'>", "</p>") ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-6 control-label" for="attachments">Anexos</label>
          <div class="col-md-12">
            <input value="<?=set_value('attachments')?>" id="attachments" name="attachments[]" type="file" multiple class="form-control input-md" required="" />
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
</div>
