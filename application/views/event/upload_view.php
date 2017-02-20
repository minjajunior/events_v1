<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 11/26/2016
 * Time: 2:32 PM
 */?>
<html>
<head>
    <title>Upload Form</title>
</head>
<body>
<?php var_dump($error); ?>
<?php echo form_open_multipart('event/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>
