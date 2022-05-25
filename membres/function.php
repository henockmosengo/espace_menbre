<?php
    function debug($variable){
        echo '<pre>'.print_r($variable,true).'</pre>';
    }
    function str_random($length){
        $alphabe="0123456789azertyuiopqsdfghjklmxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabe,$length)),0,$length);
    }