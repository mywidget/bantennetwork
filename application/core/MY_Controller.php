<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
  /**
 * @route:product/(:num)
 * @route:product
 */
  function product( $parm ){
    //url1: /example-route/product/1
    //url2: /example-route/product
  }
}