# BudgetMate

BudgetMate is a web application that helps users manage their finances effectively. It provides functionalities for managing accounts, transactions, and visualizing financial data.

## Features

- **Login & Sign Up:** Users can create accounts and log in securely.
- **Account Management:** Supports two types of accounts - bank and cash.
- **Transaction Handling:** Enables separate transactions for bank and cash accounts, including transfers between them.
- **Graphical Representation:** Visualizes total and separate account balances using graphs.
- **History Logs:** Keeps track of transaction history.
- **Password Change & Data Management:** Allows users to change passwords, delete data, and delete accounts.
- **Responsive Design:** Built with Bootstrap, ensuring a highly responsive frontend. The frontend of BudgetMate utilizes vector illustrations to enhance visual elements. These illustrations are stored in the /img directory.

## Future Additions (Roadmap)

- Customizable Logo Integration
- Font Improvements
- User Interactive Message
- Custom Error (404) Page
- Transfer Account Options Auto Interchange
- Calendar Feature for Selecting Transaction Dates (currently using current_timestamp)
- Description-Wise Spending Distribution
- Enabling Comprehensive Transaction Editing and Subsequent Transaction Update
- Transaction Records PDF Download Option

## Backend

User Table
![](img/User%20Table.png)
Log Table
![](img/Log%20Table.png)

## Setup Instructions

1. **Database Configuration:** Update the `db_config.php` file with the server's database credentials to establish a connection between the application and the database.

   ```php
   <?php
   $host = "localhost";
   $user = "root";
   $password = '';
   $db_name = "budgetmate";
   ```

2. **Web Hosting:** Deploy the PHP backend and Bootstrap frontend on a web server.

3. **Accessing the Application:**
   Access your server's database using tools like phpMyAdmin.
   Create a new database named "budgetmate" and import the SQL schema provided in description.

## Technologies Used

- **Frontend:** Built with Bootstrap for a responsive and mobile-first design.
- **Backend:** Powered by PHP for server-side scripting and database interactions.
- Even though server-side validation performed there in PHP, JavaScript validation is beneficial for improving the user experience by preventing unnecessary form submissions and providing instant feedback to users without requiring a round trip to the server.

## Accessing the Application

You can access the BudgetMate application by visiting [Deployed Website](http://budgetmate.000.pe).

## Contributing Fixes

If you encounter any issues, bugs, or unexpected behavior while using BudgetMate, we encourage you to report them.
If you're able to fix the bug yourself, feel free to fork the repository, make the necessary changes, and submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).
