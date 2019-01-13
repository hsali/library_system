# Library System Assignment 

## problem detail

This is the short assignment to check your coding skills. Please take a look at the following requirements and try to write clean code in the given time. 



### Library System:
 
The system should be developed in CodeIgniter. It will have an admin panel and a client panel. 
 
#### Admin Panel:
Only the user with admin role can login to admin panel and can perform the following actions:
Manage the racks (rack name)
Manage the books and add them in their specific racks. (book title, author, published year)
Only 10 books can be added in a rack. An alert should prompt if admin is trying to add more books.
#### Client Panel:
Any registered user can login and perform following actions.
Racks
See the list of all racks and total books in them. Click on any rack to see the added book details
Books
Search the books with title, author name or published year.
 The result should show the book details along with the rack name
Note:


It normally takes 8 hours to complete this assignment but if it takes longer then you should mention time. The design layout should be presentable. Please don't use any javascript plugins for listing and searching. You need to submit all the code, database structure and configuration details if any.





## Usage

* create database library_system
* copy .env.example file as .env and setup credentials 
* run these commands 

      php artisian key:generate
      php artisian migrate --seed
    

* serve the command 

      php artisian serve

* open browser with link [http://localhost:8000](http://localhost:8000)
## credentials 
### admin user
 * user: admin@app.com
 * password: password
 
 
 ### client
 * user: client@app.com
 * password: password
 
  
