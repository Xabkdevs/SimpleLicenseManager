# SahelLicenseManager API Documentation

A Laravel 11 REST API for managing software licenses for the SAHEL FASTFOOD desktop application.

## Table of Contents
- [Installation](#installation)
- [Configuration](#configuration)
- [API Endpoints](#api-endpoints)
- [Authentication](#authentication)
- [Example Requests](#example-requests)
- [License Key Generation](#license-key-generation)

## Installation

1. **Clone and setup the project:**
```bash
cd SahelLicenseManager
composer install
```

2. **Environment configuration:**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Database setup:**
```bash
php artisan migrate
```

4. **Generate license keys:**
```bash
php artisan license:generate 100
```

## Configuration

### Database Configuration
Update your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sahel_license_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Sanctum Configuration
The API uses Laravel Sanctum for authentication. The configuration is already set up in `config/sanctum.php`.

## API Endpoints

### Base URL
```
http://your-domain.com/api
```

### Authentication Endpoints

#### 1. User Registration
- **POST** `/api/register-user`
- **Description:** Register a new admin user
- **Authentication:** Not required

#### 2. User Login
- **POST** `/api/login`
- **Description:** Login and get API token
- **Authentication:** Not required

#### 3. Get User Info
- **GET** `/api/me`
- **Description:** Get authenticated user information
- **Authentication:** Required (Bearer token)

#### 4. Logout
- **POST** `/api/logout`
- **Description:** Logout and revoke current token
- **Authentication:** Required (Bearer token)

### License Management Endpoints

#### 1. Register License
- **POST** `/api/register`
- **Description:** Register a license with user information
- **Authentication:** Not required

#### 2. Activate License
- **POST** `/api/activate`
- **Description:** Activate a license
- **Authentication:** Not required

#### 3. Validate License
- **GET** `/api/validate/{license_key}`
- **Description:** Validate a license and get status
- **Authentication:** Not required

#### 4. List Licenses (Admin)
- **GET** `/api/licenses`
- **Description:** List all licenses with filtering and pagination
- **Authentication:** Required (Bearer token)

## Authentication

The API uses Laravel Sanctum for token-based authentication. Include the token in the Authorization header:

```
Authorization: Bearer {your-token}
```

## Example Requests

### 1. User Registration
```bash
curl -X POST http://localhost:8000/api/register-user \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Admin User",
    "email": "admin@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin User",
      "email": "admin@example.com"
    },
    "token": "1|abcdef123456...",
    "token_type": "Bearer"
  }
}
```

### 2. User Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password123"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin User",
      "email": "admin@example.com"
    },
    "token": "2|xyz789...",
    "token_type": "Bearer"
  }
}
```

### 3. Register License
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "license_key": "SAHEL-ABCD-EFGH-IJKL-MNOP",
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

**Response:**
```json
{
  "success": true,
  "message": "License registered successfully",
  "data": {
    "license_key": "SAHEL-ABCD-EFGH-IJKL-MNOP",
    "status": "inactive",
    "user_info": {
      "first_name": "John",
      "last_name": "Doe",
      "brand_name": "Johns Restaurant",
      "phone": "+1234567890",
      "os": "Windows 11"
    }
  }
}
```

### 4. Activate License
```bash
curl -X POST http://localhost:8000/api/activate \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "license_key": "SAHEL-ABCD-EFGH-IJKL-MNOP"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "License activated successfully",
  "data": {
    "license_key": "SAHEL-ABCD-EFGH-IJKL-MNOP",
    "status": "active",
    "expires_at": null
  }
}
```

### 5. Validate License
```bash
curl -X GET http://localhost:8000/api/validate/SAHEL-ABCD-EFGH-IJKL-MNOP \
  -H "Accept: application/json"
```

**Response:**
```json
{
  "success": true,
  "status": "active",
  "expires_at": null,
  "user_info": {
    "first_name": "John",
    "last_name": "Doe",
    "brand_name": "Johns Restaurant",
    "phone": "+1234567890",
    "os": "Windows 11",
    "additional_data": {
      "restaurant_id": "REST001",
      "location": "New York"
    }
  }
}
```

### 6. List Licenses (Admin)
```bash
curl -X GET "http://localhost:8000/api/licenses?status=active&search=John" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {your-token}"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "license_key": "SAHEL-ABCD-EFGH-IJKL-MNOP",
        "first_name": "John",
        "last_name": "Doe",
        "brand_name": "Johns Restaurant",
        "phone": "+1234567890",
        "os": "Windows 11",
        "status": "active",
        "expires_at": null,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
      }
    ],
    "first_page_url": "http://localhost:8000/api/licenses?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/licenses?page=1",
    "links": [...],
    "next_page_url": null,
    "path": "http://localhost:8000/api/licenses",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1,
    "total": 1
  }
}
```

### 7. Get User Info
```bash
curl -X GET http://localhost:8000/api/me \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {your-token}"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "Admin User",
      "email": "admin@example.com"
    }
  }
}
```

### 8. Logout
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {your-token}"
```

**Response:**
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

## License Key Generation

Use the Artisan command to generate license keys in bulk:

```bash
# Generate 100 license keys
php artisan license:generate 100

# Generate 1000 license keys
php artisan license:generate 1000
```

**Example output:**
```
Generating 100 license keys...
████████████████████████████████████████ 100/100

Successfully generated 100 license keys!
All keys have been saved to the database with 'inactive' status.

Sample generated keys:
  - SAHEL-A1B2-C3D4-E5F6-G7H8
  - SAHEL-I9J0-K1L2-M3N4-O5P6
  - SAHEL-Q7R8-S9T0-U1V2-W3X4
  - SAHEL-Y5Z6-A7B8-C9D0-E1F2
  - SAHEL-G3H4-I5J6-K7L8-M9N0
  ... and 95 more
```

## Error Responses

All endpoints return consistent error responses:

```json
{
  "success": false,
  "message": "Error description",
  "errors": {
    "field_name": ["Validation error message"]
  }
}
```

## Status Codes

- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `404` - Not Found
- `422` - Validation Error
- `500` - Internal Server Error

## License Status Values

- `inactive` - License exists but not activated
- `active` - License is active and valid
- `expired` - License has expired

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

## Security Features

1. **Token-based Authentication** - Uses Laravel Sanctum for secure API access
2. **Input Validation** - All inputs are validated with Laravel's validation rules
3. **SQL Injection Protection** - Uses Eloquent ORM with parameterized queries
4. **CSRF Protection** - Built-in Laravel CSRF protection
5. **Rate Limiting** - Can be configured for API endpoints

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

## Support

For technical support or questions about the API, please contact the development team.
