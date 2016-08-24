<?php

  $user = Auth::user();
  
?>

<template id="stripeOrder">

    <div class="stripeOrderForm"> 
    
        <form action="" method="POST" id="payment-form">
        	
          <input type="hidden" value="" id="_stripetoken">
            
          <!--button type="submit" class="submit submitOrder" onclick="site.submitOrder();">Submit Payment</button>
          <button type="button" class="submit cancelOrder" onclick="site.cancelOrder();">Cancel Payment</button-->
          
          <br><br>
          <span class="payment-errors"></span>
          
          <!--div class="form-row">
            <label>
              <span>Email</span>
              <input type="email" size="20" class="ccMail" value="">
            </label>
          </div-->

          <div class="form-row">
            <label>
              <span>Card Number</span>
              <!--input type="text" size="20" data-stripe="number" value=""-->
              <input type="text" size="20" data-stripe="number" value="4242 4242 4242 4242">
            </label>
          </div>

          <div class="form-row">
            <label>
              <span>Expiration (MM/YY)</span>
            </label>
              <br>
            <!--input type="text" size="2" data-stripe="exp_month" value=""-->
            <input type="text" size="2" data-stripe="exp_month" value="01">
            <span> / </span>
            <!--input type="text" size="2" data-stripe="exp_year" value=""-->
            <input type="text" size="2" data-stripe="exp_year" value="18">
          </div>

          <div class="form-row">
            <label>
              <span>CVC</span>
              <br>
              <!--input type="text" size="4" data-stripe="cvc" value=""-->
              <input type="text" size="4" data-stripe="cvc" value="123">
            </label>
          </div>
          
          <button type="submit" class="submit submitOrder padded" onclick="mo.submitOrder();">Submit Payment</button>   
          
          <br><br>
          
          <img src="images/darkstripepower.png" alt="Powered by Stripe" class="stripelogo">
          
        </form>
    
    </div>
    
</template>

<template id="cancelSubscriptionTemplate">
	
	<div class="cancelSubscription">
		<button onclick="mo.cancelSubscription()">Cancel Subscription</button>
	</div>
	
</template>

