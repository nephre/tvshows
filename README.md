TV Shows Manager
===============

My way to learn SF2. Tool to help keep track of all TV series you watch.
As a bonus: links to services providing checksums of files with latest episodes.

New search providers should implement `SearchProviderInterface`.

BUILD
-----
Build docker image and run it:

docker run --publish 8080:8000 --volume tvshowsdb:/tvshows/app/database --name tvshows --rm --detach tvshows:latest

TODO
----

* Add Rarbg provider
* On search screen, print search phrase (show SxxExx)
* Active navigation item in menu (done in lame way)
* Handle Isohunt provider (done, add referer support) - (obsolete?)
* Make better layout (well...)

BUGS
----

* Sure, but I've fixed all bugs I managed to find
