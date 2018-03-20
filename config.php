<?php 
session_start();
const host = 'localhost';
const user = 'root';
const pass = '';
const db = 'kpshah_master';
$con = new mysqli(host,user,pass,db);
date_default_timezone_get('asia/kolkata');


?>