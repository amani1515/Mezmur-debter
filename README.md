# ደቂቀ ብርሀን (Dekike Brhan) - Ethiopian Orthodox Poem Management System

<p align="center">
  <img src="public/images/logos/dekikelogo.png" alt="Dekike Brhan Logo" width="120" height="120">
</p>

<p align="center">
  <strong>A sacred digital sanctuary for preserving Ethiopian Orthodox spiritual poetry</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red.svg" alt="Laravel">
  <img src="https://img.shields.io/badge/Vue.js-3.x-green.svg" alt="Vue.js">
  <img src="https://img.shields.io/badge/Inertia.js-1.x-purple.svg" alt="Inertia.js">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-blue.svg" alt="TailwindCSS">
</p>

## 📖 About

**Dekike Brhan** (Children of Light) is a comprehensive web application designed to preserve and manage Ethiopian Orthodox spiritual poetry. The platform serves as a bridge between generations, connecting the timeless wisdom of our ancestors with the hearts of today's faithful.

### 🎯 Purpose
- **Preserve** centuries-old Ethiopian Orthodox poems and hymns
- **Share** spiritual heritage through digital accessibility
- **Connect** communities through sacred poetry
- **Prepare** for future Android app development

## ✨ Features

### 🏠 Public Features
- **Beautiful Welcome Page** with background imagery and logo integration
- **Poem Submission** without registration required
- **Structured Verse System** with main verses and sub-verses
- **Duplicate Prevention** with real-time title checking
- **Mobile-First Design** optimized for 90% mobile users

### 🔐 Admin Dashboard
- **Golden Theme** with Ethiopian Orthodox aesthetics
- **User Management** with role-based access control
- **Category Management** with CRUD operations
- **Subcategory Management** with search and filtering
- **Poem Management** with approval workflow
- **Mobile-Responsive** design with collapsible sidebar

### 📱 Advanced Functionality
- **Search & Filter** across all management pages
- **Pagination** for optimal performance
- **Approval System** for quality control
- **Structured Data** storage for Android app compatibility
- **Real-time Validation** and feedback

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Vue.js 3.x with Composition API
- **Bridge**: Inertia.js for SPA experience
- **Styling**: TailwindCSS with custom golden theme
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **Notifications**: SweetAlert2

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- Node.js 16+ and npm
- MySQL 8.0+ or PostgreSQL 13+
- Web server (Apache/Nginx)

## 🚀 Installation

### 1. Clone Repository
```bash
git clone https://github.com/yourusername/poem-uploader.git
cd poem-uploader
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=poem_uploader
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration
```bash
# Run migrations
php artisan migrate

# Seed default data (optional)
php artisan db:seed
```

### 6. Build Assets
```bash
# Development build
npm run dev

# Production build
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 📁 Project Structure

```
poem-uploader/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php      # Admin dashboard logic
│   │   ├── PoemController.php       # Poem management
│   │   └── PublicController.php     # Public poem submission
│   └── Models/
│       ├── Category.php             # Category model
│       ├── Subcategory.php          # Subcategory model
│       └── Poem.php                 # Poem model with structured data
├── database/migrations/             # Database schema
├── resources/
│   ├── js/
│   │   ├── Layouts/
│   │   │   └── AdminLayout.vue      # Admin layout with golden theme
│   │   └── Pages/
│   │       ├── Admin/               # Admin dashboard pages
│   │       └── Welcome.vue          # Public welcome page
│   └── css/
└── public/images/                   # Logo and background images
```

## 🎨 Design Philosophy

### Golden Theme
The application uses a consistent golden/amber color scheme throughout, reflecting the sacred and traditional nature of Ethiopian Orthodox spirituality.

### Mobile-First Approach
With 90% mobile users in mind, the interface prioritizes:
- **Card layouts** for mobile devices
- **Responsive tables** for desktop
- **Touch-friendly** controls and navigation
- **Collapsible sidebar** for space efficiency

## 📊 Database Schema

### Categories
- `id`, `name`, `created_at`, `updated_at`

### Subcategories
- `id`, `category_id`, `name`, `created_at`, `updated_at`

### Poems
- `id`, `title`, `author`, `registered_by`, `subcategory_id`
- `structure` (JSON) - Hierarchical verse data
- `status` (pending/approved)
- `created_at`, `updated_at`

## 🔧 Configuration

### Default User Role
New registrations default to admin role for initial setup:
```php
// In User model
protected $attributes = [
    'role' => 'admin',
];
```

### Pagination Settings
- **Subcategories**: 10 per page
- **Poems**: Configurable in controller

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure web server (Apache/Nginx)
3. Set proper file permissions
4. Enable HTTPS
5. Configure database for production
6. Run `npm run build` for optimized assets

### Recommended Server Configuration
- **PHP**: 8.1+ with required extensions
- **Memory**: 512MB minimum
- **Storage**: SSD recommended
- **SSL**: Required for production

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Ethiopian Orthodox Church** for spiritual inspiration
- **Laravel Community** for excellent framework
- **Vue.js Team** for reactive frontend capabilities
- **Contributors** who help preserve our spiritual heritage

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Join our community discussions

---

<p align="center">
  <strong>Built with ❤️ for the Ethiopian Orthodox community</strong><br>
  <em>Preserving spiritual heritage through technology</em>
</p>