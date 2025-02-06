<!DOCTYPE html>
<html>
<head>
<?php require_once ('auth.php');?>
<title>
POS
</title>
 <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
    
      .sidebar-nav {
        padding: 9px 0;
      }

    @page { size: 58mm 50mm }
    body.receipt .sheet { width: 58mm; height: 50mm }
    @media print {
      body.receipt {
         width: 58mm
      } 
    } 
	@page { margin: 0 }
body { margin: 0 }
.sheet {
  margin: 0;
  overflow: hidden;
  position: relative;
  box-sizing: border-box;
  page-break-after: always;
}

/** Paper sizes **/
body.A3               .sheet { width: 297mm; height: 419mm }
body.A3.landscape     .sheet { width: 420mm; height: 296mm }
body.A4               .sheet { width: 210mm; height: 296mm }
body.A4.landscape     .sheet { width: 297mm; height: 209mm }
body.A5               .sheet { width: 148mm; height: 209mm }
body.A5.landscape     .sheet { width: 210mm; height: 147mm }
body.letter           .sheet { width: 216mm; height: 279mm }
body.letter.landscape .sheet { width: 280mm; height: 215mm }
body.legal            .sheet { width: 216mm; height: 356mm }
body.legal.landscape  .sheet { width: 357mm; height: 215mm }

/** Padding area **/
.sheet.padding-10mm { padding: 10mm }
.sheet.padding-15mm { padding: 15mm }
.sheet.padding-20mm { padding: 20mm }
.sheet.padding-25mm { padding: 25mm }

/** For screen preview **/
@media screen {
  body { background: #e0e0e0 }
  .sheet {
    background: white;
    box-shadow: 0 .5mm 2mm rgba(0,0,0,.3);
    margin: 5mm auto;
  }
}

/** Fix for Chrome issue #273306 **/
@media print {
           body.A3.landscape { width: 420mm }
  body.A3, body.A4.landscape { width: 297mm }
  body.A4, body.A5.landscape { width: 210mm }
  body.A5                    { width: 148mm }
  body.letter, body.legal    { width: 216mm }
  body.letter.landscape      { width: 280mm }
  body.legal.landscape       { width: 357mm }
}
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=no,"; 
  disp_setting += "scrollbars=yes,width=800, height=600, left=200, top=25"; 
  var content_value = document.getElementById("content").innerHTML;
  const receipt = document.getElementById("content");
  const contentHeight = receipt.clientHeight;
  receipt.style.height = contentHeight + "px";
  
  var docprint = window.open("", "", disp_setting); 
  docprint.document.open(); 
  docprint.document.write('<html><head><title>Sales Receipt</title>');
  docprint.document.write('<style></style>');
  docprint.document.write('</head><body onLoad="self.print()" style="width: 100%; font-size: 13px; font-family: Arial;">'); 
  docprint.document.write(content_value); 
  docprint.document.close(); 
  docprint.focus(); 
}
</script>

<?php
$invoice=$_GET['invoice'];
include('../connect.php');
$result = $db->prepare("SELECT * FROM sales WHERE invoice_number= :userid");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cname=$row['name'];
$invoice=$row['invoice_number'];
$date=$row['date'];
$cash=$row['due_date'];
$cashier=$row['cashier'];
$pmethod=$row['pmethod'];

$pt=$row['type'];
$am=$row['amount'];
if($pt=='cash'){
$cash=$row['due_date'];
$amount=$cash-$am;
}
}
?>
<?php
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='RS-'.createRandomPassword();
?>



 <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>
<body>

<?php include('navfixed.php');?>
	
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='cashier') {
?>

<div class="container-fluid">
      <div class="row-fluid">
	<div class="span2">
          <div class="well sidebar-nav">
              <ul class="nav nav-list">
              <li><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
			<li class="active"><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i> Sales</a>  </li>             

			<br><br><br><br><br><br>
			<li>
			 <div class="hero-unit-clock">
		
			<form name="clock">
			<font color="white">Time: <br></font>&nbsp;<input style="width:150px;" type="text" class="trans" name="face" value="" disabled>
			</form>
			  </div>
			</li>
				
				</ul>   


<?php
}
if($position=='admin') {
?>
	
<div class="container-fluid">
      <div class="row-fluid">
	<div class="span2">
          <div class="well sidebar-nav">
              <ul class="nav nav-list">
              <li><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
			<li class="active"><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i> Sales</a>  </li>             
			<li><a href="products.php"><i class="icon-list-alt icon-2x"></i> Products</a>                                     </li>
			<li><a href="customer.php"><i class="icon-group icon-2x"></i> Customers</a>                                    </li>
			<li><a href="supplier.php"><i class="icon-group icon-2x"></i> Suppliers</a>                                    </li>
			<li><a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Sales Report</a>                </li>
			<br><br><br><br><br><br>
			<li>
			 <div class="hero-unit-clock">
		
			<form name="clock">
			<font color="white">Time: <br></font>&nbsp;<input style="width:150px;" type="text" class="trans" name="face" value="" disabled>
			</form>
			  </div>
			</li>
				
				</ul>    
<?php } ?>        
          </div><!--/.well -->
        </div><!--/span-->
		
	<div class="span10">
	<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-default"><i class="icon-arrow-left"></i> Back to Sales</button></a>

