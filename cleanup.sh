#!/usr/bin/bash

#
# Shell script for removal of old generated incipits
#

#INCIPITDIR=www/mss/incipits
INCIPITDIR=/var/www/ms-lute/incipits

# disk usage before
echo -n "`date +'%D %H:%M'`: $INCIPITDIR `du -sh $INCIPITDIR | cut -f 1` -> "

# remove files older than one day, but not safeguard file
touch "$INCIPITDIR/do-not-remove"
find "$INCIPITDIR" -type f -mtime +1 -delete

# remove empty directories
find "$INCIPITDIR" -type d -empty -delete

# disk usage after removal
du -sh "$INCIPITDIR" | cut -f 1

