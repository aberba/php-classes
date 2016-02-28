# My PHP Classes
A collection of reusable PHP classes that I use often in my projects. You free to use for whatever project you want. 
Suggestions for improvement are warmly welcome :)

## Using class.database.php
This class is used for connecting to databse, as well as, making CRUD operations. It ipliments a global variable `$Database` 
which you can use in you app like below;

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
