# PHP Payment Gateway
This is a simple payment gateway written in PHP that allow you to run your own Paypal or Apple Pay. The source code are written in OOP style.

**Help wanted: Feel free to open a pull request or report issues here, I am a bit busy right now but I will happy to help when I am available**

We are in version 0.1.3 (Alpha Release).

Deposit, credit card processing feature is not developing right now. 

## Features
- Open source and continue to be updated.
- Simple to understand and work with.
- Perfect for who are beginner in PHP developement.
- OOP Styles.
- PHP7 Supported.
- MySQL PDO.
- Secure from XSS attacks, MySQL injections,...
- Design based on Bootstrap.


## Todo
- Format the code, add some comment.
- Change language of the source code from Vietnamese to English.
- Implent 1Checkout or similar one to handle credit card processing.
- Fix some bugs and improve the performance.
- Improve the source code to maintain it more easy.

## How to install
- Clone or download this repo and extract to your web directory.
- Create a new database (recommended) or use existing one.
- Import the banking.sql file into your database, this will create 2 tables: "activities" and "tbl_users".
- Edit the dbconfig.php file in config directory and fill in with your database infomation and your website path. 
- You are ready to go.
