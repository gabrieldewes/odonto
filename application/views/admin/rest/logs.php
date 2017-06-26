<div class="main-container">
  <div class="main wrapper clearfix">
    <?= $this->session->flashdata("alert"); ?>
    <h2>Logs</h2>

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
            <th>Uri</th>
            <th>Method</th>
            <th>Params</th>
            <th>Api Key</th>
            <th>IP Adress</th>
            <th>Time</th>
            <th>R Time</th>
            <th>Authorized</th>
            <th>Response Code</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($logs as $index => $log): ?>
            <tr>
              <td><?=$log->id?></td>
              <td title="<?=$log->uri?>"><?=$log->uri?></td>
              <td><?=$log->method?></td>
              <td title="<?=$log->params?>"><?=$log->params?></td>
              <td><?=$log->api_key?></td>
              <td><?=$log->ip_address?></td>
              <td><?=$log->time?></td>
              <td><?=$log->rtime?></td>
              <td><?=$log->authorized?></td>
              <td><?=$log->response_code?></td>
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
