<?php

class Task
{

    public static function add($title)
    {
        $conn = Database::getConnection();

        $result = $conn->prepare("INSERT INTO task (title, list_id) VALUES (:title, 1)");
        $result->bindParam(':title', $title, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getAll()
    {
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM task"); 
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByTaskId($taskId)
    {
        $db = Database::getConnection();

        $result = $db->query("SELECT * FROM task WHERE id = $taskId"); 
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateStatus($taskId, $isDone)
    {
        $db = Database::getConnection();

        $result = $db->prepare("UPDATE task SET is_done = :is_done WHERE id = :id");                                  
        $result->bindParam(':id', $taskId, PDO::PARAM_INT);       
        $result->bindParam(':is_done', $isDone, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function delete($taskId)
    {
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM task WHERE id = :id");
        $result->bindParam(':id', $taskId, PDO::PARAM_INT);
        return $result->execute();
    }

}

?>