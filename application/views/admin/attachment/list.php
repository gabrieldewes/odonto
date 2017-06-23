<div class="main-container">
  <div class="main wrapper clearfix">
    <?= $this->session->flashdata("alert"); ?>
    <h2>Attachments</h2>
    <button class="btn btn-primary" href="<?=base_url()?>attachments/new">
      <span>Create a new Attachment</span>
    </button>

    <div class="">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Alt</th>
            <th>Deleted</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Last Modified By</th>
            <th>Last Modified At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($attachments as $index => $attach): ?>
            <tr>
              <td><?=$attach->getId()?></td>
              <td><?=$attach->getAlt()?></td>
              <td>
                <?php if ($attach->getDeleted()): ?>
                  <span class="badge badge-danger">
                    Archived
                  </span>
                <?php else: ?>
                  <span class="badge badge-success">
                    Active
                  </span>
                <?php endif; ?>
              </td>
              <td><?=$attach->getCreatedBy()?></td>
              <td><?=$attach->getCreatedAt()->format('d/m/Y á\s\ H:i:s')?></td>
              <td><?=$attach->getLastModifiedBy()?></td>
              <td><?=$attach->getLastModifiedAt()->format('d/m/Y á\s\ H:i:s')?></td>
              <td class="text-right">
                <div class="btn-group flex-btn-group-container">
                  <button type="submit"
                          href="<?=base_url()?>attachments/<?=$attach->getId()?>"
                          class="btn btn-info btn-sm">
                    <span class="hidden-xs hidden-sm">View</span>
                  </button>
                  <button type="submit"
                          href="<?=base_url()?>attachments/<?=$attach->getId()?>/edit"
                          class="btn btn-primary btn-sm">
                    <span class="hidden-xs hidden-sm">Edit</span>
                  </button>
                  <button type="submit"
                          href="<?=base_url()?>attachments/<?=$attach->getId()?>/delete"
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
