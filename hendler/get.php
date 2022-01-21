<?php

require "../db.php";
require "../domain/note.php";

if(isset($_POST['id'])) {
    $note = Note::getNoteById($_POST['id'], $conn);
    echo json_encode($note);
}

?>
