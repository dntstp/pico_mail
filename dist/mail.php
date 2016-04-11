<?php
function debug($variable){
    file_put_contents('debug.txt', var_export($variable, true));
}
function adopt($text)
{
    return '=?UTF-8?B?' . base64_encode($text) . '?=';
}

function safe($val)
{
    return htmlspecialchars(trim($val));
}

function get_message()
{
    $message = array();
    $project_name = safe($_GET["project_name"]);
    $message['email']= safe($_GET["admin_email"]);
    $message['subject'] = safe($_GET["form_subject"]);
    $message['headers'] = "MIME-Version: 1.0" . PHP_EOL .
        "Content-Type: text/html; charset=utf-8" . PHP_EOL .
        'From: ' . adopt($project_name) . ' <' . $message['email'] . '>' . PHP_EOL .
        'Reply-To: ' .$message['email']  . PHP_EOL;

    $message["text"] = "<table style='width: 100%;'>";
    foreach ($_GET as $key => $value) {
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

try {
    $message = get_message();

    mail($message['email'], $message['subject'], $message['text'], $message['headers']);

} catch (Exception $e) {
    error_log($e->getMessage(), 0, 'error.txt');

}