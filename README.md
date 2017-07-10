Restaurant Menu Manager
======================

About
-----

A restaurant owner once asked me for a quick way to update the daily plates
and print the menu with the new ones in 3 languages.

With this small application you can edit plates inline, reorder the category
appearance position and make plates unavailable for the day.

It also creates a printable version of the avaialable plates so you can print
them easily.


Requirements
------------

 - PHP > 5.4 (I guess you can go with earlier versions too if 
 you change the [] arrays)
 - MySQL 5.6 (Thats the one I used for development, other 
 versions may work as well)


Installation
-----------

- Copy the files to your server
- Create a database named `restaurant_manager` and import the schema
- Change the credentials in `includes/database.php`.
- If the server is on the internet, password protect the directory.


AJAX Disclaimer
---------------

For some reason I used AJAX for everything, I wrote this a few months ago under
pressure.

At the current time only God knows why I chose to load all data with AJAX.

My best guest would be that I ran into some issues with bootstrap table and I
went with the fastest route to get it running.


License
-------

This software is licensed under the [GPL v3 license][gpl].
© 2017 Andreas Pelekoudas
