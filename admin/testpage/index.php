<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>RichText example</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="../resource/richtext/src/richtext.min.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="../resource/richtext/src/jquery.richtext.js"></script>



    </head>
    <body>


        <div class="page-wrapper box-content">

            <textarea class="content" name="example"></textarea>

        </div>

        <script>
        $(document).ready(function() {
            $('.content').richText();
        });
        </script>

    </body>
</html>