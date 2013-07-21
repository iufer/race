RACE APP
Social bike racing. 

[Screenshots of the app in action](http://imgur.com/a/EfSb9?gallery)

Getting Started
===============

Testing in Vagrant
--------------------

    $ cd /path/to/race
    $ vagrant up
    Browse to http://localhost:8080/install to set it all up


Installation
------------

1.  Edit system/race/config/config.php
	-  Set base_url to your site root and configure the settings for your environment
2.  Create a new database and user with database and table permissions in MySQL
3.  Edit system/race/config/database.php
4.  Browse to http://yoursite.com/install
5.  Login to the Admin Panel http://yoursite.com/admin

    Default Admin User
    email: admin@admin.com
    password: admin

6.  Go to Settings and configure the options to customize your site.

After installation you can create more users and edit or delete the admin user.	

Dashboard
---------
This page is not being used to display anything yet.

Races
-----
To get started, add a new Race. 
Go to Races > New Race
You will be asked to select a course, but at this point you won't have any courses yet available so you can skip this option. Once you create the race it will be visible to the public unless you selected "Draft" or "Cancelled" as the status. 

Course
------
Next you should add a course. 
Go to Courses > New Course
Adding a course is very similar to adding a race, but you will be asked for a KML file so that the course can be mapped. You can find KML files on all the major sites like Bikely, MapMyRide, Strava and Garmin Connect. This is a google maps format and you can even create these paths using Google Maps or Google Earth.
Once you create a course, return to the race you just made and set the course to the one you just made.

Series
------
Now that you have created your first race, you can create your first series.
Go to Series > New Series
A Series is a collection of races and the results across all the races will be automatically tallied. 

Results and Riders
------------------
To add a new rider, you must first add a result.
Go to Races > Race Index > *your new race* > Results Tab
The Add Results window will help to make entering results data as painless and as flexible as possible. Type the new rider's name into the rider name field. Leave the ID box blank. Select which category they are in. Now you can move on to entering the first result. Select the type of result data from the pull down. In this example, select Time and in the Data field type "30:15" which will be interpreted as 30 minutes and 15 seconds. Click submit to save the result. The rider will automatically be created and the result applied to the race results. You can edit or delete individual results. 

If you find yourself entering multiple data items for a rider you can click the [ + ] button to add more rows. You can enter as many data items for an individual at once as you wish. 
If you are adding a result for a rider already in the system, start typing their name and an auto-complete list will appear. You can select the rider from the list and their ID will auto-populate. This can save you time having to type out the rider's full name every time.
For Time Trials, it might be easiest to simply enter in the time results for each rider and then let the system figure out the placings. This can be done by clicking on "Create rider placings based on time" in the Actions menu at the bottom of the results page.
You cannot add a rider without first entering in a result.
Riders can be edited from the Riders > Rider Index page

Messages
--------
This feature lets you show a message on the site. Examples of this might be for announcements, or cancellations. 
Messages can auto-expire after a particular date and time.

Sponsors
--------
You can add sponsor logos to the site. You can also apply a sponsor to a particular race and their logo will appear on the race detail page.




