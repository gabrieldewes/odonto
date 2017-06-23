<div class="main-container">
  <div class="main wrapper clearfix">
    <?= $this->session->flashdata("alert"); ?>
    <h2>Cards</h2>
    <button class="btn btn-primary" href="<?=base_url()?>cards/new">
      <span>Create a new Card</span>
    </button>

    <div class="">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Whatafield</th>
            <th>Deleted</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Last Modified By</th>
            <th>Last Modified At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cards as $index => $card): ?>
            <tr>
              <td><?=$card->getId()?></td>
              <td><?=$card->getWhatafield()?></td>
              <td>
                <?php if ($card->getDeleted()): ?>
                  <span class="badge badge-danger">
                    Archived
                  </span>
                <?php else: ?>
                  <span class="badge badge-success">
                    Active
                  </span>
                <?php endif; ?>
              </td>
              <td><?=$card->getCreatedBy()?></td>
              <td><?=$card->getCreatedAt()->format('d/m/Y á\s\ H:i:s')?></td>
              <td><?=$card->getLastModifiedBy()?></td>
              <td><?=$card->getLastModifiedAt()->format('d/m/Y á\s\ H:i:s')?></td>
              <td class="text-right">
                <div class="btn-group flex-btn-group-container">
                  <button type="submit"
                          href="<?=base_url()?>cards/<?=$card->getId()?>"
                          class="btn btn-info btn-sm">
                    <span class="hidden-xs hidden-sm">View</span>
                  </button>
                  <button type="submit"
                          href="<?=base_url()?>cards/<?=$card->getId()?>/edit"
                          class="btn btn-primary btn-sm">
                    <span class="hidden-xs hidden-sm">Edit</span>
                  </button>
                  <button type="submit"
                          href="<?=base_url()?>cards/<?=$card->getId()?>/delete"
                          class="btn btn-danger btn-sm">
                    <span class="hidden-xs hidden-sm">Delete</span>
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="row justify-content-md-center">
      <?=$pagination?>
    </div>
  </div>
</div>
