<?php class TextAreaDetails extends DatabaseObject
{
    protected static $table_name = "textareaDetails";
    protected static $db_columns = ['id', 'tool_id', 'text_value', 'created_by','updated_at', 'created_at', 'deleted'];

    public $id;
    public $tool_id;
    public $text_value;
    public $created_by;
    public $updated_at; 
    public $created_at;
    public $deleted;
    
    public $counts;
    

    public function __construct($args = [])
    {
        $this->tool_id      = $args['tool_id'] ?? '';
        $this->text_value   = $args['text_value'] ?? '';
        $this->created_by   = $args['created_by'] ?? '';
        $this->updated_at   = $args['updated_at'] ?? '';
        $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted      = $args['deleted'] ?? '';
    }

  

    public static function find_by_tool_id($tool_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE tool_id='" . self::$database->escape_string($tool_id) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    static public function removeTool($tool_id) {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE tool_id='" . self::$database->escape_string($tool_id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

    
   
}