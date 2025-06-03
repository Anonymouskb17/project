<!DOCTYPE html>
<html>

<head>
    <title>Add a new employee</title>
</head>

<body>
    <h2>Add a new employee</h2>
    <form action="?controller=home&action=store" method="POST">
        <div>
            <label>Name of employee</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Birthday</label>
            <input type="date" name="birthday" required>
        </div>
        <div>
            <label>Room</label>
            <select name="roomid" required>
                <?php if (isset($rooms) && is_array($rooms) && count($rooms) > 0): ?>
                <?php foreach ($rooms as $room): ?>
                <option value="<?php echo htmlspecialchars($room->getRoomID()); ?>">
                    <?php echo htmlspecialchars($room->getRoomName()); ?>
                </option>
                <?php endforeach; ?>
                <?php else: ?>
                <option value="">No rooms available</option>
                <?php endif; ?>
            </select>
        </div>
        <div>
            <input type="submit" name="btn_create" value="Add">
        </div>
    </form>
</body>

</html>