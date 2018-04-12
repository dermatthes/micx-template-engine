# micx-base-project
Composer base project for micx

## Entwicklungsziele

- Alles ist Relativ.

Dateien 


## Verzeichnisstruktur

Unter `@vendor` können per `micx install free|non-free:<template>` templates ausgecheckt werden.

## Default-Verhalten

Normalerweise liefert der Service die Seiten ganz normal aus. Erst durch die Middleware kommt die Logik rein.

## Konfiguration

Jedes Modul bringt seine JMS Serialisierbaren Objekte mit.


## Per default und nicht überschreibbare ACLs:

/.acme/pull
/cockpit   => @owner @admin
/login    => @all

## Im Cockpit können sich Module reinhängen, die u.a. Blogfunktion, Benutzerverwaltung etc. bereitstellen.

Diese Module werden im kommerziellen Container bzw. Repo verknüpft.