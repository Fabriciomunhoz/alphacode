<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'alpha-code');

function getDB()
{
    $dbConnection = new PDO(
        "mysql:host=" . DB_SERVER,
        DB_USERNAME,
        DB_PASSWORD
    );
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $dbConnection->prepare("SHOW DATABASES LIKE '" . DB_DATABASE . "'");
    $query->execute();
    if ($query->rowCount() == 0) {
        $dbConnection->exec("CREATE DATABASE `" . DB_DATABASE . "`");
        $dbConnection->exec("USE `" . DB_DATABASE . "`");
        $dbConnection->exec("
            CREATE TABLE cadastro (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            nome_completo VARCHAR(120),
            email VARCHAR(120),
            telefone VARCHAR(15),
            celular VARCHAR(15),
            data_nascimento DATE,
            profissao VARCHAR(120),
            celular_possui_whatsapp BOOLEAN DEFAULT FALSE,
            notificacao_email BOOLEAN DEFAULT FALSE,
            notificacao_sms BOOLEAN DEFAULT FALSE
            );
            ");
    } else {
        $dbConnection->exec("USE `" . DB_DATABASE . "`");
    }
    return $dbConnection;
}