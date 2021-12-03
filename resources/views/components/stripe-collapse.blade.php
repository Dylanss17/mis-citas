@push('styles')
<style type="text/css">
/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>

@endpush
			
				<div class="align-items-end form-row">
				<div class="col-md-12">
	                <div class="form-group">
	                	<label for="fullname">Full Name</label>
	                  <input type="text" class="form-control" name="name" placeholder="">
	                </div>
	            </div>
                <div class="w-100"></div>
				<div class="col-md-12">
	                <div class="form-group">
	                	<label for="address">Address</label>
	                  <input type="text" class="form-control" name="address" placeholder="">
	                </div>
	            </div>
		            <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
	                	<label for="namecard">Name on Card</label>
	                  <input type="text" class="form-control" id="card-name"  name="card-name" placeholder="">
	                </div>
		            </div>
					<div class="w-100"></div>
				

				</div>
				
	            <label class="mt-2">Card details:</label>
				<div id="cardElement" ></div>
				<small class="form-text text-muted" id="cardErrors" role="alert"></small>
				<input type="hidden" name="payment_method" id="paymentMethod">
				<br>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
	const stripe = Stripe('pk_test_51Ht2n6GgLxzK05OcA4ewF8S6QROrZdLs4wwmH9OeSO3kscGql4kW2kTBzmnk7izlYTp2tlTqJXPyQgwCRgAryUfD00lWtWte8f');
	const elements = stripe.elements({locale: 'en'});
	const cardElement = elements.create('card');

    cardElement.mount('#cardElement');
</script>
<script>
	const form = document.getElementById('paymentForm');
	const payButton = document.getElementById('payButton');
	
	payButton.addEventListener('click', async(e) => {
        if (form.elements.payment_platform.value === "{{ $paymentPlatform->id }}") {
			
			e.preventDefault();

			stripe.createToken(cardElement).then(function(result) {
				if (result.error) {
				// Inform the customer that there was an error.
				var errorElement = document.getElementById('cardErrors');
				errorElement.textContent = result.error.message;
				} else {
				// Send the token to your server.
				
				stripeTokenHandler(result.token);
				}
			});

			function stripeTokenHandler(token) {
				// Insert the token ID into the form so it gets submitted to the server
				var form = document.getElementById('paymentForm');
				var hiddenInput = document.createElement('input');
				hiddenInput.setAttribute('type', 'hidden');
				hiddenInput.setAttribute('name', 'stripeToken');
				hiddenInput.setAttribute('value', token.id);
				form.appendChild(hiddenInput);
				
				// Submit the form
				form.submit();
				}
		}
	});
</script>
@endpush