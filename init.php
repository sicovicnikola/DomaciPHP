<?php
    require "db.php";
    require "domain/note.php";

    session_start();

    if (isset($_GET['logout']) && !empty($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

    $notes = Note::getAllNotes($conn);

    if (!$notes) {
        echo "Greska u upitu.";
        die();
    }

    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">   
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Notes</title>
    <a href="home.php?logout=true" style="float: right; padding: 0px">
            <button id="logout" type="button" class="btn" style="color: white; background-color: rgba(218, 226, 0, 1);">
                <i class="bi bi-arrow-bar-left"></i>
                Log out
            </button>
        </a>
</head>

<body>

    <div>
        <h1>Notes</h1> 
       
    </div>

    
    

    <div style="margin-top: 10px; background-color: rgba(44, 37, 40, 1); border:none" >
        <table id="movieTable" class="table " style="color: white; background-color: rgba(132, 111, 122, 0.37);">
            <thead class=" table-dark" style="color: white; background-color: rgba(44, 37, 40, 1);">
            <tr>
                <th scope="col"></th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Date</th>
                <th scope="col">Select note</th>
            </tr>
            </thead>

            <tbody>
                <?php
                    while ($row = $notes->fetch_array()) { 
                ?>
                <tr>
                    <td></td>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php echo $row["content"] ?></td>
                    <td><?php echo $row["date"] ?></td>
                    
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-donut" value=<?php echo $row["id"] ?>>
                        </label>
                    </td>

                </tr>
                <?php
            }
         } ?>
            </tbody>
        </table>
        <div class="row" style="padding: 10px; background-color: rgba(10, 65, 82, 0)">
            <div class="col-md-4">
        
                <button type="button" class="btn btn-primary"
                    style="color: white; background-color:rgba(130, 132, 141, 1);" data-toggle="modal" data-target="#addNoteModal">
                    <i class="bi bi-controller"></i> 
                    Add new note  
                </button>
                
             </div>
        
            <div class="col-sm-8" style="text-align: right">
                <button id="btnEditNote" class="btn " style="color: white; background-color: rgba(130, 132, 141, 1);"
                    data-toggle="modal" data-target="#editNoteModal">
                    <i class="bi bi-pen-fill"></i> 
                    Update note  
                </button>
                
                <button id="btnDeleteNote" class="btn " style="color: white; background-color: rgba(196, 49, 64, 1);">
                    <i class="bi bi-eraser-fill"></i> 
                    Delete note
                </button>
            </div>
        </div>
        


        
    </div>

    
    <!-- Add game modal -->
    <div class="modal fade" id="addNoteModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid rgb(2, 47, 61); background-color:rgb(2, 47, 61) ;">
                <div class="modal-header">
                    <h3 style="color: white; text-align:left">Add new note</h3>  
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="#" method="post" id="addNoteForm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input  type="text" style="border: 1px solid black" name="userId" class="form-control"
                                           placeholder="User ID" value="<?php echo $_SESSION['user_id'] ?>" readonly/> 
                                    </div>
                                    <div class="form-group">
                                        <input  type="text" style="border: 1px solid black" name="noteTitle" class="form-control"
                                           placeholder="Title" value=""/> 
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" name="noteContent" class="form-control" placeholder="Content"
                                           value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" style="border: 1px solid black" name="noteDate" class="form-control"
                                           placeholder="Date" value=""/>
                                    </div>
                                </div>
                                <div class="col-4" style="text-align: center">
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success "
                                            style="background-color: rgba(10, 65, 82, 1); border: 1px solid black;">
                                             Add note
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-default" 
                                            style="color: white; background-color: rgb(82, 10, 46); border: 1px solid white" 
                                            data-dismiss="modal">Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>

<!-- Edit game Modal-->
    <div class="modal fade" id="editNoteModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid rgb(2, 47, 61); background-color:rgb(2, 47, 61) ;">
                <div class="modal-header">
                    <h3 style="color: white; text-align:left">Edit note</h3>   
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="#" method="post" id="editNoteForm">
                    
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input id="id" type="text" style="border: 1px  black" name="noteId" class="form-control"
                                           placeholder="Note ID" value="" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <input id="noteTitleId" style="border: 1px solid black" type="text" name="noteTitle" class="form-control"
                                           placeholder="Title" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="noteContentId" style="border: 1px solid black" type="text" name="noteContent" class="form-control"
                                           placeholder="Content" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="noteDateId" style="border: 1px solid black" type="date" name="noteDate" class="form-control"
                                           placeholder="Date" value=""/>
                                    </div>
                                </div>
                                <div class="col-4" style="text-align: center">
                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit" class="btn btn-success"
                                            style="background-color: rgba(10, 65, 82, 1); border: 1px solid black;">
                                             Update note
                                        </button>
                                    </div>
                                    <div class= "form-group">
                                        <button type="button" class="btn btn-default" 
                                        style="color: white; background-color: rgb(82, 10, 46); border: 1px solid white" 
                                        data-dismiss="modal">Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
  
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="javascript.js"></script>


    

</body>
</html>
