# BlogHub - Laravel Blog Management System

BlogHub is a fully-featured, production-ready Blog Management System built with **Laravel** and **Bootstrap 5**. It provides a beautiful frontend for users to read, search, and filter articles, alongside a secure and powerful admin panel for content management.

## 🌟 Key Features

### Frontend (Public)
*   **Modern UI/UX**: Clean, responsive, and dynamic user interface built with Bootstrap 5 and custom CSS.
*   **Smart Filtering**: Real-time AJAX search, category filtering, and date-range sorting.
*   **Rich Reading Experience**: Fully formatted articles with a built-in **Fullscreen Image Lightbox** feature.
*   **Social Sharing**: One-click sharing to Twitter (X), Facebook, WhatsApp, and copy-link functionality.
*   **SEO Optimized**: Auto-generated slugs, meta descriptions, and semantic HTML structure.

### Admin Panel (Backend)
*   **Secure Dashboard**: Protected admin routes with stats overview (total blogs, categories, etc.).
*   **Advanced Rich Text Editor**: Integrated **TinyMCE** editor supporting text coloring, alignment, tables, and **direct image paste/upload** (Base64 automated processing).
*   **One-Click Actions**: Easily create, edit, or delete blogs and categories directly from the dashboard.
*   **Featured Image Management**: Drag-and-drop cover image uploads with live preview.
*   **Automated Formatting**: Dynamic table styling and image resizing rules ensure content never breaks the layout.

## 🛠️ Technology Stack
*   **Backend**: Laravel (PHP)
*   **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5.3
*   **Database**: MySQL (Default configuration)
*   **Icons**: Bootstrap Icons
*   **Rich Text Editor**: TinyMCE v6 (via cdnjs)

---

## 🚀 Installation & Setup

Follow these steps to get the project running locally.

### Prerequisites
*   PHP >= 8.1
*   Composer
*   MySQL Server

### 1. Clone the Repository
```bash
git clone <your-repo-url>
cd blog-app
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration
Copy the `.env.example` file and create a new `.env` file:
```bash
cp .env.example .env
```

Open the `.env` file and set up your MySQL database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_app
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Database Setup & Seeding
Create a MySQL database named `blog_app`. Then, run the migrations and seeders to populate the database with default admin credentials, categories, and dummy blogs.
```bash
php artisan migrate:fresh --seed
```

### 6. Run the Application
Start the Laravel local development server:
```bash
php artisan serve
```
Visit `http://localhost:8000` in your browser.

---

## 🔐 Default Credentials
If you ran the seeder (`--seed`), you can access the admin panel at `http://localhost:8000/admin/login` using:

*   **Email**: `admin@admin.com` (Check `Database\Seeders\AdminSeeder` for exact seeded credentials)
*   **Password**: `password` (or `password123`)

*(Note: Please change your password immediately in a production environment).*

---

## 📝 License
This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).
