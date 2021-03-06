<?php

    function formatDate ($date) { //year-month-day hour:min:sec to day month (year if not current year) hour:min
        $year = substr($date, 0, strpos($date, "-"));
        $date = substr($date, strpos($date, "-")+1);
        $month = substr($date, 0, strpos($date, "-"));
        $date = substr($date, strpos($date, "-")+1);
        $day = substr($date, 0, 2);
        $date = substr($date, 3);
        $hour = substr($date, 0, 2);
        $date = substr($date, 3);
        $min = substr($date, 0, 2);
        $dateObj = DateTime::createFromFormat('!m', $month);
        $month = $dateObj->format('F');
        $h = $hour > 12 ? $hour-12 : $hour;
        echo $day." ".$month." ".$h.":".$min;
        if ($hour >= 12) echo " PM";
        else echo " AM";
    }
    
    function formatDate2 ($date) { //year-month-day to month - day - year
        $year = substr($date, 0, strpos($date, "-"));
        $date = substr($date, strpos($date, "-")+1);
        $month = substr($date, 0, strpos($date, "-"));
        $date = substr($date, strpos($date, "-")+1);
        $day = substr($date, 0, 2);
        echo $month." - ".$day." - ".$year;
    }

    function test_input($data) { //validate input (standard)
        $data = trim($data); //trim spaces off
        $data = stripslashes($data); //strip slashes off
        $data = htmlspecialchars($data); //turn potentially harmful characters into safe ones
        return $data; //return
    }
    
    function echoInput ($object, $property) {
        if (!empty($object->$property)) echo $object->$property; 
        elseif (!empty($_POST[$property])) echo $_POST[$property];
    }
    
    function printPost ($index) {
        if (!empty($_POST[$index]))
            echo $_POST[$index];
    }
    
    function printNE ($data) {
        if (!empty($data))
            echo $data;
    }

    function getLastKey ($array) { //gets the last key of an array
        end($array);
        return key($array);
    }

    function delete ($key, &$array) { //deletes from an array using key
        $last = getLastKey($array);
        $array[$key] = $array[$last];
        unset($array[$last]);
    }

    function saveFile ($filename, $destination) { //saves the specified filename from $_FILES into specified destination path
        if (!file_exists($destination)) {
            mkdir ($destination);
        }
        move_uploaded_file($_FILES[$filename]["tmp_name"], $destination."/".$_FILES[$filename]["name"]);
        return $destination."/".$_FILES[$filename]["name"];
    }

    function deleteFile ($filename) { //deletes a file by filename/path
        chmod ($filename, 0777);
        unlink($filename);
    }
    
    function deleteFolder ($dir) { //deletes a folder by directory (and all its contents)
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!deleteFolder($dir . "/" . $item)) {
                return false;
            }
        }

        return rmdir ($dir);
    }

?>
    <script type="text/javascript">
        function redirect (url) { //redirects the window to the specified URL
            window.location = url;
        }
        
        function deleteFn (url) {
            if (url.indexOf("unFriend") > -1) {
                if (confirm('Are you sure you want to unfriend this person?')) {
                    window.location.href=url;
                }
            } else {
                if(confirm('Are you sure you want to delete?')) {
                    window.location.href=url;
                }
            }
        }
    </script>
