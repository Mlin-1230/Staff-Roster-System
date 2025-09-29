<?php
    function hasLeave_Event($link, $Id, $date, $Time_Start, $Time_End)
    {
        $sql = "SELECT * FROM leaves WHERE Id = '$Id' AND Date = '$date' AND
            NOT ('$Time_End' <= Leave_Start OR '$Time_Start' >= Leave_End)";
        $result = mysqli_query($link, $sql);
        return (mysqli_num_rows($result) > 0);
    }

    function hasLeave_Train($link, $Id_1, $Id_2, $date, $Time_Start, $Time_End)
    {
        $sql = "SELECT * FROM leaves WHERE
            (Id = '$Id_1' OR Id = '$Id_2') AND Date = '$date' AND
            NOT ('$Time_End' <= Leave_Start OR '$Time_Start' >= Leave_End)";
        $result = mysqli_query($link, $sql);
        return (mysqli_num_rows($result) > 0);
    }

    function cancelEvent($link, $Id, $date, $Leave_Start, $Leave_End)
    {
        $sql = "SELECT Event_Id FROM events WHERE Id = '$Id' AND Date = '$date' AND
            NOT ('$Leave_End' <= Time_Start OR '$Leave_Start' >= Time_End)";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $events_id = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $events_id[] = $row['Event_Id'];
            }

            if (!empty($events_id)) {
                $cancel_event = "DELETE FROM events WHERE Event_Id IN (" . implode(',', $events_id) . ")";
                $cancel_event_result = mysqli_query($link, $cancel_event);

                if ($cancel_event_result) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function cancelTrain($link, $Id, $date, $Leave_Start, $Leave_End)
    {
        $sql = "SELECT Train_Id FROM train WHERE
            (Id_1 = '$Id' OR Id_2 = '$Id') AND Date = '$date' AND
            NOT ('$Leave_End' <= Time_Start OR '$Leave_Start' >= Time_End)";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $trains_id = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $trains_id[] = $row['Train_Id'];
            }

            if (!empty($trains_id)) {
                $cancel_train = "DELETE FROM train WHERE Train_Id IN (" . implode(',', $trains_id) . ")";
                $cancel_train_result = mysqli_query($link, $cancel_train);

                if ($cancel_train_result) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
?>