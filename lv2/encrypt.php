<?php
    function encrypt_data($data){
        session_start();
        $encryption_key = md5('PasSwOrD456');
        $cipher = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($cipher);
        $options = 0;
        $encryption_iv = random_bytes($iv_length);
        $data = openssl_encrypt($data, $cipher,
            $encryption_key, $options, $encryption_iv);
        $encrypted_data = array(
            'data'=> base64_encode($data),
            'iv' => $encryption_iv
        );
        return $encrypted_data;
    }

    function save_file($file_name, $data, $iv){
        $db_name = 'encrypt';
        $pdo = new PDO("mysql:dbname=$db_name;host=localhost;", 'root', '');
        $sql = "INSERT INTO documents (name, iv) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$file_name, $iv]);
        unset($pdo);
        $f=fopen("./documents/$file_name",'w');
        fwrite($f,$data);
        fclose($f);
    }

    function get_file($file_name){
        $db_name = 'encrypt';
        $pdo = new PDO("mysql:dbname=$db_name;host=localhost;", 'root', '');
        $sql = "SELECT iv FROM documents WHERE name LIKE '$file_name'";
        $decryption_iv = $pdo->query($sql)->fetch(PDO::FETCH_COLUMN, 0);
        unset($pdo);
        $encrypted_data = file_get_contents("./documents/$file_name");
        $data = base64_decode($encrypted_data);
        $decryption_key = md5('PasSwOrD456');
        $cipher = "AES-128-CTR";
        $options = 0;
        $data=openssl_decrypt ($data, $cipher,
            $decryption_key, $options, $decryption_iv);
        ob_end_clean();
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Length: ". filesize("$file_name").";");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/octet-stream; ");
        header("Content-Transfer-Encoding: binary");
        echo trim($data);
        exit;
    }
?>