<?php
session_start();
if(isset($_SESSION['photo']) && !empty($_SESSION['photo'])){ 
   echo($_SESSION['photo']);
    } ?>