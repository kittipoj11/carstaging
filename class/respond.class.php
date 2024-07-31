<?php
require_once 'config.php';
require  'myPdo.class.php';

// namespace ropa;

// use ropa\Db;

class Respond extends MyConnection
{
    public function getAllRecord()
    {
        $sql = "select * 
                from tbl_respond 
                where is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRecordById($id)
    {
        $sql = "select * 
                from tbl_respond
                where is_deleted = false
                and respond_id = :id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function insertData($getData)
    {
        $respond_name = $getData['respond_name'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_respond(respond_name) 
                values(:respond_name)";
        $stmt = $this->myPdo->prepare($sql);
        // $stmt->bindParam(':respond_id', $respond_id, PDO::PARAM_STR);
        $stmt->bindParam(':respond_name', $respond_name, PDO::PARAM_STR);
        // $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
        // $affected = $stmt->execute();

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been created successfully.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
        }
    }
    public function updateData($getData)
    {
        $respond_id = $getData['respond_id'];
        $respond_name = $getData['respond_name'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_respond 
                set respond_name = :respond_name
                , update_datetime = CURRENT_TIMESTAMP()
                where respond_id = :respond_id";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':respond_id', $respond_id, PDO::PARAM_INT);
        $stmt->bindParam(':respond_name', $respond_name, PDO::PARAM_STR);
        // $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been update successfully.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
        }
    }
    public function deleteData($getData)
    {
        $respond_id = $getData['delete_id'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_respond 
                set is_deleted = 1
                where respond_id = :respond_id";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':respond_id', $respond_id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been delete successfully.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
        }
    }
}

// $stmt = $conn->prepare('select ...where :');
// $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
// $stmt->bindParam(':building_name', $building_name, PDO::PARAM_STR);
// $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
// $stmt->execute();
// $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
