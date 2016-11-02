<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Request;
use Log;
use DB;
use Auth;

class StripeController extends Controller{
    
    
    public function __construct()
    {
    }
    
    public function charge(Request $request){
        
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey( env("STRIPE_SECRET") );
        
        $stripetoken = Request::input("stripeToken");
		$owner_id = Request::input("owner");
		
		//need to look up the user
		$email = DB::table("member")->where("token", $owner_id)->pluck("email");
		
		/*
        $customer = \Stripe\Customer::create(array(
            "source" => $stripetoken,
            "plan" => "modo_tier_1",
            "email" => $email[0])
        );
		*/
		
		
		$customer = \Stripe\Customer::create(array(
            "source" => $stripetoken,
            "plan" => "modo_freemie",
            "email" => $email[0])
        );
		  
		Log::info(json_encode($customer));
        
        if( get_class($customer) === "Stripe\Customer" ){
        	
			
            
            //update tier and stripe customer id
            $result = DB::table("member")->where('email', $email)->update([

                'stripe_id'=> $stripetoken,
                'subscription'=> $customer->subscriptions->data[0]->id,
                'paid'=>true
            ]);
            
            if($result == 1){
            	
                return json_encode( array( "status"=>1, "message"=>"Account Upgrade Succeeded", "customer"=>$customer ) );
            }else{
                return json_encode( array( "status"=>0, "message"=>"Charge Failed", "result"=>$result ) );
            }
               
        }else{
            return json_encode( array( "status"=>0, "message"=>"Unable to authorize charge" ) );
        }
        
        //$result
        
        
        
    }
    
    public function cancelSubscription(Request $request){
        
        \Stripe\Stripe::setApiKey( env("STRIPE_SECRET") );
		
		$owner_id = Request::input("owner");
		
		
		$member = DB::table("member")->where("token", $owner_id)->get();
		
		//Log::info(json_encode($member[0]) );
		//Log::info(gettype($member[0]));
		//Log::info($member[0]->id);
		//Log::info($member[0]->subscription);
		
		//return;
		
		$id = $member[0]->id;
		$subscription = $member[0]->subscription;
		
		Log::info("Subscription is $subscription");
		
		$subscription = \Stripe\Subscription::retrieve($subscription);
        $result = $subscription->cancel();
		
		DB::table("member")->where("id", $id )->update([
            'stripe_id'=>"",
            'subscription'=>"",
            'paid'=>false
        ]);
		/*
        $salt = Request::input("salt");
        
        //get the subscription id
        $result = DB::table("member")->where("salt", urldecode($salt) )->get();
        $subscription = $result[0]->subscription;
        
        //return json_encode( array("subscription"=>$result[0]->subscription) );
        $subscription = \Stripe\Subscription::retrieve($subscription);
        $result = $subscription->cancel();
        
        DB::table("users")->where("salt", urldecode($salt) )->update([
            
            'tier'=>0,
            'subscription'=>null
        ]);
		 * 
		 */
        
        return json_encode( array("result"=>$result) );
        
    }
    
}
