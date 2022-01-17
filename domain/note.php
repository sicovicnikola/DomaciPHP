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


 }


?>