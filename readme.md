
<h1>Getting Started With TaskManager</h1>
TaskManager is a open source tool that allows individuals to manage their internal and external tasks. 

<h2>How to Install TaskManager </h2>
TaskManager is built on top of a PHP Framework called LARAVEL.

<h3>Installation Requirements</h3>
To install and run Article Hub on your server or local environment. You will need set up the following on your Operating System of choice:

1. LAMP (LINUX) OR WAMP (WINDOWS) DEVELOPMENT ENVIRONMENT  (GOOGLE FOR MORE INFO)
2. NODE JS 
3. COMPOSER

<h3>Installation Steps</h3>

<h4>1- Clone or download the repository</h4>


<h4>2- Install the project dependencies from composer</h4>
Each time you clone a new Laravel project, you have to install all the dependencies of the project. This is what allows you to install Laravel itself, among other packages needed to start your application.
When we run composer, it checks the composer.json file that is in your repo and lists all the composer packages your repo needs. As these packages are constantly changing, the source code is usually not submitted to git, thanks to the .gitignore that should always contain your vendor directory.
So to install all the necessary source code, we run composer with the following command.

<br><code>composer install</code>

<h4>3- Install NPM dependencies (optional)</h4>
This is exactly like the previous step with the only difference that it will allow you to install Vue.js, Bootstrap.css, Lodash and Laravel Mix etc…
In short, instead of installing PHP code as in the previous step, it’s a matter of installing the required Javascript (or Node) packages.
The list of packages needed in this case are listed in the ‘packages.json’ file.
If your project doesn’t use vue.js, node or other you can skip this step, otherwise you have to do :

<br><code>npm install</code>

<h4>4- Create a copy of your .env file</h4>
The .env files are generally not submitted to your repo, if this is not the case I invite you to correct this for security reasons.
But there is an example .env file, which is a template of the .env file that every laravel project needs to start.
So we will make a copy of the .env.example file and create an .env file that we can fill in with our configuration settings.

<br><code>cp .env.example .env</code>

<h4>5- Generate your encryption key</h4>
Laravel requires that you have an encryption key for each of your applications, this is usually randomly generated and stored in your .env file. The application will use this encryption key to encrypt various elements of your application, such as cookies, password hashes and many other elements.
Fortunately Laravel’s command line tools allows you to generate this key very easily. In the terminal, we can execute this command to generate this key.
<br>
<code>php artisan key:generate</code>

<h4>6- Create an empty database for your project</h4>
Create an empty database for your project using any database tools you prefer (My favorite is Datagrip for Mac, but sometimes I use DBForge, or Mysql Workbench or even good old Phpmyadmin).

<h4>7- Configure your .env file to allow a connection to the database</h4>
We will want to allow Laravel to connect to the database you just created in the previous step. To do this we need to add the connection references in the .env file and Laravel will take care of the connection from there.
In the .env file, fill in the options DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME and DB_PASSWORD so that they match the credentials of the database you have just created.


<h4>8- Add the tables and contents of your database with migrations or in SQL</h4>
Migrations in Laravel allow you to have all your DB architecture in your code and with a simple command line you can recreate all your tables.
<br>
<code>php artisan migrate</code>

<h4>Conclusion</h4>
That’s all you need to start the project. Of course, some projects have specific steps that apply only to that project, but the steps I’ve described above are the necessary steps you’ll need to follow to start any standard Laravel project from a git clone.
It’s essentially the same thing on windows, unless you don’t have a batch terminal. This would be surprising because if you install git on a windows server or machine, then right-click in your folder, you should get the ‘git bash here’ option and you’re done.

