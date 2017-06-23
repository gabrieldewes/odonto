<?php

function PaginationLinks($count, $limit, $action=null) {
  $config['base_url'] = base_url() . $action;
  $config['total_rows'] = $count;
  $config['per_page'] = $limit;
  $config['page_query_string'] = true;
  $config['use_page_numbers'] = true;
  $config['query_string_segment'] = 'page';
  $config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination">';
  $config['full_tag_close'] 	= '</ul></nav></div>';
  $config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
  $config['num_tag_close'] 	= '</span></li>';
  $config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
  $config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
  $config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
  $config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
  $config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
  $config['prev_tagl_close'] 	= '</span></li>';
  $config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
  $config['first_tagl_close'] = '</span></li>';
  $config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
  $config['last_tagl_close'] 	= '</span></li>';
  $ci =& get_instance();
  $ci->pagination->initialize($config);
  return $ci->pagination->create_links();
}

?>
