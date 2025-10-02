# SimpleLicenseManager

A Laravel 11 REST API for managing software licenses for desktop applications.

## Features

✅ **Complete Laravel 11 Project** with Sanctum authentication  
✅ **License Management System** with full CRUD operations  
✅ **REST API Endpoints** for desktop app integration  
✅ **Bulk License Key Generation** with Artisan command  
✅ **Secure Authentication** with Laravel Sanctum  
✅ **Production-Ready Code** with proper validation and error handling  

## Quick Start

### 1. Installation

```bash
# Navigate to project directory
cd SimpleLicenseManager

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Generate sample license keys
php artisan license:generate 100
```

### 2. Configuration

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Simple_license_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Start Development Server

```bash
php artisan serve
```

The API will be available at `http://localhost:8000/api`

## API Endpoints

### Authentication
- `POST /api/register-user` - Register admin user
- `POST /api/login` - Login and get token
- `GET /api/me` - Get user info (requires auth)
- `POST /api/logout` - Logout (requires auth)

### License Management
- `POST /api/register` - Register license with user info
- `POST /api/activate` - Activate a license
- `GET /api/validate/{license_key}` - Validate license status
- `GET /api/licenses` - List all licenses (admin, requires auth)

## License Key Generation

Generate license keys in bulk using the Artisan command:

```bash
# Generate 100 license keys
php artisan license:generate 100

# Generate 1000 license keys
php artisan license:generate 1000
```

## Example Usage

### 1. Register a License

```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "license_key": "Simple-ABCD-EFGH-IJKL-MNOP",
    "first_name": "John",
    "last_name": "Doe",
    "brand_name": "Johns Restaurant",
    "phone": "+1234567890",
    "os": "Windows 11",
    "additional_data": {
      "restaurant_id": "REST001",
      "location": "New York"
    }
  }'
```

### 2. Activate License

```bash
curl -X POST http://localhost:8000/api/activate \
  -H "Content-Type: application/json" \
  -d '{"license_key": "Simple-ABCD-EFGH-IJKL-MNOP"}'
```

### 3. Validate License

```bash
curl -X GET http://localhost:8000/api/validate/Simple-ABCD-EFGH-IJKL-MNOP
```

## Database Schema

### Licenses Table
- `id` - Primary key (auto increment)
- `license_key` - Unique license key (string)
- `first_name` - User's first name (string)
- `last_name` - User's last name (string)
- `brand_name` - Business/brand name (string)
- `phone` - Contact phone number (string)
- `os` - Operating system (string)
- `additional_data` - JSON field for extra data (nullable)
- `status` - License status (enum: active, inactive, expired)
- `expires_at` - Expiration date (datetime, nullable)
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp

## Files Structure

```
SimpleLicenseManager/
├── app/
│   ├── Console/Commands/
│   │   └── GenerateLicenseKeys.php          # License key generator
│   ├── Http/Controllers/Api/
│   │   ├── AuthController.php              # Authentication endpoints
│   │   └── LicenseController.php           # License management endpoints
│   └── Models/
│       ├── License.php                     # License model
│       └── User.php                        # User model (with Sanctum)
├── database/migrations/
│   └── 2025_10_02_210917_create_licenses_table.php
├── routes/
│   └── api.php                             # API routes
├── API_DOCUMENTATION.md                    # Complete API documentation
├── SimpleLicenseManager.postman_collection.json  # Postman collection
├── test_api.php                            # PHP test script
└── README.md                               # This file
```

## Testing

### Using Postman
1. Import `SimpleLicenseManager.postman_collection.json` into Postman
2. Update the `base_url` variable to your API URL
3. Run the collection to test all endpoints

### Using PHP Test Script
```bash
php test_api.php
```

### Using cURL
See the complete examples in `API_DOCUMENTATION.md`

## Security Features

- **Token-based Authentication** with Laravel Sanctum
- **Input Validation** on all endpoints
- **SQL Injection Protection** with Eloquent ORM
- **CSRF Protection** built into Laravel
- **Secure Password Hashing** with bcrypt

## Production Deployment

1. **Environment Setup:**
   - Set `APP_ENV=production`
   - Set `APP_DEBUG=false`
   - Configure proper database credentials
   - Set up SSL certificates

2. **Security:**
   - Use strong passwords for admin accounts
   - Regularly rotate API tokens
   - Monitor API usage and logs
   - Implement rate limiting

3. **Performance:**
   - Use Redis for caching
   - Configure database connection pooling
   - Set up proper indexing on database tables

## License Status Flow

1. **Generated** → License key created with `inactive` status
2. **Registered** → User information added to license
3. **Activated** → License status changed to `active`
4. **Expired** → License status changed to `expired` (if expiration date passed)

## Support

For technical support or questions about the API, please refer to the complete documentation in `API_DOCUMENTATION.md` or contact the development team.

## License

This project is proprietary software for Simple licence application license management.
