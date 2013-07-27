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

1.  Edit system/race/config/config.php to wokr in your environment
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

Course
------
If you just installed for the first time, the first thing you need to create is a course.

-  Login to the Admin by clicking "Director Login" in the footer
-  Go to Courses > New Course

All you need to do is give the course a name, but you can also include a KML file which will display the course on a google map. You can find KML files on all the major sites like Bikely, MapMyRide, Strava and Garmin Connect. The KML file is a google map format and you can even create these paths using Google Maps or Google Earth.
Once you create a course, you are ready to create your first Race.

Add a Race
----------

-  Login to the admin if you are not already
-  Go to Races > New Race

A race requires some basic information, such as a name and the date and time of the race. You will be asked to select a course, and here you can select the course that you created in the previous step. 

Series
------

Now that you have created your first race, you can start decide if you want to create your first series.

- Go to Series > New Series

A Series is a collection of races and the results across all the races will be automatically tallied. When creating a new series there is an option to attach races, and you should see the race you created in the previous step.


Results and Riders
------------------

There is no explicit way to add a rider in this app. Riders are added for the first time by creating a race result and entering a new name in the form.

- Go to Races > Race Index > *your new race* > Results Tab

The "Add Results" window will help to make entering results data as painless and as flexible as possible. Type the new rider's name into the rider name field. Select which category you want the new rider result to be placed in. Now you can add some result data, such as a time or points. 

Select the type of result data you wish to add. In this example, select "Time" and in the data field type "30:15" which will be interpreted as 30 minutes and 15 seconds. Click "Save Result". The rider will automatically be created and the result applied to the race results. You can edit or delete the result at any time. 

If you find yourself entering multiple data items for a rider you can click the [ + ] button to add more rows. You can enter as many data items for an individual at once as you wish. If you want to append another result to a rider, you can type their name again in the name field and it will intelligently know not to create another new rider, but it will add new results to the rider you specified. 

If you are adding a result for a rider already in the system, start typing their name and an auto-complete list will appear. You can select the rider from the list and their ID and previous rider category will auto-populate. This can save you time having to type out the rider's full name every time.

For Time Trials, it might be easiest to simply enter in the time results for each rider and then let the system figure out the placings. This can be done by clicking on "Create rider placings based on time" under the "Calculate Placings" tab.

Riders can always be edited from the Riders > Rider Index page

Messages
--------

This feature lets you show a message on the site. Examples of this might be for announcements, or cancellations. 

Messages can auto-expire after a particular date and time.

Sponsors
--------

You can add sponsor logos to the site. You can also apply a sponsor to a particular race and their logo will appear on the race detail page.

Flickr
------

To change the Flickr stream you'll need to find your Flickr user ID by using a tool like this one: http://idgettr.com/




