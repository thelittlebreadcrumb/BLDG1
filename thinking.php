function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException('$dirPath must be a directory');
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';                                                            // so far, it's just checking and adding a / at the end of the path (if it didn't already exist)
    }
    $files = glob($dirPath . '*', GLOB_MARK);                                       // here, it's listing all the files in the directory and ending the directory with /. Simliar to ^. 
    foreach ($files as $file) {                                                     // starting a loop to check individual files.
        if (is_dir($file)) {
            deleteDir($file);                                                       // if the directory holds a file, delete it. still confused
        } else {
            unlink($file);                                                          // if the directory holds a file, delete it. still confused
        }
    }
    rmdir($dirPath);                                                                // delete the directory.
}   

function remove_dir($album_id)
    {
        $album_id = (int)$album_id;
        if (is_dir('uploads/'.$album_id))
        $dir_handle = opendir('uploads/'.$album_id);
        if (!$dir_handle)
        return false;
        while($file = readdir($dir_handle)) {
            if ($file != '.' && $file != '..') {
                if (!is_dir('uploads/'.$album_id.'/'.$file))
                unlink('uploads/'.$album_id.'/'.$file);
                else
                {
                    $a='uploads/'.$album_id.'/'.$file;
                    removedir($a);
                }
            }
        }
        closedir($dir_handle);
        rmdir('uploads/'.$album_id);
        return true;
    }


function remove_dir_thumbs($album_id)
    {
        $album_id = (int)$album_id;
        if (is_dir('uploads/thumbs/'.$album_id))
        $dir_handle = opendir('uploads/thumbs/'.$album_id);
        if (!$dir_handle)
        return false;
        while($file = readdir($dir_handle)) {
            if ($file != '.' && $file != '..') {
                if (!is_dir('uploads/thumbs/'.$album_id.'/'.$file))
                unlink('uploads/thumbs/'.$album_id.'/'.$file);
                else
                {
                    $a='uploads/thumbs/'.$album_id.'/'.$file;
                    removedir($a);
                }
            }
        }
        closedir($dir_handle);
        rmdir('uploads/thumbs/'.$album_id);
        return true;
}