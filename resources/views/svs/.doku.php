In diesem Ordner liegen alle PHP Seiten, die angezeigt werden, wenn ein Benutzer eine Website aufruft.

Unter svsNew/views/layouts findet man die Datei app.blade.php

Es ist ein Layout, das für jede Seite benutzt wird, um den Header mit den Buttons für die Verwaltung, Dashboard und Home anzuzeigen und die login und register optionen.

Für die Kuchendiagramme hab ich eine Google API benutzt. Man musste nur den Quellcode kopieren. Die Daten musste man selber füllen, das war aber ganz einfach.

In Laravel gibt es ein Addon namens Blade. Blade erlaubt es dir, Dinge wie {{ text }} zu benutzen um sich Variablen auszugeben. Ausserdem gibt es dann @foreach für for-Schleifen und @if für if-Abfragen.
So muss man nicht immer <?php ?> eingeben um sich etwas ausgeben zu lassen oder um simple if-Abfragen zu generieren.

Mit der Form und method="POST" entnimmt man aus allen Textfeldern, die von form umklammert sind, die Daten heraus. Dann wird eine Methode namens POST benutzt um diese entgegenzunehmen und zu verarbeiten.