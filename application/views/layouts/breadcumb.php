<?php
  $i=1;
  $uri = $this->uri->segment($i);
  $link = '<nav class="breadcrumb">';
  $link .= '<a class="breadcrumb-item" href="'. base_url() .'">';
  $link .= 'Home</a>';

  while($uri != '') {
    $prep_link = '';
    for ($j=1; $j<=$i; $j++) {
      $prep_link .= $this->uri->segment($j) .'/';
    }

    if ($this->uri->segment($i+1) == '') {
      $link .= '<span class="breadcrumb-item active">';
      $link .= ucfirst($this->uri->segment($i)) .'</a>';
    }
    else {
      $link .= '<a class="breadcrumb-item" href="'. base_url($prep_link) .'">';
      $link .= ucfirst($this->uri->segment($i)) .'</a>';
    }

    $i++;
    $uri = $this->uri->segment($i);
  }
  $link .= '</nav>';
  echo $link;
?>
