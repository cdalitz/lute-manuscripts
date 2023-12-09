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
> up your hard disk after some time due to webcrawlers.

## Authors and license

Copyright
 - 2009-2023: Markus Lutz (&dagger;) & Peter Steur
 - since 2023: Peter Steur (content) & Christoph Dalitz (programming)

Both data and code of this database may be freely used, copied,
and modified under the terms of the GNU General Public License,
version 3.0 or later. This means that it may be freely used and
distributed, but derived works must be put under the same license
again.

See the file `LICENSE` for details.

> :warning: If you make the web frontend publicly available, make
> sure to meet the legal requirements of your jurisdiction. Most notably,
> you must provide your contact information in `php_inc/contact.inc.php`,
> and you must adjust the data privacy declaration in `php_inc/datenschutz.inc.php`.

## Installation and setup

Running the web based frontend requires installation and configuration of 
the respective software on a Linux system, which is described in the 
follwoing sections. A debian based Linux system is assumed, e.g. Ubuntu.
A dollar sign in command lines stands for the shell prompt.

### Software incipit generation

Most required software comes with Ubuntu, so that you can install it
over its package manger with

    $ sudo apt install ghostscript ps2eps dvisvgm imagemagick

If you want to create PNG output, you must allow the processing of PS files in the ImageMagick configuration file `/etc/ImageMagick-6/policy.xml` with

    <policy domain="coder" rights="read|write" pattern="PS" />
    <policy domain="coder" rights="read|write" pattern="EPS" />

Moreover, you must install *abctab2ps*. Download the Debian package from
https://www.lautengesellschaft.de/cdmm/ and install it with

    $ sudo dpkg -i abctab2ps-*-x86_64.deb

If this does not work, download the source code, unpack it with `tar xvzf`,
change the installation location prefix `PREFIX` in `src/Makefile` from
`/usr/local` to `/usr`, and install it with

    $ cd src
    $ make
    $ sudo make install

This requires the Ubuntu package *g++* to be installed.

### Installation and configuration of Apache

Install Apache together with PHP with

    $ sudo apt install apache2 libapache2-mod-php

This will not only install Apache, but also start it listening to all
incoming requests as can be checked with

    $ sudo lsof -i

Apache should thus immediately be stopped and reconfigured to only listen
to localhost.

    $ sudo systemctl stop apache2

If you do not need Apache permanently, you can also disable its startup
at boot time with (use  enable  if you want to undo this at some later point)

    $ sudo systemctl disable apache2

To make Apache listen only to localhost, edit
`/etc/apache2/sites-available/000-default.conf` and replace

    Listen *:80     with      Listen 127.0.0.1:80

This will however not be sufficient, because Apache will still serve the 
default *DocumentRoot* to the world. To disable this, modify the following
lines in `/etc/apache2/apache2.conf` under the appropriate `<Directory ...>`
directives:

    Require all granted      to      Require ip 127.0.0.1

It is reasonable to setup a separate virtual domain for the MSS site, e.g.
*ms-lute* as follows:

1. Create the directory for the web content and grant your user write access:

        $ sudo mkdir /var/www/ms-lute
        $ sudo chown www-data:www-data /var/www/ms-lute
        $ sudo usermod -a -G www-data $USER

2. For testing, copy an entry site `index.html` to this directory

3. Add to `/etc/apache2/apache2.conf` the following entry:
   `ServerName localhost`

4. Copy `000-default.conf` to `/etc/apache2/sites-available/ms-lute.conf`
   with the options

        ServerName ms-lute.localhost
        DocumentRoot /var/www/ms-lute

5. Activate the site with

        $ sudo a2ensite ms-lute.conf
        $ sudo a2dissite 000-default.conf

Then restart Apache with `systemctl start apache2`  and the file `index.html`
should be visible in your browser under the URL `ms-lute.localhost`.

### Copy the lute database to Apache

Now you can remove the file `index.html` and cpy the content of the database
to the appropriate directory. If you are in the root of this git repository,
this is done with

    $ cd www-data
	$ cp -R * /var/www/ms-lute
    $ sudo chown -R www-data:www-data /var/www/ms-lute/*

Now the front page of the database should be visible in your web browser
under the URL `ms-lute.localhost`.

The incipits can be generated as SVG (requires *abctab2ps*, *ghostscript*,
*dvisvgm*) or PNG (requires *abctab2ps*, *ghostscript*, *ImageMagick*).
For PNG output, search for the variable `$usesvg` in `index.php` and set
it to `$usesvg = 0`; for SVG output, choose `$usesvg = 1`.

## Hints for troubleshooting

Errors in the PHP code or in the incipit generation are reported to
the Apache logfile, which is by default `/var/log/apache2/error.log`.
As the file is only accessible by *root*, you must use `sudo` to read it.

Typical errors are missing write permissions to `/var/www/ms-lute/incipits`
by the user under which Apache runs, or that the software for generating
the incipits is not found (check the environment vaiable `PATH` used by Apache)
or misconfogured. The process generates *abc* &rarr; *ps* &rarr; *eps* 
&rarr; *png* or *svg*, and the intermediate files are removed by default.
If you want to keep them for debugging, comment out the lines contianing
`unlink` in `pgp_inc/manuscript.inc.php`.
