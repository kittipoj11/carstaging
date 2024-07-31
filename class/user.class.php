<?php
require_once  'myPdo.class.php';

// namespace ropa;

// use ropa\Db;

class User extends MyConnection
{
    public function getAllRecord()
    {
        $sql = "select * 
                from tbl_user u
                left join tbl_department d
                    on u.department_id = d.department_id
                left join tbl_role r
                    on u.role_id = r.role_id
                where u.is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRecordByUsername($username)
    {
        $sql = "select * 
                from tbl_user u
                left join tbl_department d
                    on u.department_id = d.department_id
                left join tbl_role r
                    on u.role_id = r.role_id
                where u.is_deleted = false
                and username = :username";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getLineUserID($username)
    {
        $sql = "select line_user_id 
                from tbl_user 
                where username = :username";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        $user_id = $rs['line_user_id'];
        $_SESSION['line_user_id'] = $user_id;
        return $user_id;
        // Access Token
        // $access_token = 'YBLP1o7Mja/UVL5/nNR9ndhTlEvNjSHZdh27gnsW3C6qiUC3f/hjyi23RQ+FXkVknJzQ/YdlQMBTWpAb+uDEBfMySpZANPryRKqjAXieMbcKpVvFS8lsVZVROGj3KMqbVrRUgzlm/cc2+GmvbaQWeQdB04t89/1O/w1cDnyilFU=';
        // // User ID
        // // $userId = 'U7a2c24d345d2667c442c95c3a34ba241';
        // // $userId = 'U749f9114c302b60d04acdfcf8e430d1f';
        // $user_id = $rs['line_user_id'];
        // // ข้อความที่ต้องการส่ง
        // $messages = array(
        //     'type' => 'text',
        //     'text' => 'ทดสอบการส่งข้อความ...',
        // );
        // $post = json_encode(array(
        //     'to' => array($userId),
        //     'messages' => array($messages),
        // ));
        // // URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
        // $url = 'https://api.line.me/v2/bot/message/multicast';
        // $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // $result = curl_exec($ch);
        // return $result;
    }

    public function insertData($getData)
    {
        $username = $getData['username'];
        $fullname = $getData['fullname'];
        $password = $getData['password'];
        $role_id = $getData['role_id'];
        $department_id = $getData['department_id'];
        $phone = $getData['phone'];
        $email = $getData['email'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_user(username, password, fullname, role_id, department_id, phone, email) 
                values(:username, :password, :fullname, :role_id, :department_id, :phone, :email)";
        $stmt = $this->myPdo->prepare($sql);
        // $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_STR);
        $stmt->bindParam(':department_id', $department_id, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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
        $username = $getData['username'];
        $fullname = $getData['fullname'];
        $password = $getData['password'];
        $role_id = $getData['role_id'];
        $department_id = $getData['department_id'];
        $phone = $getData['phone'];
        $email = $getData['email'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_user 
                set fullname = :fullname
                , password = :password
                , role_id = :role_id
                , department_id = :department_id
                , phone = :phone
                , email = :email
                , update_datetime = CURRENT_TIMESTAMP()
                where username = :username";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_STR);
        $stmt->bindParam(':department_id', $department_id, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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
        $username = $getData['delete_id'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_user 
                set is_deleted = 1
                where username = :username";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

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

    public function checkLogin($getData)
    {
        // print_r($_REQUEST);
        // exit;
        $username = $getData['username'];
        $password = $getData['password'];
        $sql = "select * 
                from tbl_user u
                left join tbl_department d
                    on u.department_id = d.department_id
                left join tbl_role r
                    on u.role_id = r.role_id
                where u.is_deleted = false
                and username = :username";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        // @session_start();
        $_SESSION = [];
        if ($password == $rs[0]['password']) {
            $_SESSION['username'] = $rs[0]['username'];
            $_SESSION['password'] = $rs[0]['password'];
            $_SESSION['fullname'] = $rs[0]['fullname'];
            $_SESSION['role_id'] = $rs[0]['role_id'];
            $_SESSION['role_name'] = $rs[0]['role_name'];
            $_SESSION['department_id'] = $rs[0]['department_id'];
            $_SESSION['department_name'] = $rs[0]['department_name'];
            $_SESSION['phone'] = $rs[0]['phone'];
            $_SESSION['email'] = $rs[0]['email'];
            $_SESSION['line_user_id'] = $rs[0]['line_user_id'];
            $_SESSION['line_id'] = $rs[0]['line_id'];

            $_SESSION['login_status'] = true;
            return true;
        } else {
            $_SESSION['login_status'] = false;
            return false;
        }
    }
}
