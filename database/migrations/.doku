Die Migrations sind dafür da, um in der Datenbank die Tabellen zu generieren. Man wechselt in CMD in das Verzeichniss, in dem das Laravel Projekt liegt und gibt den Befehl "php artisan migrate" ein. So mit werden die Tabellen generiert.

Vorher muss man aber eine Datenbank anlegen mit dem Namen "svs", da Laravel keine Datenbank generiert sondern nur die Tabellen. Der Name der Datenbank kann aber auch in der Daten /app/.env geändert werden!

Mit Schema::create('name') wird eine neue Tabelle angelegt.

Mit $table werden die einzelnen Spalten angelegt. Jede Spalte hat auch Datentypen wie z.B einen boolean oder Integer. Dazu gibt es noch Parameter wie ->unique() oder ->default(). Unique sagt aus, dass jeder Eintrag nur ein mal existieren darf. Also darf z.B der Name "Peter" nicht zwei mal vorkommen. Default gibt den Standartwert an, wenn eine Reihe angelegt wird z.B NULL. Ausserdem gibt es noch ->nullable(). Gibt man diesen Parameter an, darf das Feld auch leer sein. Ansonsten muss das Feld ausgefüllt werden