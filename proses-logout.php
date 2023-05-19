<!DOCTYPE html>
<html>
    <head>
        <title>Dialog Confirm</title>
    </head>
    <body>
    <script>
        var yakin = confirm("Apakah kamu yakin ingin keluar?");

        if (yakin) {
            window.location = "logout.php";
        } else {
            
        }
    </script>
    </body>
</html>