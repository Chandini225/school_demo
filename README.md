Home Page (index.php):
Display a list of all Student.
Each student should display the name, the email, the creation date, the class name, and the image (thumbnail).
Each student should have links to view, edit, and delete the student.
Use a JOIN query to fetch the class name associated with each student.
 
Create student (create.php):
Form with fields for the name, email, address, class (dropdown), and image upload.
Validate that the name is not empty and the image is of valid format (jpg, png).
On form submission, upload the image to the server, insert the new student into the database, and redirect to the home page.
Use a JOIN query to fetch classes for the dropdown.
 
View student (view.php): 
Display the full name, email, address of the student, the class name, and the image.
Show the creation date.
Use a JOIN query to fetch the class name.
 
Edit student (edit.php): 
Form pre-filled with the current name, email, address, class of the student (dropdown), and image upload option.
Validate that the name is not empty and the image is of valid format (jpg, png) if a new image is uploaded.
On form submission, update the student in the database and redirect to the home page.
Use a JOIN query to fetch classes for the dropdown.
 
Delete student (delete.php): 
Confirm the deletion of the student.
On confirmation, delete the student (and its image from the server) from the database and redirect to the home page.
 
Manage classes (classes.php): 
Display a list of all classes with options to add, edit, and delete classes.
Form to add a new class.
Edit and delete functionalities for classes.
 
Image Upload Handling: 
Store uploaded images in a directory named uploads.
Validate the image format (only jpg, png).
Ensure images have unique filenames to avoid overwriting.
