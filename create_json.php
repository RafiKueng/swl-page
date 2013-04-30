<?php
header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="default-filename.txt"');

echo json_encode($_POST);

?>
