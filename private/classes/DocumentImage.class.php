<?php class DocumentImage extends DatabaseObject
{
    protected static $table_name = "documentImage";
    protected static $db_columns = ['id', 'document_id', 'title', 'status', 'created_at', 'updated_at', 'created_by', 'deleted'];

    public $id;
    public $document_id;
    public $title;
    public $status;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $deleted;


    public $counts;

    const DOCUMENT_STATUS = [
        1 => 'Inbox',
        2 => 'Draft',
        3 => 'Sent',
        4 => 'Completed',
        5 => 'Trash',
    ];

    public function __construct($args = [])
    {
        $this->document_id = $args['document_id'] ?? '';
        $this->title = $args['title'] ?? '';
        $this->status      = $args['status'] ?? 2;
        $this->created_by  = $args['created_by'] ?? '';
        $this->updated_at  = $args['updated_at'] ?? '';
        $this->created_at  = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted     = $args['deleted'] ?? '';
    }


    public static function find_document($options=[])
    {
        $created_by = $options['created_by'] ?? false;
        $status = $options['status'] ?? false;
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE created_by='" . self::$database->escape_string($created_by) . "'";
        if(isset($status)){
            $sql .= " AND status='" . self::$database->escape_string($status) . "'";
        }
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id ASC ";
        // echo $sql;
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
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
}