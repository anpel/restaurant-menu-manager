Restaurant Menu Manager
======================

About
-----

With this small application you can add categories and plates to the
menu, edit plate names, translations and prices inline, reorder how the 
categories appear in the print version of the menu and make plates 
unavailable for the day.

When you are happy with the plates on your menu you can get a printable
version so you can create daily menus easily.


Requirements
------------

 - PHP > 5.4 (I guess you can go with earlier versions too if 
 you change the `[]` arrays)
 - MySQL 5.6 (That's the one I used for development, other 
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

My best guess would be that I ran into some issues with bootstrap table and I
went with the fastest route to get it running.


License
-------

This software is licensed under the [GPL v3 license](http://www.gnu.org/copyleft/gpl.html).
© 2017 Andreas Pelekoudas
