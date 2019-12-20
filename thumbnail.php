<?php
session_start();
$filename = $_SESSION['afterimg'];
                                $percent = 0.5;
                                
                                list($imgwidth, $imgheight) = getimagesize($filename);
                                $newwidth = $imgwidth * $percent;
                                $newheight = $imgheight * $percent;

                                $thumbnail = imagecreatetruecolor($newwidth, $newheight);
                                $source = imagecreatefromjpeg($filename);

                                imagecopyresized($thumbnail, $source, 0, 0, 0, 0, $newwidth, $newheight, $imgwidth, $imgheight);
                                imagejpeg($thumbnail);
                                
?>