<?php
function redirect($_address)
{
    echo '<script type="text/javascript">'.
        'window.location.href = "http://'.$_SERVER['SERVER_NAME'].$_address.'";'.
        '</script>';
}

?>