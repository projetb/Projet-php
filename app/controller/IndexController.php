<?php

class IndexController extends Controller {
   
   public function index() {
    $this->view->list = Album::getPalma();
      $this->view->display();
   }

}
