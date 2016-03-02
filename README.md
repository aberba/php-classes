# My PHP Classes
A collection of reusable PHP classes that I use often in my projects. You are free to use for whatever project you want. 
Suggestions for improvement are warmly welcome :)

## Using class.database.php
This file declares a class `Database` is used for connecting to your databse, as well as, making CRUD operations. It impliments a global variable `$Database`. The class has been designed to abstract he underlining database type, so use can use MySQL, MSSQL, SQLite, MongoDB, etc. in-place of the default `MySQL` database. 
See usage below;

```php
class Users {
    private $table_name = "users";
    
    public function fetchAll() {
        //import variable $Database into the scope of this method
        global $Database; 
        
        // returns true for sucess or false for error, check class.database.php
        $results = $Database->query("SELECT * FROM ". static::$table_name); 
        
        if (!$results) return false;
        
        // Theres is also $Database->numRows($results < 1);, check class.database.php
        
        $output = []; // or $output = array(); for backward compatibility
        
        while ($row = $Database->fetchData($results)) {
            $output[] = $row; //append to array
        }
        
        return $output;
}
```

Using Users class
```php
$users = new User();
$records = $users->fetchAll();
```
