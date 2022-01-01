<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Sitemap extends CI_Controller {


    /**

     * Index Page for this controller.

     *

     */

    public function index()

    {

       $post = $this->model_app->create();
        $data = [
            'post'   => $post,
        ];
        $this->load->view('sitemap', $data);

    }

}