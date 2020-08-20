<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Page</title>
<style>
body{
	margin:0px;
	background-image:url(images/headerTile.jpg);
	background-repeat:repeat-x;
	background-position:0px 65px;
}
body, td, div{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px; line-height:14px;
	color:#838486;
	font-weight:bold;
}
input{
	height:20px;
	font-weight:bold;
	text-indent:3px;
}
.titleTop{
	font-size:22px;
	font-weight:bold;
	color:#e2a53c;
}
.infoBoxOuter{
	width:604px;
	background-image:url(images/infoBoxTile.jpg);
	background-repeat:repeat-x;
	background-color:#dedfe1;
	border-right:2px solid #b5b5b7;
	border-bottom:2px solid #b5b5b7;
	padding:6px;
}
.infoBoxInner{
	width:580px;
	background-image:url(images/infoBoxInnerTile.jpg);
	background-repeat:repeat-x;
	background-color:#f2f2f2;
	border-left:2px solid #b5b5b7;
	border-top:2px solid #999a9b;
	border-bottom:1px solid #dadbdc;
	padding:10px;
}
.btnBack{
	cursor:pointer;
	display:inline-block;
	height:30px;
	background-image:url(images/201306/btnTile.jpg);
	background-repeat:repeat-x;
	background-color:#649943;
	border:2px solid #cccfd0;
	color:#FFF;
	text-decoration:none;
	line-height:15px;
	text-align:center;
	font-weight:bold;
	padding-left:16px;
	padding-right:16px;
}
.btnBack:hover{
	background-image:none;
	background-color:#5E9538;
}
.paymentTxt1{
	font-weight:bold;
	color:#333333;
}
.paymentTxt2{
	font-weight:bold;
	font-size:16px;
	color:#e2a53c;
}
.underlineDiv{
	font-size:1px;
	line-height:1px;
	width:100%;
	height:2px;
	background-color:#cecfcf;
	margin-top:10px;
	margin-bottom:-10px;
}
.tableHeader{
	font-weight:bold;
	color:#838486;
	font-size:14px;
}
.tableClass td{
	font-size:14px;
}
form, fieldset{margin:0px;border:none;}

</style>
</head>
<body>
<form action="?" method="post" autocomplete="off" class="payment-form" style="border:none;">
  <fieldset style="border:none;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="65" class="titleTop">Payment Details</td>
  </tr>
  <tr>
    <td height="98" valign="bottom" align="left">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="background-color:#dedfe1; border-right:2px solid #b5b5b7; border-bottom:2px solid #b5b5b7;padding:6px;">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="background-repeat:repeat-x; background-color:#f2f2f2; border-left:2px solid #b5b5b7; border-top:2px solid #999a9b;	border-bottom:1px solid #dadbdc; padding:10px;">
        <table cellpadding="0" cellspacing="0" style="margin-bottom:6px;"><tr><td height="22" valign="top" class="paymentTxt1">
        Payment Reference:
        </td>
          <td width="20" valign="top" class="paymentTxt2">&nbsp;</td>
          <td valign="top" class="paymentTxt2"> __MERCHANT_REF__</td>
        </tr>
		<tr><td class="paymentTxt1">
		  Amount:
		  </td><td class="paymentTxt2">&nbsp;</td>
		  <td class="paymentTxt2"> __AMOUNT__ __CURRENCY__</td>
		  </tr>
		</table>
        <span class="paymentTxt2">__ERROR_MESSAGE__</span>

        </td>
          </tr>
        </table>

    </td>
      </tr>
    </table>


    </td>
  </tr>
  <tr>
    <td height="264" valign="bottom">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="background-color:#e9eaeb;border:2px solid #cecfcf;">


      <table width="100%" border="0" cellspacing="0" cellpadding="14">
        <tr>
          <td width="554" height="20" valign="top" class="tableHeader">
          	CREDIT / DEBIT CARD
            <div class="underlineDiv"></div>
          </td>
        </tr>
        <tr>
          <td><table border="0" cellspacing="0" cellpadding="0" class="tableClass">
            <tr>
              <td width="140">Card Number</td>
              <td width="18">&nbsp;</td>
              <td width="182"><input name="card_number" maxlength="23" size="26" type="text" style="width:180px;"/>&nbsp;</td>
              </tr>
            <tr>
              <td height="55">Expiry Date</td>
              <td>&nbsp;</td>
              <td><input name="exp_month" style="width:30px;" value="MM"/> / <input name="exp_year" style="width:40px;" value="YYYY"/></td>
              </tr>
            <tr>
              <td>Card Security Code</td>
              <td>&nbsp;</td>
              <td><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="80"><input name="cv2_number" style="width:40px;"/></td>
                    <td><img src="images/201306/securityImg.jpg" width="107" height="27" /></td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td height="55">Issue Number</td>
              <td>&nbsp;</td>
              <td><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="80"><input name="issue_number" style="width:40px;"/></td>
                    <td style="font-weight:normal; font-size:12px;">(If Available)</td>
                  </tr>
              </table></td>
              </tr>
            </table></td>
        </tr>
        </table>

    <input value="__SESSION_ID__" name="HPS_SessionID" type="hidden">
    <input value="confirm" name="action" type="hidden">

        </td></tr></table>


    </td>
  </tr>
  <tr>
    <td height="64" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><a href="#"><img src="images/201306/footerLogo.jpg" width="234" height="41" border="0" /></a></td>
          <td align="right"><input type="submit" name="continue" value="Continue" id="continue" class="btnBack"></td>
        </tr>
    </table></td>
  </tr>
</table>
</fieldset>
</form>
</body>
</html>