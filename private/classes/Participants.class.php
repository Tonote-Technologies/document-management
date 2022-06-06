<?php class Participants extends DatabaseObject
{
    protected static $table_name = "participants";
    protected static $db_columns = ['id', 'document_id', 'first_name', 'last_name', 'email', 'phone','role', 'created_at', 'updated_at', 'created_by', 'deleted'];

    public $id;
    public $document_id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $role;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $deleted;

   

    public $counts;

    const ROLE = [
        1 => 'Document Owner',
        2 => 'Signer',
        3 => 'Witness',
    ];

    public function __construct($args = [])
    {
        $this->document_id = $args['document_id'] ?? '';
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->role      = $args['role'] ?? 2;
        $this->created_by  = $args['created_by'] ?? '';
        $this->updated_at  = $args['updated_at'] ?? '';
        $this->created_at  = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted     = $args['deleted'] ?? '';
    }

    public function full_name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->first_name)) {
            $this->errors[] = "First name cannot be blank.";
        } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "First name must be between 2 and 255 characters.";
        }

        if (is_blank($this->last_name)) {
            $this->errors[] = "Last name cannot be blank.";
        } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Last name must be between 2 and 255 characters.";
        }
    

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        }  elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }


        return $this->errors;
    }

    public static function find_by_document_id($document_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE document_id='" . self::$database->escape_string($document_id) . "'";
        return static::find_by_sql($sql);
    }
    
    public static function find_by_email($email)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
        

        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
        
    }
    
     public static function find_by_created_by($created_by)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE $created_by ='" . self::$database->escape_string($created_by) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id ASC ";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
        
    }
    
   
}