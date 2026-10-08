<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}


define('BASE_URL', '/PSP_Student_Portal_MiniProject1/public');


date_default_timezone_set('Asia/Kuala_Lumpur');