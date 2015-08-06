Newspaper Scanning Assistant
============================

Scanning Assistant is a tiny application meant to assist scanning technicians in creating frame-level metadata for newspapers during scanning.

In a mobile-compatible interface it:
+ Provides easy ways to enter Page Number, Date, Volume, Edition, and Issue Numbers as well as a means to flag a page for review and make a note.
+ Attempts to "guess" the next sequence to save time, when a new issue is begun, prompts a change in Date, Volume, Edition and Issue. 
+ Stores data in SQLite, so that a batch may be resumed
+ Outputs data in tab-delimited text for import into existing workflows

Version
-------

1.0

Technology
----------

Scanning Assistant requires the following to work properly:
  - PHP 5 or higher
  - PDO extension

Installation
------------

Unzip files into a web-accessible directory or local evironment. A secure location is advised, since the software creates and edits SQLite databases without requiring authentication. Visit:

```sh
http://[path_to_your_directory]/index.php
```

Screenshots and additional documentation may be found on the project wiki <https://github.com/ncdhc/newspaper-scanning-assistant/wiki>.

License
-------

SCANNING ASSISTANT 1.0

Copyright (C) 2014 North Carolina Digital Heritage Center <http://www.digitalnc.org/about>.

This program is free software: you can redistribute it and/or modify
it under the terms of the **GNU General Public License** as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses>.

Attribution
-----------

**Bootstrap** <http://getbootstrap.com>

**Bootswatch 'Darkly' Theme** <https://bootswatch.com/darkly/>