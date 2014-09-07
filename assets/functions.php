<?php

    function encodeJSON ($file, $json) {
        $fp = fopen ($file, "w+");
        fwrite ($fp, json_encode ($json, 128));
        fclose ($fp);
    }
    
    function decodeJSON ($file) {
        $json = file_get_contents($file);
        $json = json_decode($json, true);
        return $json;
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