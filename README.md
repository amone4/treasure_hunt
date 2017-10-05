# Treasure Hunt Website
The website can be used to conduct a simple treasure hunt at the university level.<br>
The event requires a team of two people, solving hourly updated questions, based on visual clues.<br>
The site uses PHP, MySQL, and simple front end technologies.<br>
The breakdown of files are as follows:<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	.htaccess – the file does not allow direct access to the .inc files<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	index.php – this is the main controller of the website. It handles requests and includes pages accordingly.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	connect.inc.php – it is responsible for three important things: starting the session, connecting to the database, and setting the timezone. It is included at the top of the index.php file.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	phpfunc.inc.php – it contains the definition of all the user defined functions used in the project.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	home.inc.php – it is the landing page and allows the user to sign in with his/her team number and the provided password.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	pass.inc.php – the file helps changing the password.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	question.inc.php – displays the question according to time and accepts answers accordingly.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	database.sql – it contains the details of the tables and the corresponding queries for MySQL.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	generate_password.php – a script that would generate a default password for all the teams. The default password consists of the first two characters of name, roll number and phone number of both the team members. The passwords are stored using the sha2 hash function.
