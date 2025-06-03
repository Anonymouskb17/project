<?php 
require_once APP_ROOT . '/app/libs/DbConnection.php';
require_once APP_ROOT . '/app/models/Employee.php';
require_once APP_ROOT . '/app/models/Room.php';

class EmployeeService {
    public function getAllEmployee() {
        $employees = [];
        $dbConnection = new DBConnection();
        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();
            if ($conn != null) {
                $sql = "SELECT * FROM nhanvien";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch()) {
                    $employee = new Employee($row['id'], $row['name'], $row['birthday'], $row['roomid']);
                    $employees[] = $employee;
                }
            }
        }
        return $employees;
    }

public function addEmployee(Employee $employee) {
    $dbConnection = new DBConnection();
    $conn = $dbConnection->getConnection();
    if ($conn == null) {
        throw new Exception("Không thể kết nối cơ sở dữ liệu.");
    }

    $name = $employee->getName();
    $birthday = $employee->getBirthday();
    $roomid = $employee->getRoomID();

    // Kiểm tra roomid tồn tại trong bảng phong
    $sqlCheckRoom = "SELECT COUNT(*) FROM phong WHERE roomid = :roomid";
    $stmtCheckRoom = $conn->prepare($sqlCheckRoom);
    $stmtCheckRoom->execute([':roomid' => $roomid]);
    try {
        $sql = "INSERT INTO nhanvien (name, birthday, roomid) VALUES (:name, :birthday, :roomid)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':name' => $name, ':birthday' => $birthday, ':roomid' => $roomid]);
        return $conn->lastInsertId(); // Trả về ID của bản ghi vừa thêm
    } catch (PDOException $e) {
        throw new Exception(  $e->getMessage());
    }
}

    public function getEmployeeById($id) {
        $dbConnection = new DBConnection();
        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();
            if ($conn != null) {
                $sql = "SELECT * FROM nhanvien WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id' => $id]);
                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();
                    return new Employee($row['id'], $row['name'], $row['birthday'], $row['roomid']);
                }
            }
        }
        return null;
    }

    public function updateEmployee(Employee $employee) {
        $dbConnection = new DBConnection();
        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();
            if ($conn != null) {
                $id = $employee->getID();
                $name = $employee->getName();
                $birthday = $employee->getBirthday();
                $roomid = $employee->getRoomID();
                $sql = "UPDATE nhanvien SET name = :name, birthday = :birthday, roomid = :roomid WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':name' => $name, ':birthday' => $birthday, ':roomid' => $roomid, ':id' => $id]);
            }
        }
    }

    public function deleteEmployee(Employee $employee) {
        $this->deleteEmployeeById($employee->getID());
    }

    public function deleteEmployeeById($id) {
        $dbConnection = new DBConnection();
        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();
            if ($conn != null) {
                $sql = "DELETE FROM nhanvien WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id' => $id]);
            }
        }
    }

    public function getAllRooms() {
        $rooms = [];
        $dbConnection = new DBConnection();
        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();
            if ($conn != null) {
                $sql = "SELECT roomid, name FROM phong"; // Sử dụng bảng phong
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch()) {
                    $room = new Room($row['roomid'], $row['name']);
                    $rooms[] = $room;
                }
            }
        }
        return $rooms;
    }
}
?>