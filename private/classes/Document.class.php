<?php
class Document extends DatabaseObject
{
    protected static $table_name = "document";
    protected static $db_columns = ['id', 'document_id', 'title', 'filename', 'status', 'created_at', 'updated_at', 'created_by', 'deleted'];

    public $id;
    public $document_id;
    public $title;
    public $filename;
    public $status;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $deleted;


    public $counts;

    const DOCUMENT_STATUS = [
        1 => 'New',
        2 => 'Editing',
        3 => 'Shared',
        4 => 'Completed',
    ];

    const REQUEST_STATUS = [
        1 => 'Scheduled',
        2 => 'Approved',
        3 => 'Notarised',
        4 => 'Cancelled',
    ];

    const TRANSACTION_STATUS = [
        1 => 'Unpaid',
        2 => 'Paid',
        3 => 'Failed',
        4 => 'Reoccuring',
    ];

    const REQUEST_TYPE = [
        1 => 'Get an Affidavit',
        2 => 'Request a Notary',
        3 => 'Sign a Document',
    ];

    

    public function __construct($args = [])
    {
        $this->document_id = $args['document_id'] ?? '';
        $this->title = $args['title'] ?? '';
        $this->filename    = $args['filename'] ?? '';
        $this->status      = $args['status'] ?? 1;
        $this->created_by  = $args['created_by'] ?? '';
        $this->updated_at  = $args['updated_at'] ?? '';
        $this->created_at  = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted     = $args['deleted'] ?? '';
    }

    public static function find_by_document_ids($document_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE document_id ='" . self::$database->escape_string($document_id) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id DESC ";
        return static::find_by_sql($sql);
    }

    public static function find_by_document_id($document_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE document_id ='" . self::$database->escape_string($document_id) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id DESC ";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
        return array_shift($obj_array);
        } else {
        return false;
        }
    }

     static public function removeDocument($document_id) {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE document_id='" . self::$database->escape_string($document_id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

    
}