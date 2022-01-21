<?php
require "../db.php";
require "../domain/note.php";

if(isset($_POST['id'])) {
    Note::deleteNoteById($_POST['id'], $conn);
}

?>