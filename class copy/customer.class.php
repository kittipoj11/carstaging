<?php
require_once  'myPdo.class.php';

// namespace ropa;

// use ropa\Db;

class Customer extends MyConnection
{
    public function getAllRecord()
    {
        $sql = "select * 
                from tbl_customer
                where is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getCustomerApproveWaiting()
    {
        $sql = "select * 
                from tbl_customer
                where (approved_by is null or length(trim(approved_by)) = 0)
                and is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getCustomerApproveOnly()
    {
        $sql = "select * 
                from tbl_customer
                where (approved_by is not null and length(trim(approved_by)) > 0)
                and is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRecordByUsername($username)
    {
        $sql = "select username, password, firstname, lastname, line_id, line_user_id, address, phone, email
                , c.role_id, register_datetime, approved_by, approved_datetime
                , c.create_by, c.create_datetime, c.update_by, c.update_datetime
                , role_name
                from tbl_customer c
                left join tbl_role r
                    on c.role_id = r.role_id
                where username = :username";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();


        return $rs;
    }

    public function getLineUserID($username)
    {
        $sql = "select line_user_id 
                from tbl_customer 
                where username = :username";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        $line_user_id = $rs['line_user_id'];
        $_SESSION['line_user_id'] = $line_user_id;
        return $line_user_id;
        // Access Token
        // $access_token = 'YBLP1o7Mja/UVL5/nNR9ndhTlEvNjSHZdh27gnsW3C6qiUC3f/hjyi23RQ+FXkVknJzQ/YdlQMBTWpAb+uDEBfMySpZANPryRKqjAXieMbcKpVvFS8lsVZVROGj3KMqbVrRUgzlm/cc2+GmvbaQWeQdB04t89/1O/w1cDnyilFU=';
        // // User ID
        // // $userId = 'U7a2c24d345d2667c442c95c3a34ba241';
        // // $userId = 'U749f9114c302b60d04acdfcf8e430d1f';
        // $user_id = $rs['userid'];
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

    public function register($getData)
    {

        $username = $getData['username'];
        $password = $getData['enter_password'];
        $firstname = $getData['firstname'];
        $lastname = $getData['lastname'];
        $line_id = '';
        $line_user_id = ''; //$getData['line_user_id'];
        $role_id = 'member'; //$getData['role_id'];
        $address = '';
        $phone = '';
        $email = '';
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_customer(username, password, firstname, lastname, line_id, line_user_id, role_id, address, phone, email) 
                values(:username, :password, :firstname, :lastname, :line_id, :line_user_id, :role_id, :address, :phone, :email)";
        $stmt = $this->myPdo->prepare($sql);
        // $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':line_id', $line_id, PDO::PARAM_STR);
        $stmt->bindParam(':line_user_id', $line_user_id, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        // $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
        // $affected = $stmt->execute();

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been created successfully.';
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
            return false;
        }
    }
    public function insertData($getData)
    {

        $username = $getData['username'];
        $password = $getData['enter_password'];
        $firstname = $getData['firstname'];
        $lastname = $getData['lastname'];
        $line_id = $getData['line_id'];
        $line_user_id = ''; //$getData['line_user_id'];
        $role_id = 'member'; //$getData['role_id'];
        $address = $getData['address'];
        $phone = $getData['phone'];
        $email = $getData['email'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_customer(username, password, firstname, lastname, line_id, line_user_id, role_id, address, phone, email) 
                values(:username, :password, :firstname, :lastname, :line_id, :line_user_id, :role_id, :address, :phone, :email)";
        $stmt = $this->myPdo->prepare($sql);
        // $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':line_id', $line_id, PDO::PARAM_STR);
        $stmt->bindParam(':line_user_id', $line_user_id, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        // $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
        // $affected = $stmt->execute();

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been created successfully.';
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
            return false;
        }
    }

    public function insertDataFromLine($getProfile, $getProfile2)
    {
        $_SESSION['name'] = $getProfile->name;
        $username = $getProfile2->userId;
        $password = '';
        $firstname = $getProfile->name;
        $lastname = $getProfile->name;
        $line_id = '';
        $line_user_id = $getProfile2->userId;
        $role_id = 'member'; //$getProfile['role_id'];
        $address = '';
        $phone = '';
        $email = $getProfile->email;
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_customer(username, password, firstname, lastname, line_id, line_user_id, role_id, address, phone, email) 
                values(:username, :password, :firstname, :lastname, :line_id, :line_user_id, :role_id, :address, :phone, :email)";
        $stmt = $this->myPdo->prepare($sql);
        // $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':line_id', $line_id, PDO::PARAM_STR);
        $stmt->bindParam(':line_user_id', $line_user_id, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
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
        // $password = $getData['password'];
        $firstname = $getData['firstname'];
        $lastname = $getData['lastname'];
        // $line_id = $getData['line_id'];
        // $line_user_id = $getData['line_user_id'];
        $role_id = 'member'; //$getData['role_id'];
        $address = $getData['address'];
        $phone = $getData['phone'];
        $email = $getData['email'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_customer 
                set firstname = :firstname
                , lastname = :lastname
                , address = :address
                , role_id = :role_id
                , address = :address
                , phone = :phone
                , email = :email
                where username = :username";
        // , password = :password
        // , line_id = :line_id
        // , line_user_id =line_ :us_erid
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        // $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        // $stmt->bindParam(':line_id', $line_id, PDO::PARAM_STR);
        // $stmt->bindParam(':line_user_id', $line_user_id, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
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
    public function updateDataFromLine($getProfile2)
    {
        $username = $_SESSION['username'];
        $_SESSION['usernameinupdate'] = $username;
        $line_user_id = $getProfile2->userId;
        $sql = "update tbl_customer 
                set line_user_id = :line_user_id
                where username = :username";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':line_user_id', $line_user_id, PDO::PARAM_STR);
        // $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);

        try {
            if ($stmt->execute()) {
                $_SESSION['message-line'] =  "{$username} add line successfully.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message-line'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message-line'] =  'Something is wrong.Can not add data.';
            }
        }
    }

    public function updateLineUserId($line_user_id)
    {
        // $line_user_id = $getData['line_user_id'];
        $username = $_SESSION['username'];
        $sql = "update tbl_customer 
                set line_user_id = :line_user_id
                where username = :username
                ";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':line_user_id', $line_user_id, PDO::PARAM_STR);

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'Add line successfully.';
            }
        } catch (PDOException $e) {
            $_SESSION['message'] =  'Error >>> code={$e->getCode()}: {$e->getMessage()}';
        }
    }

    public function changePassword($getData)
    {
        $username = $getData['username'];
        $password = $getData['password'];

        $sql = "update tbl_customer 
                set password = :password
                where username = :username";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

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

    public function updateApprovedBy($getData)
    {
        session_start();
        // print_r($_SESSION);
        // exit();
        $username = $getData['username'];
        $approved_by = $_SESSION['username'];
        $sql = "update tbl_customer 
                set approved_by = :approved_by
                , approved_datetime = NOW()
                where username = :username";
        // , password = :password
        // , line_id = :line_id
        // , line_user_id =line_ :us_erid
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':approved_by', $approved_by, PDO::PARAM_STR);

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
        $sql = "update tbl_customer 
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
        // print_r($getData);
        // exit;
        $username = $getData['username'];
        $password = $getData['password'];
        $sql = "select username, password, firstname, lastname, line_id, line_user_id, address, phone, email
                , c.role_id, register_datetime, approved_by, approved_datetime
                , c.create_by, c.create_datetime, c.update_by, c.update_datetime
                , role_name
                from tbl_customer c
                left join tbl_role r
                    on c.role_id = r.role_id
                where username = :username";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        @session_start();
        $_SESSION = [];
        if ($password == $rs[0]['password']) {
            $_SESSION['username'] = $rs[0]['username'];
            $_SESSION['password'] = $rs[0]['password'];
            $_SESSION['firstname'] = $rs[0]['firstname'];
            $_SESSION['lastname'] = $rs[0]['lastname'];
            $_SESSION['line_id'] = $rs[0]['line_id'];
            $_SESSION['line_user_id'] = $rs[0]['line_user_id'];
            $_SESSION['role_id'] = $rs[0]['role_id'];
            $_SESSION['role_name'] = $rs[0]['role_name'];
            $_SESSION['address'] = $rs[0]['address'];
            $_SESSION['phone'] = $rs[0]['phone'];
            $_SESSION['email'] = $rs[0]['email'];

            $_SESSION['login_status'] = true;
            return true;
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['login_status'] = false;
            return false;
        }
    }

    public function keepCustomerSession($getData)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        $_SESSION['username'] = $getData[0]['username'];
        $_SESSION['password'] = $getData[0]['password'];
        $_SESSION['firstname'] = $getData[0]['firstname'];
        $_SESSION['lastname'] = $getData[0]['lastname'];
        $_SESSION['line_id'] = $getData[0]['line_id'];
        $_SESSION['line_user_id'] = $getData[0]['line_user_id'];
        $_SESSION['role_id'] = $getData[0]['role_id'];
        $_SESSION['role_name'] = $getData[0]['role_name'];
        $_SESSION['address'] = $getData[0]['address'];
        $_SESSION['phone'] = $getData[0]['phone'];
        $_SESSION['email'] = $getData[0]['email'];
    }


    public function getBooking($getData)
    {
        $username = $getData['username'];
        $sql = "select * 
                from tbl_booking
                where username = :username
                order by booking_date, booking_time";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
}
