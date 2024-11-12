I. Project Setup Guide
Prerequisites
	•	Docker and Docker Compose installed on your machine.
	•	Git for cloning the repository.
  1.	Clone the Project:
   git clone https://github.com/Danny2725/tender_test_dev_laravel
  2.	Start the Docker Containers:
	•	docker-compose up -d
	•	You can access the application at http://localhost (or another port if configured differently in docker-compose.yml).
  3.    Run Laravel Migrations:
   	-	Once the containers have started, run the Laravel container migration command to create the tables in the database:
    - docker exec -it <containerId> bash
    - php artisan migrate
  4.	Stopping the Containers:
	•	When you’re done, stop the containers with:
    docker-compose down
 II. Curl

  ## 1. User Authentication

### Register
- **URL:** `/register`
- **Method:** `POST`
- **Function:** Registers a new user account.

### Login
- **URL:** `/login`
- **Method:** `POST`
- **Function:** Logs in the user to the system.

### Forgot Password
- **URL:** `/forgot-password`
- **Method:** `POST`
- **Function:** Sends an email for password reset.

### Reset Password
- **URL:** `/reset-password/{token}`
- **Method:** `POST`
- **Function:** Resets the password using a token.

### Email Verification
- **URL:** `/verify-email`
- **Method:** `GET`
- **Function:** Verifies the user’s email address.

### Resend Verification Email
- **URL:** `/email/verification-notification`
- **Method:** `POST`
- **Function:** Resends the email verification notification.

### Confirm Password
- **URL:** `/confirm-password`
- **Method:** `POST`
- **Function:** Confirms the user’s password for sensitive actions.

### Update Password
- **URL:** `/password`
- **Method:** `PUT`
- **Function:** Updates the user’s password.

### Logout
- **URL:** `/logout`
- **Method:** `POST`
- **Function:** Logs the user out of the system.

## 2. User Profile

### View and Update Profile
- **URL:** `/profile`
- **Method:** `GET`, `PATCH`
- **Function:** Views and updates the user’s profile information.

### Delete Account
- **URL:** `/profile`
- **Method:** `DELETE`
- **Function:** Deletes the user’s account.

## 3. Contractors

### List of Contractors
- **URL:** `/contractors`
- **Method:** `GET`
- **Function:** Retrieves the list of contractors.

## 4. Suppliers

### List of Suppliers
- **URL:** `/suppliers`
- **Method:** `GET`
- **Function:** Retrieves the list of suppliers.

## 5. Tenders

### Create a New Tender
- **URL:** `/tenders/create`
- **Method:** `GET`, `POST`
- **Function:** Creates a new tender.

### Edit Tender
- **URL:** `/tenders/{tender}/edit`
- **Method:** `GET`, `PUT`
- **Function:** Updates tender information.

### Delete Tender
- **URL:** `/tenders/{tender}`
- **Method:** `DELETE`
- **Function:** Deletes a tender.

Why Laravel is suitable for this tender management project:

1.	Built-in Authentication & Authorization
Laravel provides robust authentication out of the box
Role-based access control is easier to implement using Laravel's Gate and Policy features
Perfect for your contractor/supplier role requirements

2.	Eloquent ORM
Makes database operations more intuitive and secure
Relationships between tenders and users can be easily defined
Built-in query builder for complex tender filtering

3.	Modern Architecture
MVC pattern implementation is more robust than CodeIgniter
Service container for better dependency injection
Event/listener system for handling tender notifications
4.	API Development 
Built-in API authentication using Laravel Sanctum/Passport
API resource classes for consistent response formatting
API rate limiting and throttling built-in




## Comparison: CodeIgniter vs Laravel

| Feature               | CodeIgniter                          | Laravel                                      |
|-----------------------|--------------------------------------|----------------------------------------------|
| **Complexity**        | Simple, easy to learn                | More complex, with many built-in features    |
| **Performance**       | Fast, lightweight, few dependencies  | Slightly heavier but ideal for larger apps   |
| **Routing**           | Basic                                | Advanced, supports RESTful and middleware    |
| **ORM**               | Basic Active Record                  | Powerful Eloquent ORM                        |
| **Built-In Features** | Requires additional setup for extras | Includes authentication, authorization, caching |
| **Testing**           | Limited testing support              | Comprehensive testing tools                  |
| **Community**         | Smaller, fewer resources available   | Large, active community, extensive resources |

## Areas of Potential Improvement

### 1. Performance Optimization
- Implement caching system for frequently accessed tender data
- Optimize database queries for large datasets
- Add pagination for tender listings
- Implement lazy loading for related data
- Consider using Redis for caching and session management

### 2. Security Enhancements
- Implement two-factor authentication for sensitive operations
- Add rate limiting for API endpoints
- Enhance password policies
- Implement IP-based access restrictions
- Add audit logging for critical actions

### 3. User Experience
- Add real-time notifications using WebSockets
- Implement email notifications for tender updates
- Enhance search functionality with filters
- Add export functionality for tender data (PDF, Excel)
- Implement document preview system

### 4. Code Quality
- Increase unit test coverage
- Implement integration tests
- Add API documentation using OpenAPI/Swagger
- Enhance error handling and logging
- Implement continuous integration/deployment (CI/CD)

### 5. Feature Additions
- Advanced reporting and analytics dashboard
- Tender document version control
- Bulk operations for tender management
- Integration with external payment systems
- Mobile-responsive API endpoints

### 6. Scalability
- Implement horizontal scaling capabilities
- Add load balancing configuration
- Optimize file storage system
- Implement queue system for heavy processes
- Database sharding for large datasets

### 7. Monitoring and Maintenance
- Add system health monitoring
- Implement automated backup systems
- Add performance monitoring tools
- Create maintenance mode functionality
- Implement error tracking system

### 8. Documentation
- Enhance API documentation
- Add code documentation
- Create user guides
- Document deployment processes
- Add system architecture diagrams

### 9. Integration Capabilities
- Add support for third-party integrations
- Implement webhook system
- Create public API for external systems
- Add SSO capabilities
- Enable integration with common procurement systems