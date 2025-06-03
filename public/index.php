<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tải config.php trước
require_once dirname(__DIR__) . '/app/config/config.php';

require_once APP_ROOT . '/app/controllers/HomeController.php';
require_once APP_ROOT . '/app/controllers/EmployeeController.php';
require_once APP_ROOT . '/app/libs/DbConnection.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$homeController = new HomeController();
$employeeController = new EmployeeController();

if ($controller == 'home' && $action == 'index') {
    $homeController->index();
} elseif ($controller == 'home' && $action == 'store') {
    $employeeController->store();
} elseif ($controller == 'addEmployee') {
    $employeeController->add();
} elseif ($controller == 'editEmployee') {
    $employeeController->edit($id);
} elseif ($controller == 'deleteEmployee' && $action == 'destroy') {
    $employeeController->destroy($id);
} elseif ($controller == 'deleteEmployee' && $action == 'delete') {
    $employeeController->delete($id);
} elseif ($controller == 'editEmployee' && $action == 'update') {
    $employeeController->update($id);
} else {
    die("Invalid controller or action.");
}
?>