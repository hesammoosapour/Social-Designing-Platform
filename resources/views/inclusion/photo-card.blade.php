<?php
$extension_file = pathinfo($media->file_name, PATHINFO_EXTENSION);
$chars_extension_length = strlen($extension_file);
$file_name_without_extension_length = strlen($media->file_name) - strlen($chars_extension_length);
$file_name_without_extension = substr($media->file_name, -$file_name_without_extension_length-1,-$chars_extension_length-1);
$photo_card = $file_name_without_extension."-card.".$extension_file;
?>
