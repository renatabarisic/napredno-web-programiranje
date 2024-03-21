<?php
    $db_name = 'encrypt';
    $dir = "backup/$db_name";

    if (!is_dir($dir)) {
        if (!@mkdir($dir)) {
            die("<p>Ne možemo stvoriti direktorij $dir.</p></body></html>");
        }
    }

    $time = time();
    $pdo = new PDO("mysql:dbname=$db_name;host=localhost;", 'root', '');
    $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN, 0);

    if($tables){
        echo "<p>Backup za bazu podataka '$db_name'.</p>";

        foreach($tables as $table){
            $results = $pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
            if($results){
                if ($fp = gzopen ("$dir/{$table}_{$time}.sql.gz", 'w9')) {
                    foreach($results as $entry){
                        $backupString = "INSERT INTO $table (";
                        $backupString .= implode(', ', array_keys($entry));
                        $backupString .= ")\nVALUES (";
                        array_walk($entry, function(&$value){
                            $value = "'$value'";
                        });
                        $backupString .= implode(', ',$entry);
                        $backupString .= ");\n";

                        gzwrite($fp, $backupString);
                    }
                    gzclose($fp);
                }
                else { 
                    echo "<p>Datoteka $dir/{$table}_{$time}.sql.gz se ne može otvoriti.</p>";
                    break; 
                }
            }
        }
    }
    else {
        echo "<p>Baza $db_name ne sadrži tablice.</p>";
    }