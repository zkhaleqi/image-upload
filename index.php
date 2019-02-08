<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Image Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
        crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>

<body>
    <?php
        if(isset($_FILES['userfile'])) {
            
            $phpFileUploadErrors = array(
                0 => 'There is no error, the file uploaded successfully.',
                1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                2 => 'The uploaded file exceeeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                3 => 'the uploaded file was only partially uploaded',
                4 => 'No file was uploaded',
                6 => 'Missing a temporary folder',
                7 => 'Failed to write file to disk',
                8 => 'A PHP extension stopped the file upload'
            );

            $extension_error = false;
            // A list of allowed extensions
            $extensions = array('jpg', 'jpeg', 'gif', 'png');
            $file_extension = explode('.', $_FILES['userfile']['name']);
            $file_extension = end($file_extension);

            if(!in_array($file_extension, $extensions)) {
                $extension_error = true;
            }

            if($_FILES['userfile']['error']) {
                echo "<div class='alert alert-danger'>". $phpFileUploadErrors[$_FILES['userfile']['error']]. "</div>";
            }
            elseif ($extension_error) {
                echo "<div class='alert alert-danger'>Invalid file extension.</div>";
            }
            else {
                echo "<div class='alert alert-success'>success! file has been uploaded.</div>";
            }

            $destination = 'images/'. $_FILES['userfile']['name'];
            move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
        }
    ?>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" id="exampleInputFile" name="userfile">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</body>

</html>