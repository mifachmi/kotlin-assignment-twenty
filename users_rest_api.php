<?php
require_once "connection.php";

if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function get_all_users()
{
    global $connect;
    $query = $connect->query("SELECT * FROM users");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }

    $response = array(
        'status' => 1,
        'message' => 'get data succeed',
        'data' => $data
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}

function get_user_with_id()
{
    global $connect;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    $query = "SELECT * FROM users WHERE id = $id";
    $result = $connect->query($query);
    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }

    if ($data) {
        $response = array(
            'status' => 1,
            'message' => 'get data succeed',
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'no data found'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function add_new_user()
{
    global $connect;
    $tableAtribute = array(
        'id' => '',
        'name_user' => '',
        'email_user' => '',
        'photo_user' => ''
    );
    $dataFromUserCheck = count(array_intersect_key($_POST, $tableAtribute));

    if ($dataFromUserCheck == count($tableAtribute)) {
        $query = "INSERT INTO users SET 
                  id = '$_POST[id]',
                  name_user = '$_POST[name_user]',
                  email_user = '$_POST[email_user]',
                  photo_user = '$_POST[photo_user]'";
        $result = mysqli_query($connect, $query);

        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'insert data succeed'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'insert data failed'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'wrong parameter'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_user()
{
    global $connect;

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    $tableAtribute = array(
        'name_user' => '',
        'email_user' => '',
        'photo_user' => ''
    );
    $dataFromUserCheck = count(array_intersect_key($_POST, $tableAtribute));

    if ($dataFromUserCheck == count($tableAtribute)) {
        $query = "UPDATE users SET
                  name_user = '$_POST[name_user]',
                  email_user = '$_POST[email_user]',
                  photo_user = '$_POST[photo_user]' WHERE id = $id";
        $result = mysqli_query($connect, $query);

        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'update data succeed'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'update data failed'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'wrong parameter',
            'data' => $id
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_task()
{
    global $connect;
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($connect, $query)) {
        $response = array(
            'status' => 1,
            'message' => 'delete data with id = ' . $id . ' succeed'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'delete data with id = ' .$id. ' failed'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
