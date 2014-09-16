<?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function getLastKey ($array) {
        end($array);
        return key($array);
    }

    function delete ($key, &$array) {
        $last = getLastKey($array);
        $array[$key] = $array[$last];
        unset($array[$last]);
    }

    function saveFile ($filename, $destination) {
        if (!file_exists($destination)) {
            mkdir ($destination);
        }
        move_uploaded_file($_FILES[$filename]["tmp_name"], $destination."/".$_FILES[$filename]["name"]);
        return $destination."/".$_FILES[$filename]["name"];
    }

    function deleteFile ($filename) {
        chmod ($filename, 0777);
        unlink($filename);
    }
    
    function deleteFolder ($dir) {
      if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
          if ($object != "." && $object != "..") {
            if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
          }
        }
        reset($objects);
        rmdir($dir);
      }
    }












?>