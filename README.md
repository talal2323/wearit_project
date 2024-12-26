# **WearIT**

## **Project Overview**
WearIT is a fully functional and responsive e-commerce platform designed for selling apparel. The platform allows users to browse clothing items, view detailed product information, and contact the store for inquiries. Admins can manage products and customer inquiries through a dynamic dashboard.

### **Features**
- User authentication and authorization
- Dynamic product listings powered by Laravel
- Product filtering and search functionality
- Fully responsive design
- Validated contact form
- Admin panel for product and inquiry management
- Secure and seamless user experience

---

## **Setup Instructions**

### **Prerequisites**
Ensure you have the following installed:
- PHP >= 8.1
- Composer
- MySQL
- Node.js and npm (for front-end asset compilation)
- Laravel >= 10.x

### **Installation Steps**
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/wearit.git
   cd wearit
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up the `.env` file:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update database credentials in the `.env` file:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=wearit_db
     DB_USERNAME=root
     DB_PASSWORD=yourpassword
     ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Run migrations to set up the database:
   ```bash
   php artisan migrate
   ```

6. Seed the database (optional):
   ```bash
   php artisan db:seed
   ```

7. Compile front-end assets:
   ```bash
   npm run dev
   ```

8. Start the development server:
   ```bash
   php artisan serve
   ```

9. Open the application in your browser:
   ```
   http://127.0.0.1:8000
   ```

---

## **Usage Guide**

### **For Users**
- **Browse Products**: View all available apparel items on the homepage.
- **Search and Filter**: Use the search bar and category filters to find specific products.
- **Product Details**: Click on any product to view detailed information.
- **Contact the Store**: Use the contact form to send inquiries.

### **For Admins**
1. **Login to Admin Panel**:
   - Access the admin panel at `/admin`.
2. **Manage Products**:
   - Add new products.
   - Edit or delete existing products.
3. **Manage Inquiries**:
   - View customer inquiries and respond accordingly.

---

## **Contribution Guidelines**
- Fork the repository.
- Create a new branch for your feature or bug fix.
- Commit your changes with clear and descriptive messages.
- Submit a pull request for review.

---

## **License**
This project is licensed under the MIT License.

---