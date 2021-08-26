<?php

try
{
    $conn = new PDO("mysql:dbname=fkorom;host=localhost", 'fkorom', 'OV5IKjeXsBwPWSq');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

}
catch (PDOException $e)
{
    exit("Sikertelen csatlakozas :(");
}



