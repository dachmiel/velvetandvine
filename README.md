# Velvet & Vine
PHP MVC Web Application to simulate a clothing website named "Velvet & Vine".

Created as part of a deliverable for the CSE389 class at Syracuse University.


How to Install and Run Velvet & Vine for MAC USERS: 

1. Download XAMPP here: https://www.apachefriends.org/
2. Place in /Applications folder, and install on machine
3. Go to Applications>XAMPP>htdocs
4. Right click htdocs folder > New Terminal at Folder
5. In the command line, clone this repository (git clone https://github.com/dachmiel/velvetandvine.git)
6. Back to our Applications folder: click on and run manager-osx.app (You will need to change permissions on your machine to allow it to run)
7. Go to "Manage Servers" > Start MySQL Database and the Apache Web Server
8. Run "http://localhost/dashboard/" in your browser. If the XAMPP has been successfully installed, you will see a XAMPP/Apache dashboard page.
9. Navigate to the tab "phpMyAdmin"
10. On the leftmost side, add a new database file. Download and upload to the server the sql file titled "Velvet_VineDB_DummyData" stored in the main branch.
11. Now in a new browser type: "http://localhost/velvetandvine/". Now you can access the website and its' functionalities.

Troubleshooting: 
- If the images on the website are not showing up:
    > Install Git Large File Storage
    > Using homebrew: brew install git-lfs
    > Using MacPorts: port install git-lfs
    > You can also download manually here: https://git-lfs.com/
- Initialize glfs:
    > git lfs install
