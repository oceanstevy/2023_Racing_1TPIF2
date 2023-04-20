<!--Autor: Christopher Pinetti-->
<!--Hello-->
<?php
require './Functions/Credentials.php';
require './Functions/Functions.php';

$dbc = db_Connect();
/*if get is set*/
if (isset($_GET['executionType'])) {


    /*is get read?*/
//        if ( $_GET[ 'executionType' ] == "read" ) {
//
////            showData($dbc);
//
//        }
    /*is get write?*/
    if ($_GET['executionType'] == "write") {

        /*if both paramaters are set*/
        if (isset($_GET['text'])) {

            insertData($dbc);

        }
    }
}

/*shows the content of the database*/
function showData($dbc)
{
    $queryNewFeed = "SELECT * FROM tblChat";

    $result = mysqli_query($dbc, $queryNewFeed);

    $arrayFeed = array();

    /*checks how many dataset are set */
    for ($count = 0; $count < mysqli_num_rows($result); $count++) {

        /*cuts row by row*/
        $row = mysqli_fetch_assoc($result);

        /*pushes an assotiative array into empty array based on rows*/
        $arrayFeed[] = array(
            "id" => $row['idChat'],
            "Name" => $row['fiPlayer'],
            "Message" => $row['dtMessage'],
            "timestamp" => $row['dtTimestamp']
        );

    }
    /*converts array to json*/
    echo json_encode($arrayFeed);

    /*frees the result and closes db connection*/
    mysqli_free_result($result);
    mysqli_close($dbc);
}

/*gets database connection + name + text out of the get parameter*/
function insertData($dbc)
{
//    echo $dbc . "; " . $name . "; " . $text . "; " . $currentTimestamp;
    $currentTimestamp = date("Y-m-d H:i:s");
    $text = $_GET['text'];
    $name = $_SESSION['user'];

    /*defines insert query with both parameters we want to add*/
    $queryInsert = "INSERT INTO tblChat (fiPlayer, dtMessage, dtTimestamp)
		                VALUES ($name,$text,$currentTimestamp)";

    mysqli_query($dbc, $queryInsert);

    /*sends queryframe to the database */
//    $statement = $dbc->prepare($queryInsert);
//
//    /*sets type for parameters and transfers variables*/
//    $statement->bind_param('sss', $name, $text, $currentTimestamp);
//
//    /*executes the query*/
//    $statement->execute();
//
//    /*closes database connection*/
//    $statement->close();
    echo json_encode(["errorCode" => "success!"]);

}
