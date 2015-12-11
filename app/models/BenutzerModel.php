<?php
class BenutzerModel {
	public $benutzername;
	public $kennwort;
	public $kennwort2;
	public $vorname;
	public $nachname;
	public $anmeldeart;
	public $error;
	function BenutzerModel() {
		$this->error = null;
		$this->anmeldeart = "A";
	}
	private function db_connect() {
		$con = mysqli_connect ( "", "root" );
		/* Datenbankauswählen */
		mysqli_select_db ( $con, "phpmvclogin" );
		return $con;
	}
	private function db_disconnect($con) {
		mysqli_close ( $con );
	}
	public function exist() {
		$con = $this->db_connect ();
		
		$sel = "select * from benutzer where benutzername = '" . $this->benutzername . "' ";
		$res = mysqli_query ( $con, $sel );
		$num = mysqli_num_rows ( $res );
		mysqli_close ( $con );
		if ($num > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function checkKennwort() {
		$con = $this->db_connect ();
		$sel = "select * from benutzer where benutzername = '" . $this->benutzername . "' and kennwort = '" . md5 ( $this->kennwort ) . "'";
		$res = mysqli_query ( $con, $sel );
		$row = mysqli_fetch_object ( $res );
		if (null == $row) {
			mysqli_close ( $con );
			return false;
		}
		$this->vorname = $row->vorname;
		$this->nachname = $row->nachname;
		
		mysqli_close ( $con );
		return true;
	}
	public function insertNewBenutzer() {
		$con = $this->db_connect ();
		
		$sel = "insert into benutzer (benutzername, kennwort, vorname, nachname) values ( '" . $this->benutzername . "', '" . md5 ( $this->kennwort ) . "','" . $this->vorname . "', '" . $this->nachname . "')";
		
		$res = mysqli_query ( $con, $sel );
		mysqli_close ( $con );
		return $res;
	}
}
?>