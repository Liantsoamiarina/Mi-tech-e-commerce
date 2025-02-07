<?php
    if (empty($_SESSION["client"])) {
        header("location:/login");
        die;
    }