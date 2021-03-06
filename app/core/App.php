<?php
class App {
	protected $controller = 'HomeCtrl';
	protected $method = 'index';
	protected $params = [ ];
	public function __construct() {
		session_start ();
		if (! $this->checkAuthenticated ()) {
			call_user_func_array ( [ 
					new BenutzerCtrl (),
					'login' 
			], [ ] );
		} else {
			$url = $this->parseUrl ();
			if (file_exists ( '../app/controllers/' . $url [0] . '.php' )) {
				$this->controller = $url [0];
				unset ( $url [0] );
			}
			require_once '../app/controllers/' . $this->controller . '.php';
			
			$this->controller = new $this->controller ();
			
			if (isset ( $url [1] )) {
				if (method_exists ( $this->controller, $url [1] )) {
					$this->method = $url [1];
					unset ( $url [1] );
				}
			}
			$this->params = $url ? array_values ( $url ) : [ ];
			array_push ( $this->params, $_SESSION ['benutzer'] );
			call_user_func_array ( [ 
					$this->controller,
					$this->method 
			], $this->params );
		}
	}
	public function parseUrl() {
		if (isset ( $_GET ['url'] )) {
			return $url = explode ( '/', filter_var ( rtrim ( $_GET ['url'], '/' ), FILTER_SANITIZE_URL ) );
		}
	}
	public function checkAuthenticated() {
		if (isset ( $_SESSION ['benutzer'] )) {
			return true;
		} else {
			return false;
		}
	}
}
?>