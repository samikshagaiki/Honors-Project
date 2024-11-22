<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management - Add Task</title>
</head>
<link rel="stylesheet" href="/pico.min.css">
<body>
    <header class="container">
        <form method="post">

            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" placeholder="Enter task title" required>
            
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" required>
            
            <input type="boolean" name="completed" id="completed" required>
            
            <input type="submit" value="Add Task">
        </form>
    </header>
</body>
</html>
