<?php
class HomeCtrl extends Controller {
	public function index() {
		$benutzer = $_SESSION ['benutzer'];
		$this->view ( 'home/index', [ 
				'benutzer' => $benutzer 
		] );
	}
}