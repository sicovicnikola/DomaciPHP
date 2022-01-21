<?php
require "../db.php";
require "../domain/note.php";

if (isset($_POST['noteTitle']) && isset($_POST['noteContent']) && isset($_POST['noteDate'])) {
    Note::addNote($_POST['noteTitle'], $_POST['noteContent'], $_POST['noteDate'], $_POST['userId'], $conn);
}

?>