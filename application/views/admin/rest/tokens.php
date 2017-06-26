<div class="main-container">
  <div class="main wrapper clearfix">
    <?= $this->session->flashdata("alert"); ?>
    <h2>Tokens</h2>

    <style media="screen">
    td {
      max-width: 10em;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    </style>

    <div class="">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Token</th>
            <th>User ID</th>
            <th>Level</th>
            <th>Ignore Limits</th>
            <th>Is Private Key</th>
            <th>IP Adresses</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tokens as $index => $token): ?>
            <tr>
              <td><?=$token->id?></td>
              <td><?=$token->token?></td>
              <td><?=$token->user_id?></td>
              <td><?=$token->level?></td>
              <td><?=$token->ignore_limits?></td>
              <td><?=$token->is_private_key?></td>
              <td><?=$token->ip_addresses?></td>
              <td><?=$token->created_at?></td>
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
