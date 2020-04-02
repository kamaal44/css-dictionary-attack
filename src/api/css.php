<?php
// just a quick API
include_once './php/database.class.php';
header('Content-Type: application/json; charset=UTF-8');
if (isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) === 'get') {
    if (isset($_GET['v'])) {
        // insert into table
        $parameters = array(
            'password' => $_GET['v']
        );
        mb_internal_encoding('UTF-8');
        if (mb_strlen($parameters['password']) >= 1 && mb_strlen($parameters['password']) <= 50) {
            $db = new Database();
            if ($db->isConnected()) {
                $db->query('INSERT INTO `passwords` (`ip`, `password`, `date`) VALUES (:ip, :password, :date)');
                $db->bind(':ip', $_SERVER['REMOTE_ADDR']);
                $db->bind(':password', $parameters['password']);
                $db->bind(':date', date('Y-m-d H:i:s', time()));
                $db->execute();
            }
            $db->disconnect();
        }
    } else {
        // select from table
        $db = new Database();
        if ($db->isConnected()) {
            $db->query('SELECT `id`, `password`, `date` FROM `passwords`');
            if ($db->execute()) {
                if ($db->rowCount() > 0) {
                    $data = $db->fetchAll();
                    if ($data) {
                        echo json_encode($data, JSON_PRETTY_PRINT);
                    }
                }
            }
        }
        $db->disconnect();
    }
}
?>
