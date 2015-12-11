<html>
<head>
<link href="/phpmvclogin/app/views/login/login.css" rel="stylesheet">
<script src="/phpmvclogin/app/ventors/js/jquery-2.1.4.min.js"></script>
<script src="/phpmvclogin/app/views/login/login.js"></script>
</head>
<body>
	<div id="login-controls">
<?php if (isset($data['benutzer']->error)){?>
	<div class="error-text">
			<p>
	<?php echo $data['benutzer']->error ?></p>
		</div>
<?php }?>		
		<form method="POST" action="/phpmvclogin/public/benutzerCtrl/login">
			<input type="radio" name="anmeldeart" value="A"
				<?php if ('A' == $data['benutzer']->anmeldeart) echo "checked"?>>Anmelden
			<input type="radio" name="anmeldeart" value="N"
				<?php if ('N' == $data['benutzer']->anmeldeart) echo "checked"?>>Neu
			anmelden
			<h2>Anmeldung</h2>
			<div class="row">
				<div class="col">Benutzername:</div>
				<div class="col">
					<input type="text" name="benutzername"
						value="<?php echo $data['benutzer']->benutzername ?>" />
				</div>
			</div>
			<div class="row">
				<div class="col">Kennwort:</div>
				<div class="col">
					<input type="password" name="kennwort"
						value="<?php echo $data['benutzer']->kennwort ?>" />
				</div>
			</div>
			<div id="neu_anmelden">
				<div class="row">
					<div class="col">Kennwort wiederholen:</div>
					<div class="col">
						<input type="password" name="kennwort2"
							value="<?php echo $data['benutzer']->kennwort2 ?>" />
					</div>
				</div>
				<div class="row">
					<div class="col">Vorname:</div>
					<div class="col">
						<input type="text" name="vorname"
							value="<?php echo $data['benutzer']->vorname ?>" />
					</div>
				</div>
				<div class="row">
					<div class="col">Nachname:</div>
					<div class="col">
						<input type="text" name="nachname"
							value="<?php echo $data['benutzer']->nachname ?>" />
					</div>
				</div>
			</div>
			<br> <input type="submit" name="op" value="anmelden" />
		</form>
	</div>
</body>
</html>