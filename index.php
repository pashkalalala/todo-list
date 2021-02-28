<?php
    require_once "database.php";
    require_once "task.php";

    $tasks = Task::getAll();

    // var_dump();

    if (isset($_POST['add_submit'])) {
        Task::add($_POST['title']);
        $tasks = Task::getAll();
    }

    if (isset($_POST['save_submit'])) {
        foreach ($tasks as $task) {
            Task::updateStatus($task['id'], 0);
        }

        if (isset($_POST['status'])) {
            foreach ($_POST['status'] as $id => $val) {
                Task::updateStatus($id, 1);
            }
        }

        $tasks = Task::getAll();
    }

    if (isset($_GET['del'])) {
        Task::delete($_GET['del']);
        $tasks = Task::getAll();
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>My TODO List</title>
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>

<main>
    <div class="container">

        <h1 class="h1 title">My TODO List</h1>

        <form action="/" method="post" class="form-add" autocomplete="off">
            <div class="row">
                <div class="col">
                    <input type="text" name="title" class="form-control" value="" placeholder="Add task" required>
                </div>
                <div class="col">
                    <input type="submit" name="add_submit" class="btn-primary btn" value="Add task">
                </div>
            </div>
        </form>
        
        <br>
        <br>

        <form action="" method="post" autocomplete="off">
            <table class="table table-hover">

                <thead class="thead-light">
                    <tr>
                        <th scope="col">Is done</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php foreach ($tasks as $item): ?>
                    <tr>
                        <td> <input type="checkbox" name="status[<?= $item['id'] ?>]"
                            <?php echo $item['is_done']? "value='1' checked" : "value='0'" ?>> </td>

                        <td class="<?php echo $item['is_done']? 'done' : '' ?>"> 
                            <?= $item['title'] ?> 
                        </td>

                        <td class="created-date"> <?= $item['created_at'] ?> </td>
                        <td> <a href="/?del=<?= $item['id'] ?>">Delete</a> </td>
                    </tr>
                <?php endforeach ?>
                </tbody>

            </table>

            <input type="submit" name="save_submit" class="btn btn-success" value="Save">
        </form>
            

        </div>
    
    </div>
</main>

</body>
</html>