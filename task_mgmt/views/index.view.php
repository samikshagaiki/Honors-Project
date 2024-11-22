<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
</head>
<link rel="stylesheet" href="/pico.min.css">
<body>
    <header class="container">
        <nav>
            <h3>To add tasks to the database ---> </h3>
            <ul>
                <li><a href="add.php">Add Tasks</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>My Tasks</h1>

        <table>
            <tr>        
                <th>#</th>
                <th>Title</th>
                <th>Due Date</th>
                <th>Is Completed</th>
            </tr>
            <?php foreach ($rows as $row) : ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["title"]; ?></td>
                <td>
                    <?php
                    $date = $row["due_date"];

                    if (!empty($date)) {
                        $dateObject = new DateTime($date);
                        $formattedDate = $dateObject->format('d F Y');
                    } else {
                        $formattedDate = ""; 
                    }

                    echo $formattedDate;
                    ?>
                </td>
                <td>
                    <?php
                    $booleanValue = $row["is_completed"]; // or 0
                    echo $booleanValue ? "Yes" : "No";
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
