# Website
Source code for my professional website (www.emilberbakov.com) 

This started off as a desire to build my own relational database to keep track of my ever-expanding library.
I ETL'd my database content from Open Library's Monthly Data Dump.

This project has since expanded to a website that allows for:
1. Account creation
2. Searching my database or falling back to cURL requests to Open Library through their RESTful API if the database search returns nothing
3. Allowing users to create and maintain their library

This is in active development, and as such is missing some features.
Highest up on the list are as follows:
1. Allow users to remove books from their libraries
2. In the event the user had to fall back on a cURL request, take the data from said request and upload it to the database.  If you notice that some entries in your library are missing everything but the Open Library ID, this will fix that.
3. Add Authorship information to both the Search Results and the user's Library View
4. On account creation, require the user to enter their password twice
5. Password reset
6. Add pages to both Library View and Search Results, just in case either get really long
7. Allow for bulk upload through csv and/or other import types
8. Allow to upload more than one book at a time (you can do that now, but they all have to either be similar in title or share an ISBN).


Some fun things I plan on implementing:
1. A Forum
2. Profile Pictures

If you have any suggestions, please let me know!  I'd love to hear how I can make this site and this project better!
