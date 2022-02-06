$('#addNoteForm').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const serializedData = $form.serialize();
    request = $.ajax({
        url: 'hendler/add.php',
        type: 'post',
        data: serializedData
    });
    request.done(function (response, textStatus, jqXHR) {
        if (textStatus === 'success') {
            alert('Note is successfully added'); 
            location.reload(true);
        } else {
            alert('Note is not successfully added');
            location.reload(true);
        }
    });
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
    });
});


$('#btnEditNote').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    request = $.ajax({
        url: 'hendler/get.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });
    request.done(function (response, textStatus, jqXHR) {
        $('#noteTitleId').val(response[0]['title']);
        $('#noteContentId').val(response[0]['content'].trim());
        $('#noteDateId').val(response[0]['date'].trim());
        $('#id').val(checked.val());
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
        
    });

});


$('#editNoteForm').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const serializedData = $form.serialize();
    request = $.ajax({
        url: 'hendler/edit.php',
        type: 'post',
        data: serializedData
    });
    request.done(function (response, textStatus, jqXHR) {
        if (textStatus === 'success') {
            alert('Note is  successfully edited!'); 
            location.reload(true);
        } else {
            alert('Note is not successfully edited!');
            location.reload(true);
        }
    });
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });
});

$('#btnDeleteNote').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    request = $.ajax({
        url: 'hendler/delete.php',
        type: 'post',
        data: {'id': checked.val()}
    });

    request.done(function (data, textStatus, qXHR) {
        if(textStatus === 'success'){
            checked.closest('tr').remove();
            alert("Note is successfully  deleted");
        } else {
            alert("Note is not successfully  deleted");
        }
    });
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
    });
});