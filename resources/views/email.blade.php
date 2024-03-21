<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task Assigned</title>
</head>

<body>
    <h1>New Task Assigned</h1>

    <p>Hello {{ $user->name }},</p>

    <p>A new task has been assigned to you:</p>

    <p><strong>Title:</strong> {{ $task->name }}</p>
    <p><strong>Description:</strong> {{ $task->status }}</p>
    <p><strong>Due Date:</strong> {{ $task->due_date }}</p>

    <p>Please login to your account to view the details.</p>

    <p>Best regards,</p>
    <p>Your Team</p>
</body>

</html>