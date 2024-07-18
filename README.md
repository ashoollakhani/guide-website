# Guide Website 📚

## Features 🌟

- Responsive design using Bootstrap 5.
- Slideshow of the latest guides.
- Dynamic content loading from a MySQL database.

## Setup Instructions 🛠️

1. **Database Configuration**
   - Update `config.php` with your database credentials.
   - Ensure MySQL server is running locally (`localhost`).

2. **Import Database**
   - Use the provided `guide2.sql` to initialize your database schema.

3. **Web Server Setup**
   - Place files in your web server's root directory (`htdocs` for XAMPP).

4. **Launch**
   - Open the project in your web browser.

## PHP Scripts Overview 🖥️

### `index.php`

- Initializes the PHP session.
- Establishes a database connection to `guide2`.

### Slideshow Functionality

- Fetches the latest guides from the database.
- Displays guides with their titles, details, and links.

### JavaScript Functionality

- Uses jQuery and Cycle2 for slideshow functionality.
- Opens Google Maps with guide coordinates.

## Troubleshooting 🛠️

- **Database Connection Issues**
  - Check database credentials in `config.php`.
  - Ensure PHP can connect to MySQL (`mysqli` extension enabled).

## Credits 🙌

- Developed by Ashool Lakhani
