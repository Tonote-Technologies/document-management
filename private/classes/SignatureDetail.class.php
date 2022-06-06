<?php class SignatureDetail extends DatabaseObject
{
    protected static $table_name = "signatureDetails";
    protected static $db_columns = ['id', 'user_id', 'filename', 'type', 'category','signature_id','created_at', 'updated_at', 'created_by', 'deleted'];
    
    public $id;
    public $user_id;
    public $filename;
    public $type;
    public $category;
    public $signature_id;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $deleted;
    
    public $counts;

   const TYPE = [
      1 => 'Typed',
      2 => 'Drawn',
      3 => 'Uploaded',
    ];

    const CATEGORY = [
      1 => 'signature',
      2 => 'initial',
    ];

    public function __construct($args = [])
    {
        $this->user_id      = $args['user_id'] ?? '';
        $this->filename     = $args['filename'] ?? '';
        $this->type         = $args['type'] ?? '';
        $this->category     = $args['category'] ?? '';
        $this->signature_id     = $args['signature_id'] ?? '';
        $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at   = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_by   = $args['created_by'] ?? '';
        $this->deleted      = $args['deleted'] ?? '';
    }

    public static function find_by_user_ids($user_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE user_id ='" . self::$database->escape_string($user_id) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id ASC ";
        return static::find_by_sql($sql);
    }

    public static function find_by_element($options=[])
    {
        $user_id = $options['user_id'] ?? false;
        $category = $options['category'] ?? false;
        
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE user_id ='" . self::$database->escape_string($user_id) . "'";
        if(isset($category)){
            $sql .= " AND category ='" . self::$database->escape_string($category) . "'";
        } 
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id ASC ";
        return static::find_by_sql($sql);
    }

    

    public static function find_by_user_id($user_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE user_id ='" . self::$database->escape_string($user_id) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id DESC ";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }

    public static function find_by_category($options=[])
    {
        $category = $options['category'] ?? false;
        $user_id = $options['user_id'] ?? false;
        
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE category='" . self::$database->escape_string($category) . "'";
        if(isset($user_id)){
            $sql .= " AND user_id='" . self::$database->escape_string($user_id) . "'";
        }
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        // $sql .= " LIMIT 1 ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }

     public static function createSignature($options=[]){
                
        $user_id     = $options['user_id'] ?? false;
        $set_default = $options['set_default'] ?? false;
        $filename    = $options['filename'] ?? false; 
        $type        =  $options['type'] ?? false;
        $category    =  $options['category'] ?? false;

        $args2 = [
            'user_id' => $user_id,
            'filename' => $filename,
            'type' => $type,
            'category' => $category,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_id ?? 0,
        ];
        $signatureDetails = new SignatureDetail($args2);
        $result = $signatureDetails->save(); 
        // pre_r($signatureDetails);
        // $result2 = true;  
        if ($result == true) {
            return true;
        }else{
            return false;
        }
                    
    }
}