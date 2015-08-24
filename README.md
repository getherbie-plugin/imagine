# Herbie Imagine Plugin

`Imagine` ist ein [Herbie](http://github.com/getherbie/herbie) Plugin, das die gleichnamige OOP-Library zur 
Bildbearbeitung [Imagine](https://imagine.readthedocs.org) in deine Website einbindet.

Damit kannst du mit einem einfachen Shortcode an einem vorliegenden Bild umfangreiche und komplexe Bildmanipulationen
vornehmen.


## Installation

Das Plugin installierst du via Composer.

	$ composer require getherbie/plugin-imagine

Danach aktivierst du das Plugin in der Konfigurationsdatei.

    plugins:
        enable:
            - imagine


## Konfiguration

In der Konfigurationsdatei definierst du die gewünschten Filter.

    # plugins.config.imagine
    filter_sets:
        resize:                         # filter set: resize
            filters:
                thumbnail:
                    size: [280, 280]
                    mode: inset
        crop:                           # filter set: crop
            filters:
                crop:
                    start: [0, 0]
                    size: [560, 560]


Mit der obigen Konfiguration stehen dir nun zwei Imagine-Filter *resize* und *crop* zur Verfügung, die du in deinen 
Seiteninhalten auf Bilder anwenden kannst.


    [imagine mein-bild.jpg filter="resize"]
    
    [imagine mein-bild.jpg filter="crop"]


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

<http://www.getherbie.org/dokumentation/plugins/imagine>
