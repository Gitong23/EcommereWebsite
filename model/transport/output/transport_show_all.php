<?php
    require_once("transport_function.php");
                
                
?>
<html>
    <head>
        <meta charset="UTF-8"/> 
        <title>MM's Bag [transport]</title>
        <script src="jquery-2.1.3.min.js"></script>
        <script>
            $( document ).ready(function() {
                loadTable();
            });
            function loadTable()
            {
                 $("#table").load("transport_show_all_table.php",function(responseTxt,statusTxt,xhr)
		    {
                    });
            }
            function confirm_delete(id)
            {
                var r = confirm("คุณจะลบ id " + id + "จริงๆ เหรอ");
                if (r == true)
                {
                    //window.open("delete_customer.php?id="+id, "_self");
                    //ajax
                    $("#data").load("transport_delete.php?id="+id,function(responseTxt,statusTxt,xhr)
		    {
                        console.log("b");
                        if(statusTxt=="success")
                        {
                            loadTable();
                        }
                        else if(statusTxt=="error")
                        {
                             alert("Error: "+xhr.status+": "+xhr.statusText);
                        }
		    });
                }
                else
                {
                    
                }
            }
        </script>
    </head>
    <body>
            <h1>transport ของเราทั้งหมด</h1>
            <div id="data"></div>
            <div id="table">
                
            </div>
            <br/>
        <a href="index.php">กลับ</a>
    <body>
</html>