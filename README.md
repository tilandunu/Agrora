# Agrora - Online Grocery Store

Agrora is an online marketplace connecting users with a wide range of agricultural products. The platform allows users to browse and purchase products, while administrators can manage products, stock, and user accounts.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** SQL (using `agrora.sql` for database structure/initial data)
- **Other:** Font Awesome (for icons)

## Installation Instructions

1.  **Clone the repository:**

```
bash
    git clone <repository_url>

```

2.  **Set up a web server:** Ensure you have a web server environment set up (e.g., Apache, Nginx) with PHP support.
3.  **Set up the database:**
    - Create a new database in your database management system (e.g., MySQL).
    - Import the `agrora.sql` file into your newly created database. This will set up the necessary tables and potentially populate some initial data.
4.  **Configure database connection:** Update the PHP files in the `WEBSITE/php/` directory (specifically those interacting with the database) with your database credentials (database name, username, password, host).
5.  **Place project files on the web server:** Move the contents of the `WEBSITE` directory to your web server's document root or a designated project folder.
