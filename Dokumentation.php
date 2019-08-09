Betritt man die Seite wird ein redirect auf die index Seite vorgenommen.

siehe "svsNew/routes/web.php"

Der Controller wird aktiv und gibt dem Benutzer die index-Seite zurück.
Das nennt man dann ein GET-request...man fragt eine Seite an.
Anschließend landet man auf z.B der index-Seite, auf der man die Schlüssel auf- oder abhängen kann.

siehe "svsNew/resources/views/svs/"viewName""

Hängt man den Schlüssel ab, füllt man die Textfelder und ein POST-request wird gemacht. Somit werden die Daten aus den Textfeldern gezogen und weitergegeben an den Controller. Die Funktionen im Controller verarbeiten dann die Daten und packen sie in die Datenbank.

siehe "svsNew/app/Http/Controllers/MyController.php"