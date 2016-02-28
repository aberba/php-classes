# php-classes
A collection of reusable PHP classes that I use often in my projects.

## Using class.database.php
This class is used for connecting to databse, as well as, making CRUD operations. It ipliments a global variable `$Database` 
which you can use in you app like below;

`php
class Users {
    private $table_name = "users";
    
    public function fetchAll() {
        global $Database; //import variable $Database into the scope of this method
        
        $results = $Database->query("SELECT * FROM ". static::$table_name .""); // returns true for sucess or false for error, see class.database.php
        
        if (!$results) return false;
        
        $users  = $result = $Database->fetchData($results);
        
        if ($Database->nrumRows($results < 1)) return false;
        
        $output = []; // or $output = array(); for bacward compatibility
        while ($row = $Database->fetchData($results)) {
            $output[] = $row; //append to array
        }
        
        return $output;
        
}
`

`php
Using Users class
$users = new User();
$records = $users->fetchAll();
`
