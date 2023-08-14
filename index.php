<?php
include 'func.inc.php';

if (isset($_GET['code']) && !empty($_GET['code'])) {
    $code = $_GET['code'];
    redirect($code);
    die();
}
?>
<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript">
        $(document)
                .ready(function() {
            $('$url').focus();
        });


        function go(url) {
            $.post('url.php', {url: url}, function(data) {
                if (data == 'error_no_url') {
                    $('#message').html('<p>No URL specified</p>');
                }
                else if (data == 'error_invalid_url') {
                    $('#message').html('<p>Not a valid URL</p>');
                }
                else if (data == 'error_is_min') {
                    $('#message').html('<p>Already shortened</p>');
                } else {
                    $('#url').val(data);
                    $('#url').select();
                    $('#message').html('<p>Sucessfully shortened your URL</p>');

                }
            });
        }
    </script>
</head>
<body>
    <div id="container">
        <h1>It's a simple. It's short. It's min.bz</h1>
        <p>Go ahead, enter a long URL and have ot shortened</p>
        <p><input type="text" name="url" id="url" size="60" onkeydown="if (event.keyCode == 13 || event.which == 13) {
                go($('#url').val());
            }"><input type="button" value="Shorten" onclick="go($('#url').val())"></p>
        <div id="message"><p>&nbsp;</p></div>
        <div id="copyright">Brought to you by <a href="">Phpacademy</a></div>
    </div>
</body>
</html>
