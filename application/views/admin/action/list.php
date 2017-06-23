<div class="main-container">
  <div class="main wrapper clearfix">
    <?= $this->session->flashdata("alert"); ?>
    <h2>Actions</h2>
    <button class="btn btn-primary" href="<?=base_url()?>actions/new">
      <span>Create a new Action</span>
    </button>

    <div class="">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Action Type</th>
            <th>Whatafield</th>
            <th>Deleted</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Last Modified By</th>
            <th>Last Modified At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($actions as $index => $action): ?>
            <tr>
              <td><?=$action->getId()?></td>
              <td><?=$action->getActionType()?></td>
              <td><?=$action->getWhatafield()?></td>
              <td>
                <?php if ($action->getDeleted()): ?>
                  <span class="badge badge-danger">
                    Archived
                  </span>
                <?php else: ?>
                  <span class="badge badge-success">
                    Active
                  </span>
                <?php endif; ?>
              </td>
              <td><?=$action->getCreatedBy()?></td>
              <td><?=$action->getCreatedAt()->format('d/m/Y á\s\ H:i:s')?></td>
              <td><?=$action->getLastModifiedBy()?></td>
              <td><?=$action->getLastModifiedAt()->format('d/m/Y á\s\ H:i:s')?></td>
              <td class="text-right">
                <div class="btn-group flex-btn-group-container">
                  <button type="submit"
                          href="<?=base_url()?>actions/<?=$action->getId()?>"
                          class="btn btn-info btn-sm">
                    <span class="hidden-xs hidden-sm">View</span>
                  </button>
                  <button type="submit"
                          href="<?=base_url()?>actions/<?=$action->getId()?>/edit"
                          class="btn btn-primary btn-sm">
                    <span class="hidden-xs hidden-sm">Edit</span>
                  </button>
                  <button type="submit"
                          href="<?=base_url()?>actions/<?=$action->getId()?>/delete"
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
