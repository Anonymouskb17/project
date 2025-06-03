<!DOCTYPE html>
<html>

<head>
    <title>Update employee</title>
</head>

<body>
    <h2>Update employee</h2>
    <?php if (isset($employee)): ?>
    <form action="?controller=editEmployee&action=update&id=<?php echo htmlspecialchars($employee->getID()); ?>"
        method="POST">
        <div>
            <label>Full Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($employee->getName()); ?>" required>
        </div>
        <div>
            <label>Birthday</label>
            <input type="date" name="birthday" value="<?php echo htmlspecialchars($employee->getBirthday()); ?>"
                required>
        </div>
        <div>
            <label>Room</label>
            <select name="roomid" required>
                <option value="">Choose room</option>
                <?php if (isset($rooms) && is_array($rooms)): ?>
                <?php foreach ($rooms as $room): ?>
                <option value="<?php echo htmlspecialchars($room->getRoomID()); ?>"
                    <?php echo ($room->getRoomID() == $employee->getRoomID()) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($room->getRoomName()); ?>
                </option>
                <?php endforeach; ?>
                <?php else: ?>
                <option value="">No rooms available</option>
                <?php endif; ?>
            </select>
        </div>
        <div>
            <input type="submit" name="btn_update" value="Update">
        </div>
    </form>
    <?php else: ?>
    <p>No employee data found.</p>
    <?php endif; ?>
</body>

</html>