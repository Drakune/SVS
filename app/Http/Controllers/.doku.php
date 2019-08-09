In diesem Ordner findet man die Controller. Die sind dafür zuständing um Seiten zurückzuliefern oder Dinge zu berechnen oder zu speichern. Alles was mit Daten zu tun hat regelt der Controller.

Mit Auth::check() kontrolliert man, ob derjenige, der gerade die Seite benutzt, ein registrierter Benutzer ist oder nicht. Dazu kommt meistens noch die Abfrage, ob der Benutzer ein Admin ist:

$user->where('name',Auth::user()->name)->value('role') == 'admin'.

