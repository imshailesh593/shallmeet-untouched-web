<?php
require_once('../assets/includes/core.php');
if ( isset( $_GET['type'] ) && !empty( $_GET['type'] ) ){
	$t = secureEncode($_GET['type']);
	$a = secureEncode($_GET['amount']);
	$c = secureEncode($_GET['custom']);

	$days = 0;
	if($t == 1){
		$b = 'Credits';
		$n = 'ipn';
	} else {
		$days = secureEncode($_GET['days']);
		$b = 'Premium';
		$n = 'ipnpremium';
	}
} else {
  exit;
}
?>

<form id="paypalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?php echo  $sm['plugins']['paypal']['email']; ?>">
    <input type="hidden" name="item_name" value="<?php echo  $sm['config']['name']; ?> <?php echo  $b; ?>">
    <input type="hidden" name="currency_code" value="<?php echo  $sm['plugins']['settings']['currency']; ?>">
    <input type="hidden" name="amount" value="<?php echo  $a; ?>">
    <input type="hidden" name="custom" value="<?php echo  $c; ?>">
    <input type="hidden" name="no_shipping" value="1">                  
    <input type="hidden" name="notify_url" value="<?php echo  $sm['config']['site_url']; ?>assets/sources/<?php echo  $n; ?>.php">
    <input type="hidden" name="return" value="<?php echo  $sm['config']['site_url']; ?>credits-ok">
</form>

<form id="paypalSubscribe" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick-subscriptions">
    <input type="hidden" name="business" value="<?php echo  $sm['plugins']['paypal']['email']; ?>">
    <input type="hidden" name="item_name" id="premiumName" value="<?php echo  $sm['config']['name']; ?> Premium">
    <input type="hidden" name="currency_code" value="<?php echo  $sm['plugins']['settings']['currency']; ?>">
    <input type="hidden" name="a3" value="<?php echo  $a; ?>">
    <input type="hidden" name="p3" value="<?php echo  $days; ?>">
    <input type="hidden" name="t3" value="D">
    <input type="hidden" name="src" value="1">
    <input type="hidden" name="sra" value="1">
    <input type="hidden" name="custom" value="<?php echo  $c; ?>">
    <input type="hidden" name="no_shipping" value="1">                
    <input type="hidden" name="notify_url" value="<?php echo  $sm['config']['site_url']; ?>assets/sources/<?php echo  $n; ?>.php">
    <input type="hidden" name="return" value="<?php echo  $sm['config']['site_url']; ?>">
</form>  

<?php if($t == 1){ ?>
<script>
document.getElementById("paypalForm").submit();
</script>
<?php } else { ?>
<script>
document.getElementById("paypalSubscribe").submit();
</script>
<?php } ?>