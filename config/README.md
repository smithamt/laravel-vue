Yes, you can use multiple databases in a single Laravel application. Laravel makes it easy to configure and manage multiple database connections. Here's how you can do it:

### Step 1: Configure the Databases in `.env`
Add the connection details for the second database in your `.env` file. Your `.env` might look like this:

```plaintext
# Default Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_test
DB_USERNAME=root
DB_PASSWORD=new_password

# Second Database
DB_CONNECTION_SECOND=mysql
DB_HOST_SECOND=127.0.0.1
DB_PORT_SECOND=3306
DB_DATABASE_SECOND=second_database
DB_USERNAME_SECOND=root
DB_PASSWORD_SECOND=second_password
```

### Step 2: Configure the Databases in `config/database.php`
Update your `config/database.php` file to include the second database connection.

```php
'connections' => [

    'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],

    'mysql_second' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST_SECOND', '127.0.0.1'),
        'port' => env('DB_PORT_SECOND', '3306'),
        'database' => env('DB_DATABASE_SECOND', 'forge'),
        'username' => env('DB_USERNAME_SECOND', 'forge'),
        'password' => env('DB_PASSWORD_SECOND', ''),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],

],
```

### Step 3: Use the Connections in Your Application
You can specify which database connection to use in your models, controllers, or wherever you're making database queries.

#### Using the Default Connection
```php
$users = DB::table('users')->get();
```

#### Using the Second Connection
```php
$usersFromSecondDb = DB::connection('mysql_second')->table('users')->get();
```

### Example: Model using the Second Connection
If you want a specific model to use the second database connection, you can define it like this:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondDatabaseModel extends Model
{
    protected $connection = 'mysql_second';
}
```

### Summary
- **Environment Configuration**: Added connection details for the second database in `.env`.
- **Database Configuration**: Updated `config/database.php` to include the second database connection.
- **Using Multiple Connections**: Demonstrated how to use the different connections in your application and models.

This setup should allow you to use multiple databases in your Laravel application seamlessly.

If you have any further questions or need additional assistance, feel free to ask! 😊

What else would you like to explore today?