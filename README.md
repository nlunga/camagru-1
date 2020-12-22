# Camagru

WeThinkCode\_ Module  
Web - Project 1  
A little more complex Web Application

Camagru is a social media web application that allows users to upload or take pictures using their webcam, apply stickers and share these pictures with other users. Users can view others' posts and then like and comment on them. In essence it is similar to the popular photo sharing website, [Instagram](https://www.instagram.com/).

## Objective

Create a Web Application with elements similar to Instagram / Snapchat. Users should be able to capture a photos using the webcam or upload photos in the absence of a webcam. They should be able to select an image in a list of superposable images (for instance a picture frame, or other “we-don’t-wanna-know-what-you-are-using-this-for” objects), take a picture with their webcam and admire the result that should be merging both pictures.  
All captured images should be public, likeable and comment-able.

Allowed languages:

- PHP (Server-side)
- HTML
- CSS
- JavaScript

No frameworks allowed with the exception of CSS frameworks that does not user any forbidden JavaScript

## Features

### User Features

- The application should allow a user to sign up by asking at least a valid email address, a username and a password with at least a minimum level of complexity.
- At the end of the registration process, the user should confirm their account via a unique link sent to the email address fulfilled in the registration form.
- The user should then be able to connect to the application, using their username and password. They also should be able to tell the application to send a password re-initialization mail, if they forget their password.
- The user should be able to disconnect in one click at any time on any page.
- Once connected, the user should be able to modify their username, email address or password.

### Gallery Features

- This part is to be public and must display all the images edited by all users, ordered by date of creation. It should also allow (only) a connected user to like them and/or comment them.
- When an image receives a new comment, the author of the image should be notified via email. This preference must be set as true by default but can be deactivated in the user’s preferences.
- The list of images must be paginated, with at least 5 elements per page.

### Editing Features

Editing / uploading should be accessible only to users that are authenticated/connected and reject all other users that attempt to access it without being successfully logged in.

This page should contain 2 sections:

- A main section containing the preview of the user’s webcam, the list of superposable images and a button allowing to capture a picture.
- A section displaying thumbnails of all previous pictures taken.

Superposable images must be selectable and the button allowing to take the picture should be inactive (not clickable) as long as no superposable image has been selected.

- The creation of the final image (so among others the superposing of the two images) must be done on the server side, in PHP.
- Because not everyone has a webcam, you should allow the upload of a user image instead of capturing one with the webcam.
- The user should be able to delete his edited images, but only his, not other users’ creations.


## Requirements

- A MySQL instance, eg. [Xampp](https://www.apachefriends.org/download.html) or [Mamp](https://bitnami.com/stacks/infrastructure)
- PHP (pre-installed with Xampp or Mamp)
- HTML
- CSS
- JavaScript
- For editing ONLY: a text editor, eg. [VS Code](https://code.visualstudio.com/)

## Constraints & Mandatory

The project should contain imperatively:

- A index.php file, containing the entering point of the site and located at the root of the file hierarchy.
- A config/setup.php file, capable of creating or re-creating the database schema, by using the info contained in the file config/database.php.
- A config/database.php file, containing the database configuration, that will be instanced via PDO in the following format:

`DSN` (Data Source Name) contains required information needed to connect to the database, for instance `mysql:dbname=testdb;host=127.0.0.1`. Generally, a DSN is composed of the PDO driver name, followed by a specific syntax for that driver. For more details take a look at the PDO doc of each driver1.

## Installation

A server is required to host the web app. Xampp or mamp can be used.
A Xampp installation guide: https://www.youtube.com/watch?v=xdvVKywGlc0&t=607s.  

During the installation process the following credentials should be set:

```
username: root
password: root42
```

If other credentials are used, these fields will need to be edited in the `config/database.php` file.  
Once a localhost server is installed, navigate to the `htdocs` directory.
Clone (or download & unzip) the camagru repo into `htdocs`

```
cd xampp/htdocs/
git clone https://github.com/veronar/camagru.git
```

Open the xampp control panel; start both the Apache & MySql servers.
Open a web browser (Chrome or Brave or Firefox or Safari, etc).
In the address bar type in `localhost` and press enter. This will open up the server landing page. This confirms that the server is installed and active. Click on the link to phpmyadmin and ensure credentials are correct.

Navigate to `localhost:8080/camagru/camagru/config/setup.php` in the web browser.
If successful the database will be setup and the page will echo `done`. If not, the incorrect database details have been used and this will need to be changed in `config/database.php`.

The web app is not ready to use. Ensure your `php.ini` is setup to send mail.
register, browse, snap, enjoy!

### SendMail troubleshooting
For hosting on Windows, the sendmail function needs to be configured.
Follow this [guide](https://meetanshi.com/blog/send-mail-from-localhost-xampp-using-gmail) to implement successfully.

## Architecture

This application is a typical implementation of the MVC and OOP design patterns. Built in fundamentally PHP, an entire framework is built from scratch, through following a [tutorial](https://www.youtube.com/watch?v=rkaLJrYnpOM&list=PLFPkAJFH7I0keB1qpWk5qVVUYdNLTEUs3) by Curtis Parham.

Model, views & controllers can be found in the `app` directory.
Responsibilities:  
- Model components correspond to all the data-related logic that the user works with. This can represent either the data that is being transferred between the View and Controller components or any other business logic-related data.
- View components are used for all the UI logic of the application. For example, the Customer view will include all the UI components such as text boxes, dropdowns, etc. that the final user interacts with.
- Controllers act as an interface between Model and View components to process all the business logic and incoming requests, manipulate data using the Model component and interact with the Views to render the final output.
- Core files are high level classes or functions that form an integral part of the app. These control things like how the root application runs, input processing, validation rules, handle routes, handle sessions, etc.
- Config is a simple where all configuration files are stored in order to setup / run the application for the first time & connect to the database.
- CSS contains all preset and custom styling of the UI layer / interface
- Imgs contain both posted / uploaded pictures as well as images integrated in the UI / UX.
- Js contains all javascript files used for ajax requests, camera handling and some styling.
- Docs contains all marking / instrument documentation required to produce this project

## Testing
WeThinkCode_'s marking sheet can be found [here](https://github.com/veronar/camagru/blob/master/docs/markingsheet_camagru.pdf)

Tests that are executed:
1. Preliminary checks, used PHP, no external frameworks (aside from css), config files in the correct location. Used PDOs
2. Webserver starts
3. Create an account
4. Log in
5. Capture a picture with the webcam
6. Add sticker
7. Visit gallery
8. Change user credentials
9. Upload a picture

Expected outcomes:
1. Backend code written in PHP
2. No frameworks used (aside from css)
3. `database.php` + `setup.php` in the config folder
4. Used PDOs
5. Web server starts on localhost
6. Able to register
7. Able to log in
8. Able to capture photos
9. Able to visit gallery
10. Able to change credentials

## Shout-out

Thanks to superhuman [@FWMoor](https://github.com/FWMoor) for help with infinite pagination, stickers, and always being available to answer my questions.
