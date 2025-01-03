<?php

// Connect to the database
include('../connect.php');

// Deletion logic placed at the top of the page
if (isset($_GET['delete_sale_id'])) {
    $transaction_id = $_GET['delete_sale_id'];

    // Prepare and execute the delete query for a single sale
    $query = "DELETE FROM sales WHERE transaction_id = :transaction_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':transaction_id', $transaction_id);

    if ($statement->execute()) {
        echo "<script>alert('Sale with Transaction ID: $transaction_id has been deleted.');</script>";
    } else {
        echo "<script>alert('Error: Unable to delete the sale.');</script>";
    }
} elseif (isset($_GET['delete_all'])) {
    // Prepare and execute the delete query to delete all sales
    $query = "DELETE FROM sales";
    $statement = $db->prepare($query);

    if ($statement->execute()) {
        echo "<script>alert('All sales have been deleted.');</script>";
    } else {
        echo "<script>alert('Error: Unable to delete all sales.');</script>";
    }
}
?>

<html>
<?php
	require_once('auth.php');
?>
<head>
<title>
POS
</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<style type="text/css">
	body {
		padding-top: 60px;
		padding-bottom: 40px;
	}
	.sidebar-nav {
		padding: 9px 0;
	}
</style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
<script language="javascript">
function Clickheretoprint() { 
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
	disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
	var content_vlue = document.getElementById("content").innerHTML; 
	
	var docprint=window.open("","",disp_setting); 
	docprint.document.open(); 
	docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
	docprint.document.write(content_vlue); 
	docprint.document.close(); 
	docprint.focus(); 
}
</script>

