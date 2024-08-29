<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to itoffside.com</title>

       
        
    </head>
    <body>

        <div id="container">
            <h1>Welcome to itoffside.com!</h1>

            <div id="body">
                <p>ตัวอย่าง Text editor CKEditor</p>

                <p>รายละเอียดที่อยู่</p>
                <script type="text/javascript" src="Ckeditor/ckeditor.js"></script>
                <textarea style="width:400px;" name="detail" id="detail"></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('detail');
                    function CKupdate() {
                        for (instance in CKEDITOR.instances)
                            CKEDITOR.instances[instance].updateElement();
                    }
                </script>
