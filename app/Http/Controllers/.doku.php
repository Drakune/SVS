In diesem Ordner findet man die Controller. Die sind dafür zuständing um Seiten zurückzuliefern oder Dinge zu berechnen oder zu speichern. Alles was mit Daten zu tun hat regelt der Controller.

Mit Auth::check() kontrolliert man, ob derjenige, der gerade die Seite benutzt, ein registrierter Benutzer ist oder nicht. Dazu kommt meistens noch die Abfrage, ob der Benutzer ein Admin ist:

$user->where('name',Auth::user()->name)->value('role') == 'admin'.

Um die Schlüssel in einen Regalplatz zu packen, kopiert man sich die ID des Schlüssels, den man lagern möchte und kopiert diese ID in die Tabelle Shelfspace in den Datensatz shelf_key_id.

Als Beispiel: 

Man möchte den Schlüssel mit dem Namen "key" mit der ID 22 in den Regalplatz 85 mit der ID 12 tun. Zuerst kopiert man sich die ID vom Schlüssel; das wäre dann 22. 
Anschließend sucht man den Regalplatz 85 in der Tabelle und findet dort auch die ID. In der gleichen Reihe gibt es einen Eintrag namens shelf_key_id und dort wird die ID des Schlüssels, also die 22, hineinkopiert. 

Den Namen der Schlüssels und die Nummer des Regalplatzes entnimmt man aus den Textfeldern und sucht nach den 2 Kriterien in der Datenbank nach diesen Einträgen. Hat man die Reihen gefunden, kann man sie mit der update() funktion updaten.