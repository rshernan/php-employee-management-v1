<?php
require_once("./employeeManager.php");

function addEmployee()
{
    try {
        $employee_array = getQueryStringParameters();
        $employee_array["id"] = getNextIdentifier();
        add($employee_array);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

function updateEmployee()
{
    try {
        update(getQueryStringParameters());
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

function deleteEmployee()
{
    try {
        delete(getQueryStringParameters()['id']);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

function getEmloyee()
{
    try {
        echo getEmloyee(getQueryStringParameters()['id']);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

function getAllEmployees()
{
    try {
        //header('Content-Type: application/json');
        echo getAll();
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

function getQueryStringParameters(): array
{
    parse_str(file_get_contents('php://input'), $query);
    return $query;
}

switch ($_SERVER['REQUEST_METHOD']) {
    case "DELETE":
        deleteEmployee();
        break;
    case "POST":
        addEmployee();
        break;
    case "PUT":
        updateEmployee();
        break;
    case "GET":
        if (isset($_REQUEST['id'])) {
            getEmloyee();
        } else {
            getAllEmployees();
        }
        break;
}
