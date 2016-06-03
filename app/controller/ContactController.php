<?php

class ContactController extends Controller {
	
	public function afficherListe(){
		$this->view->list = Album::getList();
		$this->view->display(); 

	}
	public function afficherContact() {
		$id = $this->route["params"]["id"];
		$this->view->contact = Contact::getFromId($id);
		$this->view->display();
	}
}
?>
