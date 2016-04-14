Dylan Chu
Justus Jackson
Daniel Weber
4/14/16
CMSC 433
Project 1 README



Parts of our project:
Databases:  	-class_list433 to store emails and classes already taken(up to 20)
		-user_list433 to store names and emails(Only used for info, not used for class searching)

DB password and username can be found in the code.  
			
433.css - Our Cascading Style Sheet used in all of the pages.

index.html - A login page that takes in a user's first name, last name, and email and pushes it to the database user_list433 and class_list433.  If the email is already in the database it does not make a new entry, but pulls from the existing entry.

login.php - An intermediate helper page that performs the database checking.  If the user is already in the db it pulls their list of completed classes, if they aren't it makes a new entry for them.  Either way it redirects to the class search page.

class_search.php - This page lets the user enter their classes as 3 digit class codes and add them to the database.  It will only accept valid class numbers and validates this against the list of possible classes.  It will retrieve previously taken classes if the user is already in the database.  Classes are kept in the array $classes and kept by the program via php SESSION variable.  Once the user hits submit, it goes to the available classes page, keeping the classes submitted(or retrieved) in a SESSION variable array.

available_classes.php - The final page displays classes that the user can take, based upon what they submitted to the page. It's basically brute force checking.  It is hardcoded to check for every prerequisite and then prunes duplicate entries and classes already taken at the end, before putting the list on the screen.  Classes already taken are stored in $classes.  The array that holds classes that the user can take is called $classesCanTake.  array_unique purges duplicate results.  array_diff removes the classes already taken from classesCanTake.  There's also a link to go back to the class_search page.
