<?php
function managePassword($password) {
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (preg_match($regex, $password)) {
        return true;
    } else {
        return false;
    }
}
?>