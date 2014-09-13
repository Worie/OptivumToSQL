<?php

// Połączenie z utworzona wczesniej bazą danych

$database_host = "";
$database_user = "";
$database_pass = "";
$database = "";
     
// Hasło wymagane do wyeksportowania danych do bazy
$pass = 'qwerty';

// Domyślny URL do planu lekcji
$dir = "";

// Opcjonalne - raportowanie błędów
error_reporting(E_ERROR | E_PARSE);

// Opcja wymagana do poprawnego działania parsera
ini_set('allow_url_fopen',true);

?>
