<?php 
// availability
function checkAvail($id) {
    include '../connectivity.php';

    // get system time
    $currentTime = date('Y/m/d');

    // query
    $query = "SELECT availability FROM car WHERE id = $id";
    
    // compare
    if ($currentTime >= ($result = $con->query($query))) {
        // update db
        $update = "UPDATE car SET availability = 'Available' WHERE id = $id";
        $con->query($update);

        // stop check || not sure
        return false;
    }

}

?>

