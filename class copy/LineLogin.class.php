<?php
// require_once '../config.php';
// require APP_PATH . 'class/db.class.php';

class LineLogin
{
    #### change your id
    //'ใส่ Channel ID ของคุณ';
    private const CLIENT_ID = '2001229762';

    //ใส่ Channel secret ของคุณ';
    private const CLIENT_SECRET = '4d2a7d779b15dc76c90234373a62ddcc';

    //'https://เว็บของคุณ.com/callback.php';
    //บน 10.10.1.100 ใช้ nathapat.s11@gmail.com ในการเข้า ngrok --> เปลี่ยนใหม่ทุกครั้งที่มีการปิด ngrok และไปเปลี่ยนบน Line ด้วย
    // private const REDIRECT_URL = 'https://49da-119-46-230-24.ngrok-free.app/_test/booking/callback.php'; 

    //บนเครื่อง Local ใช้ kittipoj1178@gmail.com ในการเข้า ngrok --> เปลี่ยนใหม่ทุกครั้งที่มีการปิด ngrok และไปเปลี่ยนบน Line ด้วย
    private const REDIRECT_URL = 'https://f4e3-119-46-230-13.ngrok-free.app/booking/callback.php';

    private const AUTH_URL = 'https://access.line.me/oauth2/v2.1/authorize';
    private const PROFILE_URL = 'https://api.line.me/v2/profile';
    private const TOKEN_URL = 'https://api.line.me/oauth2/v2.1/token';
    private const REVOKE_URL = 'https://api.line.me/oauth2/v2.1/revoke';
    private const VERIFYTOKEN_URL = 'https://api.line.me/oauth2/v2.1/verify';
    // private const FRIENDSHIP_URL = 'https://api.line.me/friendship/v1/status';
    // private const ADDFRIEND_URL = 'https://api.line.me/friendship/v1/status';
    // curl -v -X GET https://api.line.me/friendship/v1/status \-H 'Authorization: Bearer {access token}'

    function getState()
    {
        // if (session_status() == PHP_SESSION_NONE) {
        //     @session_start();
        // }
        @session_start();
        $state = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);
        $_SESSION['state'] = $state;
        return $state;
    }

    function getLink($getState)
    {
        // if (session_status() == PHP_SESSION_NONE) {
        //     @session_start();
        // }
        @session_start();
        // $state = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);
        $state = $getState;
        $link = self::AUTH_URL . '?response_type=code&client_id=' . self::CLIENT_ID . '&redirect_uri=' . self::REDIRECT_URL . '&scope=profile%20openid%20email&state=' . $_SESSION['state'];
        return $link;
    }
    function getLinkAddFriend($getState)
    {
        // if (session_status() == PHP_SESSION_NONE) {
        //     @session_start();
        // }
        @session_start();
        // $state = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);
        $state = $getState;
        $link = self::AUTH_URL . '?response_type=code&client_id=' . self::CLIENT_ID . '&redirect_uri=' . self::REDIRECT_URL . '&scope=profile%20openid%20email&state=' . $_SESSION['state'];
        return $link;
    }

    function refresh($token)
    {
        $header = ['Content-Type: application/x-www-form-urlencoded'];
        $data = [
            "grant_type" => "refresh_token",
            "refresh_token" => $token,
            "client_id" => self::CLIENT_ID,
            "client_secret" => self::CLIENT_SECRET
        ];

        $response = $this->sendCURL(self::TOKEN_URL, $header, 'POST', $data);
        return json_decode($response);
    }

    function token($code, $state)
    {
        // if (session_status() == PHP_SESSION_NONE) {
        //     @session_start();
        // }
        @session_start();
        $_SESSION['state in token function >>'] = $state;

        if ($_SESSION['state'] != $state) {
            $_SESSION['get state >>'] = $state;
            $_SESSION['session state >>'] = $_SESSION['state'];
            return false;
        }

        $header = ['Content-Type: application/x-www-form-urlencoded'];
        $data = [
            "grant_type" => "authorization_code",
            "code" => $code,
            "redirect_uri" => self::REDIRECT_URL,
            "client_id" => self::CLIENT_ID,
            "client_secret" => self::CLIENT_SECRET
        ];

        $response = $this->sendCURL(self::TOKEN_URL, $header, 'POST', $data);
        return json_decode($response);
    }

    function profileFormIdToken($token = null)
    {
        $payload = explode('.', $token->id_token);
        $ret = array(
            'access_token' => $token->access_token,
            'refresh_token' => $token->refresh_token,
            'name' => '',
            'picture' => '',
            'email' => ''
        );

        if (count($payload) == 3) {
            $data = json_decode(base64_decode($payload[1]));
            if (isset($data->name))
                $ret['name'] = $data->name;

            if (isset($data->picture))
                $ret['picture'] = $data->picture;

            if (isset($data->email))
                $ret['email'] = $data->email;
        }
        return (object) $ret;
    }

    function profile($token)
    {
        $header = ['Authorization: Bearer ' . $token];
        $response = $this->sendCURL(self::PROFILE_URL, $header, 'GET');
        return json_decode($response);
    }

    function verify($token)
    {
        $url = self::VERIFYTOKEN_URL . '?access_token=' . $token;
        $response = $this->sendCURL($url, NULL, 'GET');
        return $response;
    }

    function revoke($token)
    {
        $header = ['Content-Type: application/x-www-form-urlencoded'];
        $data = [
            "access_token" => $token,
            "client_id" => self::CLIENT_ID,
            "client_secret" => self::CLIENT_SECRET
        ];
        $response = $this->sendCURL(self::REVOKE_URL, $header, 'POST', $data);
        return $response;
    }

    private function sendCURL($url, $header, $type, $data = NULL)
    {
        $request = curl_init();

        if ($header != NULL) {
            curl_setopt($request, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);

        if (strtoupper($type) === 'POST') {
            curl_setopt($request, CURLOPT_POST, TRUE);
            curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($request);
        return $response;
    }
}