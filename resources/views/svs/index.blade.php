<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <style>
    	.border-black {
    		border-color: black;
    	}
    	body {
    		padding: 50px;
    		text-align: center;
    	}
    </style>
    <header>
        <u><h1 class="text-center">
        	Schlüsselverwaltungssystem<br>
        </h1></u>
        <br>
    </header>
    <body>
    	<main>
	       	<b><u><p>Schlüssel aufhängen:</p></u></b>
			<form method="POST" action="/storeKeyIntoShelf">
				{{ csrf_field() }}
				<div>
					<input class="btn border-black text-left" type="text" placeholder="Regalplatznummer" name="rpnr">
					<input class="btn border-black text-left" type="text" placeholder="Schlüsselname" name="keyname">
					<button class="btn border-black text-left" type="submit" name="aufhaengen">Schlüssel aufhängen</button>
				</div>
				<br>
			</form>

			<b><u><p>Schlüssel abhängen:</p></u></b>

			<form method="POST" action="/takeKeyOutOfShelf">
				{{ csrf_field() }}
				<div>
					<input class="btn border-black text-left" type="text" placeholder="Schlüsselname" name="keyname">
					<button class="btn border-black text-left" type="submit" name="abhaengen">Schlüssel abhängen</button>
				</div>
				<br>
			</form>

			<b><u><p><br>Regalplatz eintragen:</p></u></b>

			<form method="POST" action="/storeShelf">
				{{ csrf_field() }}
				<div>
					<input class="btn border-black text-left" type="text" name="rpnr" placeholder="Nummer">
					<button class="btn border-black text-left" type="submit">Regalplatz eintragen</button>
				</div>
				<br>
			</form>

			<div class="shadow-lg p-3 mb-5 bg-white" style="border-radius: 25px;margin: 0px 150px 0px 150px;">
				<?php
					echo "<u>Alle Regalplätze:</u> <br><br>";
					foreach ($shelf as $shelfItem) {
						$keys = $shelfItem->key;
						if($keys)
							echo "<li><u>Der Regalplatz ".$shelfItem->nummer, " beinhaltet den Schlüssel ".$keys->name."</u></li>";
						if(!$keys) {
							echo "<li>Der Regalplatz ".$shelfItem->nummer." ist leer</li>";
						}
					}
					echo "<br>";
				?>
	        </div>

			<b><u><p><br>Schlüssel eintragen:</p></u></b>

			<form method="POST" action="/storeKey">
				{{ csrf_field() }}
				<div>
					<input class="btn border-black text-left" type="text" name="keyname" placeholder="Name">
					<input class="btn border-black text-left" type="text" name="keyDescription" placeholder="Beschreibung (optional)">
					<button class="btn border-black text-left" type="submit">Schlüssel eintragen</button>
				</div>
				<br>
			</form>

			<div class="shadow-lg p-3 mb-5 bg-white" style="border-radius: 25px;margin: 0px 150px 0px 150px;">
		    	<?php
					echo "<u>Alle Schlüssel:</u> <br><br>";
					foreach ($key as $keyItem) {
						$shelfs = $keyItem->shelf;
						if($shelfs)
							echo "<li><u>Der Schlüssel ".$keyItem->name, " liegt im Regalplatz ".$shelfs->nummer."</u></li>";
						if(!$shelfs) {
							echo "<li>Der Schlüssel ".$keyItem->name." wurde noch nicht aufgehangen!</li>";
						}
					}
					echo "<br>";
				?>
	        </div>
    	</main>
    </body>
</html>