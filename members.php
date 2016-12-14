<?php

    session_start();
    
	/**
	* This query is retrieving all the information from the Bills table, to be displayed in the front end with an option to remove a bill with each row.
	*/

    $query = "SELECT * FROM BillPayers";
    if ($result = $mysqli->query($query)) 
    {        
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) 
        {
            if($row['GroupAdmin'] == $_SESSION['GroupAdmin'])
            {
            echo 
            "<tr>
              <td>{$row['PayerID']}</td>
              <td>
                <button class='btn btn-danger btn-xs'  type= 'submit' name = 'Name' value = '{$row['PayerID']}' formaction='RemovePayer.php'><i class='fa fa-trash-o'></i></button>
              </td>
            </tr>"; 
            }
                                        
        }

        /* free result set */
        $result->free();
    }
?>
