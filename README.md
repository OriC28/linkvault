# LinkVault

LinkVault is a modern bookmark and link management application. This is my first project built with Laravel, designed as a portfolio piece to showcase my web development skills. It allows users to securely store, organize, and manage their favorite web links in one place.

## Features

- User authentication with OAuth support.
- Save, organize, and manage web links effortlessly.
- Automatic favicon fetching for saved URLs.
- Advanced tagging system for easy link categorization.
- Clean and responsive user interface.
- URL slug generation for structured routing.
- Real-time toast notifications for user feedback.

## Tech Stack

**Backend:**
- PHP 8.3
- Laravel 13
- Laravel Socialite (OAuth Authentication)
- Spatie Laravel Sluggable (URL slug generation)
- AshAllenDesign Favicon Fetcher (Automated icon retrieval)

**Frontend:**
- Tailwind CSS 4 (Styling)
- Alpine.js 3 (Reactivity)
- Tagify (Tag input component)
- Simple-notify (Toast notifications)
- Vite (Asset bundler)

## Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

- PHP >= 8.3
- Composer
- Node.js & npm

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/linkvault.git
   ```
2. Navigate into the project directory:
   ```bash
   cd linkvault
   ```
3. Install PHP dependencies:
   ```bash
   composer install
   ```
4. Install NPM packages:
   ```bash
   npm install
   ```
5. Copy the environment file:
   ```bash
   cp .env.example .env
   ```
6. Generate an application key:
   ```bash
   php artisan key:generate
   ```
7. Run database migrations:
   ```bash
   php artisan migrate
   ```
8. Compile frontend assets:
   ```bash
   npm run build
   ```
9. Start the development server:
   ```bash
   php artisan serve
   ```

### Google OAuth Configuration

To enable Google authentication locally via Laravel Socialite, you need to configure your Google Cloud Console credentials:

1. Create a project in the [Google Cloud Console](https://console.cloud.google.com/).
2. Set up the OAuth consent screen and create an **OAuth 2.0 Client ID**.
3. Add your local redirect URI (e.g., `http://localhost:8000/auth/google/callback`).
4. Update your `.env` file with the provided credentials:

   ```env
   GOOGLE_CLIENT_ID="your-google-client-id"
   GOOGLE_CLIENT_SECRET="your-google-client-secret"
   GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
   ```