<div class="content" id="content" style="height: auto;">
<div style="margin: 0 auto; padding: 0px; width: 400px; font-weight: normal;">
	<div style="width: 100%; height: 19px;" >
	<div>
	<center style="margin-left: -21px;">
		<div style="font:bold 15px 'Aleo';"><i>Michael's</i></div>
	<div style="font:bold 30px 'Aleo';">MORNING STAR</div>
	<div style="font:bold 20px 'Aleo';">COMPUTER SERVICES</div>
	<!--<i style="font-weight: 600;font-size: medium;">Your one stop medical store</i><br>-->
	+254 711 611817 <br>
	<i style="font-size: smaller;">bengit1777@gmail.com</i><br>
	<span style="text-decoration: underline;">Sales Receipt</span><br>	<br>
	</center>
	<div>
	<?php
	$resulta = $db->prepare("SELECT * FROM customer WHERE customer_name= :a");
	$resulta->bindParam(':a', $cname);
	$resulta->execute();
	for($i=0; $rowa = $resulta->fetch(); $i++){
	$address=$rowa['address'];
	$contact=$rowa['contact'];
	}
	?>
	</div>
	</div>
	<div style="width: 80%; float: left; height: 50px; margin-left: 6%;">
	<table cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">

		<tr>
			<td><b>Rct No. :</b></td>
			<td><?php echo $invoice ?></td>
			<td><b>Pay Mthd. :</b></td>
			<td><?php echo $pmethod ?></td>
		</tr>
		<tr>
			<td><b>Date :</b></td>
			<td><?php echo date("M j, Y (D)") ?></td>
			<td><b>Time :</b></td>
			<td><?php echo date("h:i:s A") ?></td>
		</tr>
	</table>

	</div>
	
	<div class="clearfix"></div>
	</div>
	<div style="width: 100%; margin-top:-49px; margin-left: 0%;">
	<br>
	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 16px;	text-align:left;" width="96.5%" >
		<thead>
			<tr>
			
				<th width="40%"> Product Name </th>
				<th width="20%"> Price </th>
				<th width="20%"> Amount </th>
			</tr>
		</thead>
		<tbody>
			
				<?php
					$id=$_GET['invoice'];
					$result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
					$result->bindParam(':userid', $id);
					$result->execute();
					for($i=0; $row = $result->fetch(); $i++){
				?>
				<tr class="record">
				<td><?php echo $row['gen_name']; ?> <br>Qty x <?php echo $row['qty']; ?></td>
				
				<td>
				<?php
				$ppp=$row['price'];
				echo formatMoney($ppp, true);
				?>
				</td>
				
				<td>
				<?php
				$dfdf=$row['amount'];
				echo formatMoney($dfdf, true);
				?>
				</td>
				</tr>
				<?php
					}
				?>
			
				<tr>
					<td colspan="2" style=" text-align:right;"><strong style="font-size: 25px;">Total: &nbsp;</strong></td>
					<td colspan="1"><strong style="font-size: 20px;">
					<?php
					$sdsd=$_GET['invoice'];
					$resultas = $db->prepare("SELECT sum(amount) FROM sales_order WHERE invoice= :a");
					$resultas->bindParam(':a', $sdsd);
					$resultas->execute();
					for($i=0; $rowas = $resultas->fetch(); $i++){
					$fgfg=$rowas['sum(amount)'];
					echo formatMoney($fgfg, true);
					}
					?>
					</strong>
					</td>
				</tr>
				<tr>
					<td colspan="2" style=" text-align:right;"><strong style="font-size: 12px;">VAT (16%): &nbsp;</strong></td>
					<td colspan="1">
						<strong style="font-size: 12px;">
						<?php
						$vat = ($fgfg*16)/100;
						echo formatMoney($vat, true);
						?>
						</strong>
					</td>
				</tr>
				<?php if($pt=='cash'){
				?>
				<tr>
					<td colspan="2"style=" text-align:right;"><strong style="font-size: 15px; color: #222222;">Cash Tendered:&nbsp;</strong></td>
					<td colspan="1"><strong style="font-size: 12px; color: #222222;">
					<?php
					echo formatMoney($cash, true);
					?>
					</strong></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="2" style=" text-align:right;"><strong style="font-size: 12px; color: #222222;">
					<font style="font-size:25px;">
					<?php
					if($pt=='cash'){
					echo 'Change:';
					}
					if($pt=='credit'){
					echo 'Due Date:';
					}
					?>&nbsp;
					</strong></td>
					<td colspan="1"><strong style="font-size: 20px; color: #222222;">
					<?php
					function formatMoney($number, $fractional=false) {
						if ($fractional) {
							$number = sprintf('%.2f', $number);
						}
						while (true) {
							$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
							if ($replaced != $number) {
								$number = $replaced;
							} else {
								break;
							}
						}
						return $number;
					}
					if($pt=='credit'){
					echo $cash;
					}
					if($pt=='cash'){
					echo formatMoney($amount, true);
					}
					?>
					</strong></td>
				</tr>
			
		</tbody>
	</table>

	</div>
	</div>
	<div style="font-size: small;"  align="center"><b>You were served by: <?php echo $_SESSION['SESS_FIRST_NAME'];?>.</b></div>
	<div style="font-size: small;"  align="center">Thankyou for your purchase.</div>
	<hr>
	<div style="font-size: small;"  align="center"><i>POS system by: Morning Star Softwares (MSS)</i><br> 0711611817</div>
	</div>
	</div>
<div class="pull-right" style="margin-right:100px;">
		<a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
		</div>	
</div>
</div>


