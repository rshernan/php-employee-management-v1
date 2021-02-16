<?php

define("DATABASE_PATH", $_SERVER["DOCUMENT_ROOT"] . "/php-employee-management-v1/resources/employees.json");

function add(array $newEmployee)
{
    try {
        $string  = file_get_contents(DATABASE_PATH);
        $json_array = json_decode($string, true);
        $json_array[] = $newEmployee;
        $encoded_json = json_encode($json_array);
        file_put_contents(DATABASE_PATH, $encoded_json);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}


function delete(string $id)
{
    try {
        $string  = file_get_contents(DATABASE_PATH);
        $json_array = json_decode($string, true);
        foreach ($json_array as $key => $value) {
            if ($value['id'] == $id) {
                array_splice($json_array, $key, 1);
            }
        }
        $encoded_json = json_encode($json_array);
        file_put_contents(DATABASE_PATH, $encoded_json);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}


function update(array $updateEmployee)
{
    try {
        $string  = file_get_contents(DATABASE_PATH);
        $json_array = json_decode($string, true);
        foreach ($json_array as $key => $value) {
            if ($value['id'] == $updateEmployee['id']) {
                array_replace($json_array, array($key => $updateEmployee));
            }
        }
        $encoded_json = json_encode($json_array);
        file_put_contents(DATABASE_PATH, $encoded_json);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

function get(string $id)
{
    try {
        $string  = file_get_contents(DATABASE_PATH);
        $json_array = json_decode($string, true);
        foreach ($json_array as $key => $value) {
            if ($value['id'] == $id) {
                return $value;
            }
        }
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

function getAll()
{
    try {
        $string  = file_get_contents(DATABASE_PATH);
        return $string;
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}


function removeAvatar($id)
{
    // TODO implement it
}

function getNextIdentifier(): int
{
    $string  = file_get_contents(DATABASE_PATH);
    $json_array = json_decode($string, true);
    return intval($json_array[count($json_array) - 1]['id']) + 1;
}
