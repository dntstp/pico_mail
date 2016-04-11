<?php
function adopt($text) {
    return '=?UTF-8?B?'.base64_encode($text).'?=';
}
function safe($val){
    return htmlspecialchars(stripslashes(trim($val)));
}
try {
    function get_message()
    {
        $message = array();
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $data = $_GET;
        } elseif ($method == 'POST') {
            $data = $_POST;
        } else {
            throw new Exception('$_SERVER[\'REQUEST_METHOD\'] is INVALID');
        }

        $project_name = safe($data["project_name"]);
        $admin_email = safe($data["admin_email"]);
        $form_subject = safe($data["form_subject"]);
        $message['email'] = $admin_email;
        $message['subject'] = $form_subject;
        $message['headers'] = "MIME-Version: 1.0" . PHP_EOL .
            "Content-Type: text/html; charset=utf-8" . PHP_EOL .
            'From: ' . adopt($project_name) . ' <' . $admin_email . '>' . PHP_EOL .
            'Reply-To: ' . $admin_email . '' . PHP_EOL;

        $message["text"] = "<table style='width: 100%;'>";
        foreach ($data as $key => $value) {
            $key = safe($key);
            $value = safe($value);
            if ($value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject") {
                $message["text"] .= "
                    <tr style='background-color: #f8f8f8;'>
                        <td style='padding: 10px; border: #f3f3f3 1px solid;'><b>$key</b></td>
                        <td style='padding: 10px; border: #f3f3f3 1px solid;'>$value</td>
                    </tr>
		        ";
            }
        }
        $message["text"] .= "</table>";
        return $message;
    }

    $message = get_message();
    error_log(var_dump($message), 'error.txt');
    mail($message['email'], $message['subject'], $message['text'], $message['headers']);
}catch (Exception $e) {
    error_log('Exception: ',  $e->getMessage(), "\n", 'error.txt');

}