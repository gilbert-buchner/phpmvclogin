<html>
<body>
	<h1>phpmvclogin</h1>
	<h2>home</h2>
	<div id="logout">
		<p>
			<a href="/phpmvclogin/public/benutzerCtrl/logout">Abmelden</a>
	
	</div>
</body>
</html>
<?php
echo 'hallo ' . $data ['benutzer']->vorname . ' ' . $data ['benutzer']->nachname;

?>

