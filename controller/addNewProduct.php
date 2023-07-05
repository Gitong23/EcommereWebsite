<?php

    require_once("../model/product/output/product_function.php");
    // require_once("../model/product_attr/output/product_attr_function.php");

    function uploadImg($name)
    {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES[$name]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES[$name]["tmp_name"]);
        if($check !== false) {
            echo "<p class='warning'>File is an image - " . $check["mime"] . ".</p>";
            $uploadOk = 1;
        } 
        else 
        {
            echo "<p class='warning'>File is not an image.</p>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<p class='warning'>Sorry, file already exists.</p>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<p class='warning'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<p class='warning'>Sorry, your file was not uploaded.</p>";
            return "";
            // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {

                return "uploads/".basename($_FILES[$name]["name"]);
                echo "<p class='success'>Upload Success</p>";

            } else {
                echo "<p class='warning'>Sorry, there was an error uploading your file.</p>";

                header("Location: ../views/dashboard/add_new_product.php?return=2");
                exit();
            }
        }
    }

    if(isset($_POST["submit"]))
    {
        $filePath1 = uploadImg("fileUpload1");
        $filePath2 = uploadImg("fileUpload2");
        $filePath3 = uploadImg("fileUpload3");
        $filePath4 = uploadImg("fileUpload4");

        $productName = trim($_POST["product_name"]);
        $catId = intval($_POST['category']);
        $detail = $_POST['detail'];
        $unitPrice = floatval($_POST['unit_price']);

        $attr1 = $_POST['attr_1'];
        $attr2 = $_POST['attr_2'];
        $attr3 = $_POST['attr_3'];
        $attr4 = $_POST['attr_4'];
        $attr5 = $_POST['attr_5'];

        $attr1_stk = $_POST['attr1_stock'];
        $attr2_stk = $_POST['attr2_stock'];
        $attr3_stk = $_POST['attr3_stock'];
        $attr4_stk = $_POST['attr4_stock'];
        $attr5_stk = $_POST['attr5_stock'];

        $lastestProductId = "";
        if(insertNewproduct(0, $catId, $productName, $detail, $unitPrice, $filePath1, $filePath2, $filePath3, $filePath4))
        {
            $lastestProductId = getLastestproductId();
        }
        
        // echo "<br>".$lastestProductId;

        if($attr1 != "")
        {
            insertProduct_attr(0, $lastestProductId, $attr1, $attr1_stk, 0);
        }
        if($attr2 != "")
        {
            insertProduct_attr(0, $lastestProductId, $attr2, $attr2_stk, 0);
        }
        if($attr3 != "")
        {
            insertProduct_attr(0, $lastestProductId, $attr3, $attr3_stk, 0);
        }
        if($attr4 != "")
        {
            insertProduct_attr(0, $lastestProductId, $attr4, $attr4_stk, 0);
        }
        if($attr5 != "")
        {
            insertProduct_attr(0, $lastestProductId, $attr5, $attr5_stk, 0);
        }
        
    }

    header("Location: ../views/dashboard/dashboard.php?return=1");
    exit();

?>