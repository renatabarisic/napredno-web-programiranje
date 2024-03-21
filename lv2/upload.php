<?php
    require_once('./encrypt.php');
    require_once ('./dbcreate.php');
    createTable();
    $files = preg_grep('/^([^.])/', scandir('./documents/'));

    if(isset($_GET['document'])){
        get_file($_GET['document']);
    }

    if(isset($_FILES['userfile']['name'])){
        $file_name = $_FILES['userfile']['name'];
        if(!in_array($file_name, $files)){
            $file_contents = file_get_contents($_FILES['userfile']['tmp_name']);
            $encrypted_data = encrypt_data($file_contents);
            save_file($file_name, $encrypted_data['data'], $encrypted_data['iv']);
            $files = preg_grep('/^([^.])/', scandir('./documents/'));
        }
        else{
            echo 'Document with the same name already exists!';
        }
    }
?>

<form enctype="multipart/form-data" action="./upload.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    Send file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>

<?php
    foreach($files as $file_name){
        echo "<a href='./upload.php?document=$file_name'>" . "$file_name" . '</a>'. '</br>';
    }
?>