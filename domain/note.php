<?php
 class Note{

    public $id;
    public $title;
    public $content;
    public $date;
    public $user_id;

    public function __construct($id=null, $title = null, $content=null,$date=null,$user_id=-2){
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->date=$date;
        $this->user_id=$user_id;
    
    }


    public static function getAllNotes(mysqli $connection)
    {
        $user_id= $_SESSION['user_id'];
        $sql = "SELECT * FROM notes WHERE userId= $user_id";
        return $connection->query($sql);
    }

    public static function getNoteById($id, mysqli $connection)
    {
        $sql = "SELECT * FROM notes WHERE id=$id";
        $myArray = array();
        if ($result = $connection->query($sql)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }

    public static function deleteNoteById($id, mysqli $connection)
    {
        $sql = "DELETE FROM notes WHERE id=$id";
        return $connection->query($sql);
    }

    public static function addNote($title, $content, $userId, mysqli $connection)
    {
        $sql = "INSERT INTO notes(title,content,userId) VALUES('$title','$content','$userId')";
        return $connection->query($sql);
    }

    public static function editNote($id, $title,$content, mysqli $connection)
    {
        $sql = "UPDATE notes SET title='$title', content='$content' WHERE id=$id";
        return $connection->query($sql);
    }

 }


?>