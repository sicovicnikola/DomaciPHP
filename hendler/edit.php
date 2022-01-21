<?php

require "../db.php";
require "../domain/note.php";

if (isset($_POST['noteTitle']) && isset($_POST['noteContent']) && isset($_POST['noteDate'])) {
   Note::editNote($_POST['noteId'],$_POST['noteTitle'], $_POST['noteContent'], $_POST['noteDate'] ,$conn);
}

 ?>