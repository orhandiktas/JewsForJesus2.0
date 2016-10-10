~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
WELCOME TO THE README FOR event_search (Tricorder)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

event_search started life as a shortcode that would allow users to do just that: search for events. As requirements expanded, it evolved into a place for Danny to hold code that needs to run outside the boot context of Wordpress and, by extension, the critical eyes of non-developers. It's become an epic enough that it should be given a project codename worthy of its grandeur and reflective of the blood, sweat, and tears that were shed to build this monument into what it is today. Therefore, Danny Shafer is proud to present: Tricorder. 

There are several categories of functionality stored here, that are various degress of complete:

event search by speaker name
event search by venue name
event search by location name
branch staff information acquisition
deputation information acquistion

So let's go through each of the files and folders and I'll explain what's up with them:

dome-publicity folder: this is the code that generates deputation information and should be left untouched. 
apiCall.php: this is a middle man between the various events pages and infinity.php. it might also be superfluous. 
error_log: I don't know and doubt it matters
eventSearch-untouched.php: a backup of a large file before refactoring it into other files. Good to leave untouched ;)
eventSearch.js: all the javascript needed to make the next file work
eventSearch.php: the php that calls BBEC to get event results 
eventSearchUnifiedPhp.php: this page is the php functionality that serves the following file's visual components. 
eventsUnified.php: the page that is meant to bring together both JfJ events as well as deputations. It is serviced by eventSearch.php. This page should be what ultimtely populates the JewsforJesus.org/events page. 
getUserInfo.php: this pulls individual staff information and should be turned into the person card. 
getBranchUserInfo.php: this pulls all the staff information from a branch. 
infinity.php: Yonas' bridge between BBEC and the Wordpress universe.
masterListOfZipCitiesEtc.php: just a list of all the zipcodes, cities, and whatnot in the United States. Nice. 
README.txt: a readme that educates you on all the cool stuff in the folder
searchForm.php: this is the file that populates the shortcode and is now deprecated. Its functionality needs to be translated into php files that can be accessed anywhere.

It should ultimately have the ability to pull information for these as well:

A Location page (this is another way of saying a branch page. It will utilize the person card as well.)
A Location card (this is a derivative of the location page but with just the summary rather than the staff list, probably should also have a param to get small or large.)
An Events page that can feed into the new jewsforjesus.org/events (this is eventsUnified.php)
An Event card that can be used anywhere
A Person card (this is a staff profile that can be used anywhere, probably should have a param that shows large or small versions)



                                _____
     ___________________________            ____
...  \____NCC_1701A_________|_// __=*=__.--"----"--._________
                    \  |        /-------.__________.--------'
               /=====\ |======/      '     "----"
                  \________          }]
                           `--------'

LLAP \\//_