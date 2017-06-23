<div class="main-container">
  <div class="main wrapper clearfix">
    <?= $this->session->flashdata("alert"); ?>
    <h2>Users</h2>
    <button class="btn btn-primary" href="<?=base_url()?>users/new">
      <span>Create a new User</span>
    </button>

    <div class="">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>E-Mail</th>
            <th>Active</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Last Modified By</th>
            <th>Last Modified At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $index => $user): ?>
            <tr>
              <?php $disabled = $this->AuthService->getCurrentUserUsername() === $user->getUsername() ? "disabled" : ""; ?>
              <td><?=$user->getId()?></td>
              <td><?="{$user->getFirstName()} {$user->getLastName()}"?></td>
              <td><?=$user->getEmail()?></td>
              <td>
                <?php if ($user->getDeleted()): ?>
                  <span class="badge badge-danger">
                    Archived
                  </span>
                <?php else: ?>
                  <span class="badge badge-success">
                    Active
                  </span>
                <?php endif; ?>
              </td>
              <td><?=$user->getCreatedBy()?></td>
              <td><?=$user->getCreatedAt()->format('d/m/Y á\s\ H:i:s')?></td>
              <td><?=$user->getLastModifiedBy()?></td>
              <td><?=$user->getLastModifiedAt()->format('d/m/Y á\s\ H:i:s')?></td>
              <td class="text-right">
                <div class="btn-group flex-btn-group-container">
                  <button type="submit"
                          href="<?=base_url()?>users/<?=$user->getId()?>"
                          class="btn btn-info btn-sm">
                    <span class="hidden-xs hidden-sm">View</span>
                  </button>
                  <button type="submit"
                          href="<?=base_url()?>users/<?=$user->getId()?>/edit"
                          class="btn btn-primary btn-sm">
                    <span class="hidden-xs hidden-sm">Edit</span>
                  </button>
                  <button type="submit"
                          <?= $disabled ?>
                          href="<?=base_url()?>users/<?=$user->getId()?>/delete"
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
