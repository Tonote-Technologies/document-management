<?php class Signatures extends DatabaseObject
{
    protected static $table_name = "signature";
    protected static $db_columns = ['id', 'user_id', 'set_default', 'created_at', 'updated_at', 'created_by', 'deleted'];
    
    public $id;
    public $user_id;
    public $set_default;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $deleted;
    
    public $counts;

   
    public function __construct($args = [])
    {
        $this->user_id      = $args['user_id'] ?? '';
        $this->set_default  = $args['set_default'] ?? '';
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


    
}