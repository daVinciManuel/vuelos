<?php
require_once './checkOAuth.php';
require_once '../db/connect.php';
require_once '../models/mreservas.php';
$vuelos = getVuelosDisponibles();

var_dump($vuelos);
require_once '../views/vreservas.php';
