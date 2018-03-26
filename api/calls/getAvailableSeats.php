<?php

include "../mainUtil.php";
use Database\Database;

$fields = array("screeningId");
$seats = [];

if(checkFields($fields) && checkValidApiKey()) {

    $screeningId = getField($fields[0]);

    $statement = Database::getConnection()->prepare("SELECT * FROM seats WHERE id not in ( SELECT seatId FROM `tickets` JOIN ( SELECT id FROM `reservations` WHERE screeningId = ?) as reservations ON tickets.reservationId = reservations.id);");
    $statement->bindValue(1, $screeningId, Database::PARAM_STR);

    try
    {
        $statement->execute();
    }
    catch (\Exception $e)
    {
        return false;
    }

    $result = $statement->fetchAll();

    for ($i = 0; $i < count($result); $i++) {
        array_push($seats, array(
            "id" => $result[$i]["id"],
            "theatherId" => $result[$i]["theatherId"],
            "seatNumber" => $result[$i]["seatNumber"],
            "rowNumber" => $result[$i]["rowNumber"]
        ));
    }

    echo json_encode($seats);
} else {
    echo "error!";
}