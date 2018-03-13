<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('fb_share_config'))
{
  function fb_share_config($event="")
  {
    if(!empty($event)) {
      switch($event)
      {
        case 'latihan_finish':
        $fb_config = array(
            'href'        => base_url(),
            'picture'     => base_url().'assets/dashboard/images/sma.jpg',
            'title'       => '[Nama] Menyelesaikan [Judul Latihan]!',
            'description' => 'Aku sudah menyelesaikan latihan di PrimeMobile. Ayo kamu juga!',
            'caption'     => 'primemobile.co.id'
        );
        break;
        
        default:
        $fb_config = array(
            'href'        => base_url(),
            'picture'     => base_url().'assets/dashboard/images/logo-red3.jpg',
            'title'       => 'Prime Mobile',
            'description' => 'E-Learning Integrative Pertama di Indonesia',
            'caption'     => 'primemobile.co.id'
        );
        break;
      }
      return $fb_config;
    }
    else {
      return FALSE;
    }
  }
}

/* End of file socmed_helper.php */
/* Location: ./application/helpers/socmed_helper.php */