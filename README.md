TV Show Manager
===============

My way to lear SF2. Tool to help keep track of all TV series you watch.
As a bonus: links to services providing checksums of files with latest episodes.

New search providers should implement `SearchProviderInterface`.

TODO
----

* Active navigation item in menu (done in lame way)
* Handle Isohunt provider (done, add referer support)
* Make better layout (well...)

BUGS
----

* Edit tv show, enter episode "-1", click "Edit", get validation error. 
  Button "Edit" is now "Add", and so is form submit action.
