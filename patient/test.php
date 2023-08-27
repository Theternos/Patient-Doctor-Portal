<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="../js/jquery-min.js"></script>
    <script src="../js/pdfobject-min.js"></script>

</head>
<style>
    .pdfobject-container {
        height: 900px;
    }

    .pdfobject {
        border: 1px solid #666;
    }
</style>

<body>

    <body>
        <div class="container" style="padding:10px 10px; margin-top:0;">
            <div id="header"></div>
            <div id="pdf_view" class=" pdfobject-container"><embed class="pdfobject" src='<?php echo $file ?>' type="application/pdf" style="overflow: auto; width: 100%; height:70vh;"></div>
            <div id="footer"></div>
        </div>


        <script type="text/javascript">
            $(document).ready(function() {
                var urlParams = new URLSearchParams(window.location.search);
                var pdfFile = urlParams.get('prescription-view');

                if (pdfFile) {
                    PDFObject.embed(pdfFile, "#pdf_view");
                } else {
                    $("#pdf_view").html("PDF file not specified.");
                }
            });
        </script>
    </body>
</body>

</html>