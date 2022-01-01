<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Sitemap extends CI_Controller {


    /**

     * Index Page for this controller.

     *

     */

    public function index()

    {

        $query = $this->db->get("posting");
        $data['items'] = $query->result();
        $this->load->view('sitemap', $data);

    }

}