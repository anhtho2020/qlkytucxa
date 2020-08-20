    <html>
    <head><title>S.A.M</title>
        <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
        <script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            body
            {
            background-image:url(Air-Gear%20Danalm.jpg);
            background-position:center;
            background-repeat:no-repeat;
            background-color:#FFF;
            }
            #sprytextfield1 label
            {
            font-size: 14px;
            font-family: "Franklin Gothic Book";
            color:#F30;
            }
            #sprypassword1 label
            {
            font-size: 14px;
            font-family: "Franklin Gothic Book";
            color:#F30;
            }
        </style>
    </head>
    <body>
    <form name="form1" method="post" action="ktdangnhap.php">
    <table align="center" cellpadding="5" cellspacing="5">
        <tr>
            <td align="center">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <span id="sprytextfield1">
                <label for="user_name">Tên đăng nhập:</label>
                <input type="text" name="user_name" id="user_name">
                <span class="textfieldRequiredMsg">Username is required.</span></span>
                <span id="sprypassword1">
                <label for="user_pword">Nhập mật khẩu :</label>
                <input type="password" name="user_pword" id="user_pword">
                <span class="passwordRequiredMsg">Password is required.</span></span>
            </td>
        </tr>
        <tr>
        <td align="center">
        <input type="submit" name="login" value="Login">
        </td>
        </tr>
    </table>
    </form>
    </body>
    <script type="text/javascript">
    var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
    </script>
    <script type="text/javascript">
    var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
    </script>
    </html>