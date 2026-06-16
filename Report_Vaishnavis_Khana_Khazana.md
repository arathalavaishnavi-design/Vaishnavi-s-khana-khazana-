# Web Application Development – Project Report

**Font: Times New Roman | Size: 12 | Line Spacing: 1.5**

---

## 1. Student Details

| Field | Details |
|-------|---------|
| **Name** | Vaishnavi Arathala |
| **Register Number** | _(Fill your register number)_ |
| **Department** | Computer Science & Engineering |
| **Date of Submission** | 15 June 2026 |

---

## 2. Project Overview

**Vaishnavi's Khana Khazana** is an online food delivery web application built using PHP, MySQL, HTML, CSS, and JavaScript. The application belongs to the **food/restaurant domain** and allows users to browse a curated menu of 8 dishes, search for items, add them to a cart, and place delivery orders. Key features include user registration and login with session management, a dynamic cart system using AJAX, an order history page with admin-level summary statistics, and a responsive modern UI.

---

## 3. Database Design

**Database Name:** `food_delivery_db`

### Table: `users`

| Column Name | Data Type | Description |
|-------------|-----------|-------------|
| id | INT (Primary Key, Auto Increment) | Unique user identifier |
| username | VARCHAR | User's chosen username |
| phone | VARCHAR | 10-digit phone number |
| email | VARCHAR | User's email address |
| address | TEXT | Delivery address |
| password | VARCHAR | User's password |

**Purpose:** Stores registered user information for authentication and delivery details.

### Table: `orders`

| Column Name | Data Type | Description |
|-------------|-----------|-------------|
| id | INT (Primary Key, Auto Increment) | Unique order identifier |
| username | VARCHAR | Username of the customer who placed the order |
| total_amount | DECIMAL | Grand total amount of the order |
| order_date | DATETIME | Timestamp when the order was placed |

**Purpose:** Stores each confirmed order with the customer name, total bill, and date.

### Table: `order_items`

| Column Name | Data Type | Description |
|-------------|-----------|-------------|
| id | INT (Primary Key, Auto Increment) | Unique item entry identifier |
| order_id | INT (Foreign Key → orders.id) | Links item to its parent order |
| item_name | VARCHAR | Name of the food item ordered |
| price | DECIMAL | Price per unit of the item |
| qty | INT | Quantity ordered |
| subtotal | DECIMAL | price × qty |

**Purpose:** Stores individual line items for each order, enabling detailed order breakdowns.

---

## 4. Project Folder Structure

| File/Folder | Role |
|-------------|------|
| `kitchen1.php` | Main homepage — displays the restaurant menu, hero section, search bar, and navigation with session-aware links. |
| `login.php` | User login page — authenticates credentials against the database and starts a session. |
| `sign1.php` | User registration page — collects username, phone, email, address, and password, and inserts into the `users` table. |
| `cart.php` | Shopping cart page — displays cart items, calculates totals, handles checkout, and saves orders to the database. |
| `add_to_cart.php` | AJAX backend endpoint — receives item data via JSON POST and stores it in the PHP session cart array. |
| `orders.php` | Order history/admin page — displays all past orders with item details, total revenue, and customer stats. |
| `logout.php` | Logout handler — destroys the user session and redirects to the homepage. |
| `db_connect.php` | Database connection file — establishes a MySQLi connection to the `food_delivery_db` database. |
| `style1.css` | Main stylesheet — contains all CSS for the navbar, hero section, food cards grid, search box, and responsive design. |

---

## 5. Application Flow

When a user opens the browser and navigates to `kitchen1.php`, the server-side PHP script checks the session status and renders the homepage with the menu. When the user clicks "Add +" on a food item, a **client-side JavaScript function** uses the **Fetch API (AJAX)** to send a JSON POST request to `add_to_cart.php`. The server-side PHP script reads the JSON payload, updates the `$_SESSION['cart']` array, and returns a JSON success response to the browser. On checkout, `cart.php` inserts the order into the `orders` and `order_items` tables in the **MySQL database**, clears the session cart, and redirects the user with a confirmation message displayed in the browser.

---

## 6. Features Implemented

### 6.1 User Registration
Users can create an account by providing their username, phone number, email, password, and delivery address. The system checks for duplicate usernames/emails before inserting the new record into the `users` table.

### 6.2 User Login & Authentication
Registered users can log in with their username and password. On successful authentication, a PHP session is started and the user is redirected to the menu page.

### 6.3 Session Management & Protected Pages
The application uses PHP sessions (`$_SESSION`) to track logged-in users. The cart functionality is protected — only authenticated users can add items. The navbar dynamically shows "Welcome, username!" with Logout and View Cart links for logged-in users, and Login/Sign In links for guests.

### 6.4 Dynamic Menu Display
The homepage displays 8 food items in a responsive CSS grid layout, each with an image, description, price, and an "Add +" button that triggers the AJAX cart function.

### 6.5 Product Search (Live Filter)
A search bar in the hero section allows users to type a dish name and instantly filter the visible menu cards using a client-side JavaScript `filterMenu()` function that matches against `data-name` attributes.

### 6.6 Add to Cart (AJAX)
Clicking "Add +" sends item data (id, name, price) to `add_to_cart.php` via the Fetch API without reloading the page. Items are stored in the session with quantity tracking — adding the same item increments its quantity.

### 6.7 Cart Page & Checkout
The cart page displays all selected items in a table with item name, unit price, quantity, and row total. A grand total is calculated. Clicking "Confirm Delivery Order" saves the order to the database and clears the cart.

### 6.8 Order History (Admin View)
The `orders.php` page shows summary statistics (total orders, total revenue, unique customers) and a detailed card-based view of every past order with its line items, timestamps, and totals.

### 6.9 Logout
A logout link destroys the session and redirects the user back to the homepage.

---

## 7. Future Enhancements

1. **Payment Gateway Integration** — Integrate Razorpay or Stripe to accept online payments securely during checkout.
2. **Order Tracking & Status Updates** — Add real-time order status (Preparing → Out for Delivery → Delivered) with notifications to the user.
3. **User Profile & Order History per User** — Allow logged-in users to view their own past orders, update their address, and manage their profile from a dedicated dashboard.

---

## 8. Sample Screenshots

*(Insert 2–3 screenshots of the following pages at small size:)*

1. **Homepage with Menu** — Screenshot of `kitchen1.php` showing the hero banner, search bar, and food card grid.
2. **Cart Page** — Screenshot of `cart.php` showing items added with quantities and the grand total.
3. **Order History Page** — Screenshot of `orders.php` showing order cards with summary statistics.

*(Capture these from your browser at http://localhost/foodapp/ and paste here)*

---

## 9. Learning Outcomes

Through this assignment, I learned how to build a full-stack web application using PHP and MySQL with XAMPP as the local development environment. I gained hands-on experience with session management for user authentication, AJAX (Fetch API) for asynchronous client-server communication without page reloads, and relational database design with foreign key relationships. I also understood the complete request-response lifecycle — from the browser through JavaScript, to PHP server scripts, to MySQL queries, and back — which strengthened my understanding of how modern web applications function end-to-end.

---
