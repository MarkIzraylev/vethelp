# VetHelp
A secure and responsive veterinary clinic website that allows users to sign up and log in, change user's profile information, easily find detailed information about the clinic, its doctors and services, and also order a phone call.

![image](https://github.com/MarkIzraylev/vethelp/assets/68638924/a81cea73-205e-4452-b8e1-c3698f6fadce)

## How to run the website
1. Import vethelp.sql file as a database dump on your PHP server (e.g., PHPMyAdmin).
2. Run a host for the website (e.g., localhost via XAMPP).
3. Go to [your host name]/[path to the project files]/index.php page in a browser.

## Site's logical structure
Provided on both Russian and English languages.

[a relative link](logical_structure.png)

## Client
### Tech used: JavaScript, jQuery, SCSS, lazy loading

The jQuery library was used to easier maipulate DOM objects. The functionality of the following interactive elements has been implemented:
* Appearance and hiding of preloaders to implement “lazy loading” functionality.
* Site header (a burger button is available on the mobile version of the site to open and collapse the navigation menu).
* Sliders for services and specialists sections, allowing you to navigate through media content either with single clicks on buttons or by long-pressing the mouse on a button.
* “Read more” button, which allows you to expand the text of the review in full by clicking it. JavaScript allows you to show this button when the height of the review text is greater than the height of the container in which it is located (i.e., when overflow occurs).

## Server
### Tech used: PHP, PDO, sessions, password hashing, PHPMailer (for user's email verification), PHPMyAdmin
Database diagram:

![image](https://github.com/MarkIzraylev/vethelp/assets/68638924/5164a420-b62a-412f-8762-092e8c41eacd)

#### Database interaction. PDO
Interaction with the website database was implemented using PDO (PHP Database Objects). PDO is a database access layer in PHP that provides a consistent query writing style even when working with different relational databases. This improves the website's ability to scale. PDO also provides protection against SQL injections. Services, information about the clinic, information about specialists, and reviews are loaded from the database.

#### Registration confirmation code
To implement sending emails with a verification code when registering on the site, the PHPMailer library was used. Gmail was chosen as the mail server (i.e., the server responsible for sending emails) because it is free and easy to install - you just need to generate a password to access the mail server attached to your Google account. The confirmation code is generated from decimal digits and Latin letters: lowercase and uppercase. The code is saved in the PHP session. Code length – 4 characters.

#### Bread crumbs
There is a piece of code in the site header that allows you to show only the name of the site if an array with breadcrumbs and links to the corresponding pages was not passed, and show breadcrumbs otherwise.

#### Using sessions
To temporarily save data of an authorized user when navigating through the pages of the site, PHP sessions were used. By default, the session lifetime is 24 minutes. The values ​​recorded in sessions are stored on the server, so the user does not have access to them until this access is provided by the developer.

#### Password encryption. Protection against SQL injections in practice. Basic user authorization code
To ensure the security of user accounts, a “one-way” encryption system was used for passwords using the PHP function password_hash(), the first argument of which is the password that needs to be encrypted, and the second argument is the PASSWORD_DEFAULT constant, allowing the use of modern encryption algorithms. When a user is authorized, the encrypted password entered at login is compared with the “hash” of the password entered during registration, and if they match with the login entered correctly, the account is logged in. To verify passwords, the PHP function password_verify() is used. Thus, if the database is hacked, passwords will not be available to fraudsters.
