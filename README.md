WHMCS TLD Manager
This PHP script is designed to help manage Top-Level Domains (TLDs) in a WHMCS database. It provides a simple and user-friendly interface for listing and deleting TLDs.

How It Works
Database Connection:
The script connects to the WHMCS database using PDO with secure credentials.

Fetching TLDs:
It fetches the list of all TLDs stored in the tbldomainpricing table.

Interactive UI:

Displays TLDs in a scrollable list.
Provides checkboxes for users to select TLDs.
Includes a "Select All" button for convenience.
Deletion of Selected TLDs:

When the user submits the form, the selected TLDs are deleted from the database.
Success and error messages are displayed to provide feedback.
Responsive Design:

Clean and modern interface with buttons styled for better UX.
Fully responsive layout.
How to Use
Configure database credentials in the PHP script:
php
Copy code
$dbHost = 'localhost';
$dbName = 'whmcs_database';
$dbUser = 'db_user';
$dbPass = 'db_password';
Upload the script to your web server.
Open the script in your web browser.
Use the checkboxes to select TLDs and click "Delete Selected TLDs."
Features
Secure database interaction using PDO.
Intuitive UI for managing TLDs.
Single-click option to select all TLDs.
Minimalistic and responsive design.
Let me know if you need additional enhancements or explanations!
