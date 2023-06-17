<?php

function getInventoryCount()
{

    require_once 'config.php';

    $query = "SELECT COUNT(*) AS total FROM inventory";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Fetch the total row count
        $row = mysqli_fetch_assoc($result);
        $totalCount = $row['total'];

        // Display the total count in a <p> tag
        echo $totalCount;
    } else {
        echo "Error retrieving inventory count: " . mysqli_error($connection);
    }
}
?>