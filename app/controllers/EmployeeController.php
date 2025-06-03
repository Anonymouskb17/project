<?php 
require_once APP_ROOT . '/app/services/EmployeeService.php';

class EmployeeController {
    public function add() {
        $employeeService = new EmployeeService();
        $rooms = $employeeService->getAllRooms();
        include_once APP_ROOT . '/app/views/employees/add.php';
    }
    
   public function store() {
    // Kiểm tra dữ liệu từ form
    if (!isset($_POST['name']) || !isset($_POST['birthday']) || !isset($_POST['roomid'])) {
        die("Lỗi: Thiếu dữ liệu từ form (name, birthday, hoặc roomid).");
    }

    $name = trim($_POST['name']);
    $birthday = $_POST['birthday'];
    $roomid = (int)$_POST['roomid'];

    try {
        $employee = new Employee(null, $name, $birthday, $roomid);
        $employeeService = new EmployeeService();
        $employeeService->addEmployee($employee);
        header('Location: ?controller=home');
        exit();
    } catch (Exception $e) {
        die("Lỗi khi thêm nhân viên: " . $e->getMessage());
    }
}

    public function edit($id) {
        if (isset($id)) {
            $employeeService = new EmployeeService();
            $employee = $employeeService->getEmployeeById($id);
            $rooms = $employeeService->getAllRooms();
            include APP_ROOT . '/app/views/employees/edit.php';
        } else {
            echo "ID is null";
        }
    }

    public function update($id) {
        $name = $_POST['name'];
        $birthday = $_POST['birthday'];
        $roomid = $_POST['roomid'];

        $employee_new = new Employee($id, $name, $birthday, $roomid);

        $employeeService = new EmployeeService();
        $employeeService->updateEmployee($employee_new);
        header('Location: ?controller=home');
    }

    public function destroy($id) {
        if (isset($id)) {
            $employeeService = new EmployeeService();
            $employee = $employeeService->getEmployeeById($id);
            include APP_ROOT . '/app/views/employees/delete.php';
        } else {
            echo "ID is null";
        }
    }

    public function delete($id) {
        $employeeService = new EmployeeService();
        $employeeService->deleteEmployeeById($id); // Sử dụng phương thức mới
        header('Location: ?controller=home');
    }
}
?>