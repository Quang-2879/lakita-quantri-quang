<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    protected function renderJSON($json) {

        // Resources are one of the few things that the json

        // encoder will refuse to handle.

        if (is_resource($json)) {

            throw new \RuntimeException('Unable to encode and output the JSON data.');

        }

        $this->output->enable_profiler(FALSE)

                ->set_content_type('application/json')

                ->set_output(json_encode($json));

    }
    
}