<?php
class BenutzerCtrl extends Controller {
	function BenutzerCtrl() {
	}
	/**
	 * Überprüfen ob der Benutzer schon angemeldet ist
	 * - ja -> dann gehts weiter auf home
	 * - nein -> dann ab auf den Login-Schirm
	 *
	 * @return boolean
	 */
	function login() {
		$benutzer = $this->getBenutzerDataFromRequest ();
		
		if ($this->authenticate ( $benutzer )) {
			$_SESSION ['benutzer'] = $benutzer;
			$this->view ( 'home/index', [ 
					'benutzer' => $benutzer 
			] );
			return true;
		} else {
			$this->view ( 'Login/login', [ 
					'benutzer' => $benutzer 
			] );
			return false;
		}
	}
	/**
	 * - neues BenutzerModel erzeugen
	 * - übernehmen der Benutzerdaten aus dem Request
	 */
	private function getBenutzerDataFromRequest() {
		$benutzer = $this->model ( 'BenutzerModel' );
		$benutzer->benutzername = isset ( $_POST ['benutzername'] ) ? $_POST ['benutzername'] : '';
		$benutzer->kennwort = isset ( $_POST ['kennwort'] ) ? $_POST ['kennwort'] : '';
		$benutzer->kennwort2 = isset ( $_POST ['kennwort2'] ) ? $_POST ['kennwort2'] : '';
		$benutzer->anmeldeart = isset ( $_POST ['anmeldeart'] ) ? $_POST ['anmeldeart'] : 'A';
		$benutzer->vorname = isset ( $_POST ['vorname'] ) ? $_POST ['vorname'] : '';
		$benutzer->nachname = isset ( $_POST ['nachname'] ) ? $_POST ['nachname'] : '';
		return $benutzer;
	}
	
	/**
	 * Feststellen ob der Benutzer
	 * - neu angelegt werden soll oder
	 * - schon vorhanden ist und das richtige Kennwort eingegeben wurde.
	 *
	 * @param unknown $benutzer        	
	 */
	function authenticate($benutzer) {
		$authentic = false;
		if ("N" == $benutzer->anmeldeart) {
			if (empty ( $_POST ['benutzername'] )) {
				$benutzer->error = "Bitte geben Sie den Benutzernamen ein.";
				return false;
			}
			if (empty ( $_POST ['vorname'] )) {
				$benutzer->error = "Bitte geben Sie den Vornamen ein.";
				return false;
			}
			if (empty ( $_POST ['nachname'] )) {
				$benutzer->error = "Bitte geben Sie den Nachnamen ein.";
				return false;
			}
			if (empty ( $_POST ['kennwort'] ) || empty ( $_POST ['kennwort2'] )) {
				$benutzer->error = "Bitte geben Sie beide Kennwortfelder ein";
				return false;
			}
			if ($_POST ['kennwort2'] != $_POST ['kennwort']) {
				$benutzer->error = "Kennw&ouml;rter stimmen nicht &uuml;berein.";
				return false;
			}
			if (! $benutzer->insertNewBenutzer ()) {
				$benutzer->error = "Fehler beim Anlegen des neuen Benutzers!";
				return false;
			}
		}
		if ( empty( $benutzer->benutzername ) ) {
			return false;
		}
		if ($benutzer->exist ()) {
			if ($benutzer->checkKennwort ()) {
				$authentic = true;
			} else {
				$benutzer->error = "Kennwort falsch.";
			}
		} else {
			$benutzer->error = "Benutzer nicht vorhanden.";
		}
		
		return $authentic;
	}
	/**
	 * Abmelden
	 */
	function logout() {
		session_destroy ();
		$benutzer = $this->model ( 'BenutzerModel' );
		$this->view ( 'Login/login', [ 
				'benutzer' => $benutzer 
		] );
	}
}
?>
