<?php
header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="'.$_POST['Name'].'.json"');

echo json_encode($_POST);

?>
