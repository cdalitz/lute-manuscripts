#!/usr/bin/bash

#
# Shell script for removal of old generated incipits
#

INCIPITDIR=www/mss/incipits

# remove files older than one day, but not safeguard file
touch "$INCIPITDIR/do-not-remove"
find "$INCIPITDIR" -type f -mtime +1 -delete

# remove empty directories
find "$INCIPITDIR" -type d -empty -delete
