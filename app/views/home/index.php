<!DOCTYPE html>
<html>

<head>
    <title>Employee Management</title>
</head>

<body>
    <h2>Employee Management</h2>
    <a href="?controller=addEmployee">Add a new employee</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Birthday</th>
            <th>Room</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if (isset($employees) && is_array($employees) && count($employees) > 0): ?>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo htmlspecialchars($employee->getID()); ?></td>
            <td><?php echo htmlspecialchars($employee->getName()); ?></td>
            <td><?php echo htmlspecialchars($employee->getBirthday()); ?></td>
            <td>
                <?php
                        $employeeService = new EmployeeService();
                        $rooms = $employeeService->getAllRooms();
                        foreach ($rooms as $room) {
                            if ($room->getRoomID() == $employee->getRoomID()) {
                                echo htmlspecialchars($room->getRoomName());
                                break;
                            }
                        }
                        ?>
            </td>
            <td>
                <a
                    href="?controller=editEmployee&action=edit&id=<?php echo htmlspecialchars($employee->getID()); ?>">Edit</a>
            </td>
            <td>
                <a
                    href="?controller=deleteEmployee&action=destroy&id=<?php echo htmlspecialchars($employee->getID()); ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="6">No employees found.</td>
        </tr>
        <?php endif; ?>
    </table>
</body>

</html>