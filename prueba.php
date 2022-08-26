<?php
$text = "asásas";
echo `Texto normal $text`;
echo " \n ";
echo filter_var($text,FILTER_FLAG_EMPTY_STRING_NULL);