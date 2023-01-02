**Note**: Since version 2.x this plugin is part of Herbie, see <https://github.com/getherbie/herbie/tree/2.x/plugins/imagine>.**

---

# Herbie Imagine Plugin

`Imagine` ist ein [Herbie](http://github.com/getherbie/herbie) Plugin, das die gleichnamige OOP-Library zur 
Bildbearbeitung [Imagine](https://imagine.readthedocs.org) in deine Website einbindet.

Dank Imagine können Bilder direkt bearbeitet und mit vorgefertigten Filtern und Effekten versehen werden. Imagine 
ist eine objektorientierte Bibliothek zur Bildmanipulation, die auf einem durchdachten Design aufbaut und dabei die 
aktuellsten Best-Practices nutzt. 


## Installation

Das Plugin installierst du via Composer.

	$ composer require getherbie/plugin-imagine

Danach aktivierst du das Plugin in der Konfigurationsdatei.

    plugins:
        enable:
            - imagine


## Konfiguration

Unter `plugins.config.imagine` stehen dir die folgenden Optionen zur Verfügung:

    # template path to twig template
    template: @plugin/disqus/templates/disqus.twig

    # enable shortcode
    shortcode: true

    # enable twig function and filter    
    twig: false
    
    # filter set definition
    filter_sets: 
       ...
        
        
## Filter konfigurieren

Um Imagine in Herbie nutzen zu können, muss für jedes Projekt die Konfiguration angepasst werden. Dabei können ein 
oder mehrere Filtersätze mit je einem oder mehreren Filtern definiert werden. Im folgenden Konfigurations-Beispiel 
haben wir zwei einfache Filter zum Skalieren und Ausschneiden eines Bildes erstellt.
        
    # define filter sets for use in shortcode
    filter_sets:
    
        # define resize filter
        resize:                         
            filters:
                thumbnail:
                    size: [280, 280]
                    mode: inset
                    
        # define drop filter                    
        crop:
            filters:
                crop:
                    start: [0, 0]
                    size: [560, 560]

Mit dieser Konfiguration stehen dir zwei Imagine-Filter `resize` und `crop` zur Verfügung, die du in deinen 
Seiteninhalten auf Bilder anwenden kannst.

Mit dem folgenden Code wird ein Bild auf eine maximale Grösse von 280 x 280 Pixel skaliert:

    [imagine mein-bild.jpg filter="resize"]
    
Und mit dem folgenden Code ein Bild mit der Grösse 560 x 560 Pixel ausgeschnitten:
    
    [imagine mein-bild.jpg filter="crop"]
    
Mit dem Aktivieren von Twig kannst du Imagine sowohl als Funkion als auch Filter in deinen Layoutateien nutzen:

    # Twig-Funktion
    {{ imagine(path="mein-bild.jpg", filter="bsp1") }}

    # Twig-Filter
    {{ "mein-bild.jpg" | imagine("bsp1") }}    


## Parameter    

- path / string / required
- filter / string / required
- alt / string
- class / string
- id / string
- style / string
- title / string
- width / int / default 0
- height / int / default 0,
- media / int / 1


## Demo

<https://herbie.tebe.ch/dokumentation/plugins/imagine>
