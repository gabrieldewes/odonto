<div class="main-container">
  <div class="main wrapper clearfix">

    <div class="row">
        <div class="col-12 text-center">
          <div alt="Profile photo" class="profile-photo"
            style="background-image: url(https://randomuser.me/api/portraits/women/<?=rand(0,100)?>.jpg)">
          </div>
        </div>

        <div class="col-12 text-center">
          <h2><?=trim("{$principal->getFirstName()} {$principal->getLastName()}")?></h2>
        </div>

        <div class="col-12 text-center">
          <p><?=$principal->getUsername()?></p>
        </div>

        <div class="col-12 text-center">
          <p><?=$principal->getEmail()?></p>
        </div>

        <div class="col-12 text-center">
          <?php foreach ($principal->getRoles() as $i => $r): ?>
            <p><?=str_replace("ROLE_","", $r)?></p>
          <?php endforeach; ?>
        </div>

        <div class="col-12 text-center">
          <a href="<?=base_url() ."logout"?>">Logout</a>
        </div>

      </div>
    </div>
  </div>
</div>
