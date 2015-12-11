# phpmvclogin

PHP - MVC - Login

Beispiel für eine einfache Login-Anwendung unter Verwendung von 

* PHP
* MYSQL
* MVC-Pattern

# Model:
* BenutzerModel
  * Benutzerdaten (benutzername, kennwort, vorname, nachname)
  * speichert neuen Benutzer in der DB
  * schaut ob Benutzer schon vorhanden ist
  * überprüft das Kennwort

# View:
* Home

Hier landet der Benutzer nach erfolgreicher Autentifizierung.
* Login
Hier landet der Benutzer wenn er sich noch nicht angemeldet hat.
  * anmelden
  * neu anmelden

# Controller:
* BenutzerCtrl
* HomeCtrl




