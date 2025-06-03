<!DOCTYPE html>
<html>

<head>
    <title>Delete Employee</title>
</head>

<body>
    <h2>Delete Employee</h2>
    <?php if (isset($employee)): ?>
    <form action="?controller=deleteEmployee&action=delete&id=<?php echo htmlspecialchars($employee->getID()); ?>"
        method="POST">
        <div>
            <label>Id</label>
            <input type="text" value="<?php echo htmlspecialchars($employee->getID()); ?>" readonly>
        </div>
        <div>
            <label>Full Name</label>
            <input type="text" value="<?php echo htmlspecialchars($employee->getName()); ?>" readonly>
        </div>
        <div>
            <label>Birthday</label>
            <input type="text" value="<?php echo htmlspecialchars($employee->getBirthday()); ?>" readonly>
        </div>
        <div>
            <label>Room</label>
            <input type="text" value="<?php
                    $employeeService = new EmployeeService();
                    $rooms = $employeeService->getAllRooms();
                    foreach ($rooms as $room) {
                        if ($room->getRoomID() == $employee->getRoomID()) {
                            echo htmlspecialchars($room->getRoomName());
                            break;
                        }
                    }
                ?>" readonly>
        </div>
        <div>
            <p>Are you sure you want to delete this employee?</p>
            <input type="submit" name="btn_delete" value="Delete">
            <a href="?controller=home">Cancel</a>
        </div>
    </form>
    <?php else: ?>
    <p>No employee data found.</p>
    <?php endif; ?>
</body>

</html>