<?php class DocumentResource extends DatabaseObject
{
    protected static $table_name = "documentResource";
    protected static $db_columns = ['id', 'document_id', 'filename', 'file', 'tool_id', 'toolUser','tool_type','tool_name','tool_class', 'tool_pos_top', 'tool_pos_left', 'tool_width', 'tool_height', 'resizable', 'created_at', 'updated_at', 'created_by', 'deleted'];

    public $id;
    public $document_id;
    public $filename;
    public $file;
    public $tool_id;
    public $toolUser;
    public $tool_type;
    public $tool_name;
    public $tool_class;
    public $tool_pos_top;
    public $tool_pos_left;
    public $tool_width;
    public $tool_height;
    public $resizable;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $deleted;


    public $counts;

    Const TOOL_TYPE = [
        1 => 'Annotation',
        2 => 'Element',
    ];


    public function __construct($args = [])
    {
        $this->document_id      = $args['document_id'] ?? '';
        $this->filename         = $args['filename'] ?? '';
        $this->file             = $args['file'] ?? '';
        $this->tool_id          = $args['tool_id'] ?? '';
        $this->toolUser         = $args['toolUser'] ?? '';
        $this->tool_type        = $args['tool_type'] ?? '';
        $this->tool_name        = $args['tool_name'] ?? '';
        $this->tool_class       = $args['tool_class'] ?? '';
        $this->tool_pos_top     = $args['tool_pos_top'] ?? '';
        $this->tool_pos_left    = $args['tool_pos_left'] ?? '';
        $this->tool_width       = $args['tool_width'] ?? '';
        $this->tool_height      = $args['tool_height'] ?? '';
        $this->resizable        = $args['resizable'] ?? '';
        $this->created_by       = $args['created_by'] ?? '';
        $this->updated_at       = $args['updated_at'] ?? '';
        $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted          = $args['deleted'] ?? '';
    }

    public static function find_by_document_ids($document_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE document_id ='" . self::$database->escape_string($document_id) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id ASC ";
        return static::find_by_sql($sql);
    }
     public static function find_by_created_by($created_by)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE $created_by ='" . self::$database->escape_string($created_by) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id ASC ";
        return static::find_by_sql($sql);
    }
    
    public static function find_by_document_id($document_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE document_id ='" . self::$database->escape_string($document_id) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id DESC ";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }
    public static function find_by_tool_type($tool_type)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE tool_type ='" . self::$database->escape_string($tool_type) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id DESC ";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }

    static public function find_by_tool_id($tool_id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE tool_id='" . self::$database->escape_string($tool_id) . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
        return array_shift($obj_array);
        } else {
        return false;
        }
    }

    static public function find_by_user_tool($document_id, $toolUser){
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE document_id ='" . self::$database->escape_string($document_id) . "'";
        $sql .= " AND toolUser ='" . self::$database->escape_string($toolUser) . "'";
        // $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id DESC ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }

    static public function removeTool($id) {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;

        // After deleting, the instance of the object will still
        // exist, even though the database record does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted.";
        // but, for example, we can't call $user->update() after
        // calling $user->delete().
    }

    static public function removeSignerTool($document_id, $toolUser) {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE document_id='" . self::$database->escape_string($document_id) . "' ";
        $sql .= " AND toolUser='" . self::$database->escape_string($toolUser) . "' ";
        // $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

    static public function compressImage($source, $destination, $quality) { 
        // Get image info 
        $imgInfo = getimagesize($source); 
        $mime = $imgInfo['mime']; 
        
        // Create a new image from file 
        switch($mime){ 
            case 'image/jpeg': 
                $image = imagecreatefromjpeg($source); 
            imagejpeg($image, $destination, $quality);
                break; 
            case 'image/png': 
                $image = imagecreatefrompng($source); 
                imagepng($image, $destination, $quality);
                break; 
            case 'image/gif': 
                $image = imagecreatefromgif($source); 
                imagegif($image, $destination, $quality);
                break; 
            default: 
                $image = imagecreatefromjpeg($source); 
            imagejpeg($image, $destination, $quality);
        } 
        
        
        // Return compressed image 
        return $destination; 
    } 
    
}