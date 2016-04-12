# pico_mail
Sipmle plugin to access send email using jquery via PHP
##Requirements
    "jquery": "~1.12.0"
##Usage
    <form action="#" id="myform" method="post">
        <input type="text" hidden name="project_name" value="test"> <-- Requied -->
        <input type="text" hidden name="admin_email" value="test@test.com"> <-- Requied -->
        <input type="text" hidden name="form_subject" value="test_form"> <-- Requied -->
        <input type="submit" value="SEND">
    </form>

    <script>
        $('#myform').pico_mail('path-to-mail.php');
    </script>

