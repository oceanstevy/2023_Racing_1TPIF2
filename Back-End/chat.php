<?php
//Autor: Christopher Pinetti
session_start();

$name = $_SESSION['user'];

require './Functions/Credentials.php';
require './Functions/Functions.php';
require  "./Query/Querys.php";

$dbc = db_Connect();

/*if get is set*/
if (isset($_GET['executionType'])) {


    /*is get read?*/
        if ( $_GET[ 'executionType' ] == "read" ) {

            showData($dbc, $name);

        }
    /*is get write?*/
    if ($_GET['executionType'] == "write") {

        /*if both paramaters are set*/
        if (isset($_GET['text'])) {

            insertData($dbc, $name);

        }
    }
}

/*shows the content of the database*/
function showData($dbc, $name)
{
    $queryNewFeed = "SELECT dtName, dtMessage, dtTimestamp
                        FROM tblChat, tblPlayer
                        WHERE idPlayer = fiPlayer
                        ORDER BY dtTimestamp ASC";

    $result = mysqli_query($dbc, $queryNewFeed);

    $arrayFeed = [];

    /*checks how many dataset are set */
    for ($count = 0; $count < mysqli_num_rows($result); $count++) {

        /*cuts row by row*/
        $row = mysqli_fetch_assoc($result);

        if ($name == $row['dtName']) {

            /*pushes an associative array into empty array based on rows*/
            $arrayFeed[] = array(
                "Name" => $row['dtName'],
                "Message" => $row['dtMessage'],
                "timestamp" => $row['dtTimestamp'],
                "color" => "blue"
            );
        } else {
            $arrayFeed[] = array(
                "Name" => $row['dtName'],
                "Message" => $row['dtMessage'],
                "timestamp" => $row['dtTimestamp'],
                "color" => "black"
            );
        }

    }

    /*converts array to json*/
    echo json_encode($arrayFeed);

    /*frees the result and closes db connection*/
    mysqli_free_result($result);
    mysqli_close($dbc);
}

/*gets database connection + name + text out of the get parameter*/
function insertData($dbc, $name)
{
    $currentTimestamp = date("Y-m-d H:i:s");
    $text = $_GET['text'];

    $sql = "SELECT idPlayer FROM tblPlayer WHERE dtName=?"; // SQL with parameters
    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $userID = $result->fetch_assoc(); // fetch the data

    $userIDtoInt = intval(implode($userID));

    /*defines insert query with both parameters we want to add*/
    $queryInsert = "INSERT INTO tblChat (fiPlayer, dtMessage, dtTimestamp)
		                VALUES (?,?,?)";

    /*sends queryframe to the database */
    $statement = $dbc->prepare($queryInsert);

    /*sets type for parameters and transfers variables*/
    $statement->bind_param('iss', $userIDtoInt, $text, $currentTimestamp);

    /*executes the query*/
    $statement->execute();

    /*closes database connection*/
    $statement->close();
    echo json_encode(["errorCode" => "success!"]);

}
