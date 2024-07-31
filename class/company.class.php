<?php
require 'db.class.php';

// use Database\Db;

class Company extends Db
{
    public function getAllRecord()
    {
        $sql = "select * 
                from tbl_company 
                where is_deleted = false";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRecordById($id)
    {
        $sql = "select * 
                from tbl_company
                where is_deleted = false
                and company_id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function insertData($getData)
    {
        $company_id = $getData['company_id'];
        $company_name = $getData['company_name'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_company(company_id, company_name) 
                values(:company_id, :company_name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->bindParam(':company_name', $company_name, PDO::PARAM_STR);
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
        $company_id = $getData['company_id'];
        $company_name = $getData['company_name'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_company 
                set company_name = :company_name
                , update_datetime = CURRENT_TIMESTAMP()
                where company_id = :company_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->bindParam(':company_name', $company_name, PDO::PARAM_STR);
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
        $company_id = $getData['delete_id'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_company 
                set is_deleted = 1
                where company_id = :company_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);

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
