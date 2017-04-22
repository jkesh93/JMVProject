# JMVProject (Jay's database of Motor Vehicles)
### By Jay
---
### General Premise
##### I built this for my COS455 class to learn php and to help others learn php as well.
 
  
---

### Files
| File                  | Type                 | Purpose                                                                  				   |
|-----------------------|:--------------------:|-------------------------------------------------------------------------------------------|
| database              | directory            | build the database with files included here                                               |
| search                | directory            | search the database files included here                                                   |
| view                  | directory            | view table page is in here                                                                |
| add                   | directory            | add page is in here  												                       |
| delete                | directory            | delete page is in here 												                   | 
| update                | directory            | update page is in here 											                       |
| connectscripts        | directory            | php scripts for connecting to database are in here                                        |
| viewTables.php        | php file 			   | page which gives user selection of which table they wish to view                          |
| baseCode.php          | php file 			   | the template for each of the table pages								                   |
| index.php             | php file 			   | the starting point 													                   |
| userLoggedIn.php 		| php file 			   | once user has logged in this is where they can choose which CRUD function they want to do |
| register.php 			| php file 		 	   | this is  the page where users can register 											   |

---

### Requirements to GUAR (Get Up and Running):
* #### [WAMP](http://www.wampserver.com/en/)
* #### cars database
* #### reguser database (registered users)
##
#### The databases can be built by going into `directory -> buildScripts`. Select `dmvTable.sql` and `tables.sql` and copy their contents and run them in a mysql shell after you've created databases `cars` and `dmvadmin`. 
##
#### This will build your databases. 
##
#### NOTE: `YOU MAY HAVE TO ADJUST connectScripts TO REFLECT YOUR PARTICULAR SETTINGS`.