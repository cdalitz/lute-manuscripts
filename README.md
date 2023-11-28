# Lute Manuscript Database

This repository contains a database of lute manuscript sources with incipits
in *abctab* format, together with a web based GUI frontend for viewing the
content of the database.

The data of the lute sources database is stored in the following CSV files:
 - `data/MssNames.csv` - meta information of all manuscripts
 - `data/Concordances.csv` - all concordances
 - `mss/*.csv` - the contents of all manuscripts with incipits
 
As a GUI frontend, a PHP implementation is provided, which requires an Apache
webserver with PHP activated. The incipits are generated on the fly with the
programs *abctab2ps*, *ghostscript*, *ps2eps*, *dvisvgm* (for SVG), and
*ImageMagick* (for PNG).

> :warning: As the incipits are generated on the fly and anew for each access,
> it is recommended to run the frontend only locally. Otherwise it will fill
> up your hard disk after some time. 

