<html>

<head>
	<title>Checkout</title>
</head>

<body>

	<h1>Checkout</h1>
	<form action="<?php echo site_url() ?>/vtweb/vtweb_checkout" method="POST" id="payment-form">

		<input type="hidden" name="gross_amount" value="500000">
		<input type="hidden" name="price" value="500000">
		<input type="hidden" name="name" value="Basic">

		<button class="submit-button" type="submit">Submit Payment</button>
	</form>

</body>

</html>