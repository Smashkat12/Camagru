# Camagru

## WTC\_

Camagru is a minimal instagram like web application that enables users to share their edited photos with other users.

## Getting Started

### Key Concepts

<ol>
  <li>Basic web development skills</li>
  <li>Algorithmic skills using PHP scripting language</li>
  <li>Real-time communication using websockets</li>
  <li>Database structure and management systems</li>
  <li>Data validation</li>
  <li>UX / UI Design </li>
</ol>

### Application Stack

<ol>
    <li>HTML</li>
    <li>CSS</li>
    <li>JavaScript(AJAX)</li>
    <li>XAMPP</li>
    <li>MySQL</li>
    <li>Apache</li>
</ol>

### Features

<ul>
    <li>Account Registration</li>
    <li>User Profile</li>
    <li>Manage Profile (Edit Profile)</li>
    <li>Photo Upload</li>
    <li>User input validations</li>
    <li>Email Notifications(Account Registration, Password Reset)</li>
    <li>User Comments</li>
	<li>User Likes</li>
</ul>

## Folder Structure

<ul>
  <li>camera
    <ul>
      <li>Uploads Folder - temp upload</li>
      <li>Camera Logic files</li>
    </ul>
  </li>
  <li>config
    <ul>
      <li>database.php - Database Configuration</li>
      <li>setup.php - database setup script</li>
    </ul>
  </li>
  <li>controller
    <ul>
      <li>account.countroller.php - user account controller</li>
      <li>core.controller.php - main application controller</li>
    </ul>
  </li>
  <li>includes
    <ul>
      <li>header.php - app header file</li>
      <li>mail.php - email token generator</li>
    </ul>
  </li>
  <li>models
    <ul>
      <li>account.model.php - database functions</li>
      <li>mail.php - email token generator</li>
    </ul>
  </li>
  <li>uploads
    <ul>
      <li>uploaded images</li>
    </ul>
  </li>
  <li>view
    <ul>
      <li>account.view.php - view for account page</li>
	  <li>core.view.php - view for the rest of the app</li>
    </ul>
  </li>
  <li>Root application files
  </li>
</ul>

## Install

<ul>
  <li>Install XAMPP or MAMP</li>
  <li>Clone the project to your local machine inside htdoc folder in your XAMPP or MAMP directory</li>
  <li>Go to config/database.php and change username and password to your own database credentials</li>
  <li>Start server/database</li>
  <li>visit http://localhost/camagru/config/setup.php on browser to run script to setup database</li>
  <li>visit http://localhost/camagru/ to access app</li>
</ul>

## Authors

<ul>
  <li>K. Morulane <a href="https://github.com/Smashkat12">Github Profile</a></li>
</ul>