<script language="javascript" type="text/javascript">
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock () {
	if(timerRunning) clearTimeout(timerID);
	timerRunning = false;
}
function showtime () {
	var now = new Date();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds();
	var timeValue = "" + ((hours > 12) ? hours - 12 : hours);
	if (timeValue == "0") timeValue = 12;
	timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
	timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
	timeValue += (hours >= 12) ? " P.M." : " A.M.";
	document.clock.face.value = timeValue;
	timerID = setTimeout("showtime()", 1000);
	timerRunning = true;
}
function startclock() {
	stopclock();
	showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>
</head>
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
<body>
<?php include('navfixed.php');?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<li><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
					<li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i> Sales</a></li>             
					<li><a href="products.php"><i class="icon-list-alt icon-2x"></i> Products</a></li>
					<li><a href="customer.php"><i class="icon-group icon-2x"></i> Customers</a></li>
					<li><a href="supplier.php"><i class="icon-group icon-2x"></i> Suppliers</a></li>
					<li class="active"><a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Sales Report</a></li>
					<br><br><br><br><br><br>		
					<li>
						<div class="hero-unit-clock">
							<form name="clock">
								<font color="white">Time: <br></font>&nbsp;<input style="width:150px;" type="submit" class="trans" name="face" value="">
							</form>
						</div>
					</li>
				</ul>     
			</div><!--/.well -->
		</div><!--/span-->
		<div class="span10">
			<div class="contentheader">
				<i class="icon-bar-chart"></i> Sales Report
			</div>
			<ul class="breadcrumb">
				<li><a href="index.php">Dashboard</a></li> /
				<li class="active">Sales Report</li>
			</ul>

			<div style="margin-top: -19px; margin-bottom: 21px;">
				<a href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
			</div>

			<form action="salesreport.php" method="get">
				<center>
					<strong>From : <input type="text" style="width: 223px; padding:14px;" name="d1" class="tcal" value="" autocomplete="off"/> 
					To: <input type="text" style="width: 223px; padding:14px;" name="d2" class="tcal" value="" autocomplete="off"/>
					<button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
						<i class="icon icon-search icon-large"></i> Search
					</button>
					<button style="float:right; line-height: 28px; font-size: 16px;" class="btn btn-success btn-mini">
						<a href="javascript:Clickheretoprint()" style="padding: 16px;"><i class="icon-print icon-large">&nbsp;</i> &nbsp;Print</a>
					</button>
					<button class="btn btn-danger" style="float: right; margin-right: 10px;" id="delete-all">Delete All Sales</button>
					</strong>
				</center>
			</form>

			<div class="content" id="content">
				<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
					<center>
						<div style="font:bold 30px 'Aleo';">KITHYOKO AGRICHEM DEALERS</div>
						0724102225 | 0710359611 <br>
						<i style="font-size: smaller;">bengit1777@gmail.com</i><br>
						<div><u style="font-size: 17px;">Sales Report from&nbsp;<?php echo $_GET['d1'] ?>&nbsp;to&nbsp;<?php echo $_GET['d2'] ?></u></div>
						<div style="font:bold 18px; padding-top: 3px;">Printed on 
							<?php
								date_default_timezone_set('Africa/Nairobi');
								echo date('l (d-M-Y) h:i A');
							?>
						</div>
					</center>
				</div>
				<hr>
				<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
					<thead>
						<tr>
							<th width="13%" style="border-bottom:1px solid #999999"> Transaction ID </th>
							<th width="13%" style="border-bottom:1px solid #999999"> Transaction Date </th>
							<th width="8%" style="border-bottom:1px solid #999999"> Pay Mthd </th>
							<th width="13%" style="border-bottom:1px solid #999999"> Cashier</th>
							<th width="15%" style="border-bottom:1px solid #999999"> Customer Name</th>
							<th width="16%" style="border-bottom:1px solid #999999"> Receipt Number </th>
							<th width="13%" style="border-bottom:1px solid #999999"> Amount </th>
							<th width="8%" style="border-bottom:1px solid #999999"> Discount </th>
							<th width="13%" style="border-bottom:1px solid #999999"> Total Amount </th>
							<th width="13%" style="border-bottom:1px solid #999999"> Delete </th>
						</tr>
					</thead>
					<tbody>
						<?php
							include('../connect.php');
							$d1=$_GET['d1'];
							$d2=$_GET['d2'];
							$result = $db->prepare("SELECT * FROM sales WHERE date BETWEEN :a AND :b ORDER BY transaction_id DESC ");
							$result->bindParam(':a', $d1);
							$result->bindParam(':b', $d2);
							$result->execute();
							for($i=0; $row = $result->fetch(); $i++){
						?>
						<tr class="record">
							<td><?php echo $row['transaction_id']; ?></td>
							<td><?php echo $row['date']; ?></td>
							<td><?php echo $row['type']; ?></td>
							<td><?php echo $row['cashier']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['invoice_number']; ?></td>
							<td><?php echo formatMoney($row['amount'], true); ?></td>
							<td><?php echo formatMoney($row['sdiscount'], true); ?></td>
							<td><?php echo formatMoney($row['amount']-$row['sdiscount'] , true); ?></td>
							<td>
								<!-- Delete button with confirmation and page reload -->
								<a href="salesreport.php?d1=<?php echo $d1; ?>&d2=<?php echo $d2; ?>&delete_sale_id=<?php echo $row['transaction_id']; ?>" 
									onclick="return confirm('Are you sure you want to delete this sale? This action is irreversible.');">
									<button class="btn btn-danger btn-mini">Delete</button>
								</a>
							</td>
						</tr>
						<?php
							}
						?>
						<tr>
							<th colspan="6" style="border-top:1px solid #999999"> Total Amount </th>
							<th colspan="2" style="border-top:1px solid #999999">
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
									$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN :a AND :b");
									$result->bindParam(':a', $d1);
									$result->bindParam(':b', $d2);
									$result->execute();
									for($i=0; $row = $result->fetch(); $i++){
										$fgfg=$row['sum(amount)'];
										echo formatMoney($fgfg, true);
									}
								?>
							</th>
						</tr>
					</tbody>
				</table>
			</div><!-- end of content -->

			<script src="js/jquery.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					// Deleting a single sale
					$('.delete-sale').click(function(){
						var saleId = $(this).data('id');
						console.log(saleId);
						if(confirm('Are you sure you want to delete this sale?')){
							$.ajax({
								url: 'delete_sale.php',
								type: 'POST',
								data: {id: saleId},
								success: function(response){
									alert(response);
									location.reload();
								}
							});
						}
					});

					// Deleting all sales
					$('#delete-all').click(function(){
						if(confirm('Are you sure you want to delete all sales? This action is irreversible.')){
							$.ajax({
								url: 'delete_all_sales.php',
								type: 'POST',
								success: function(response){
									alert(response);
									location.reload();
								}
							});
						}
					});
				});
			</script>
		</div><!--/span-->
	</div><!--/row-->
</div><!--/.fluid-container-->
</body>
<?php include('footer.php'); ?>
</html>
