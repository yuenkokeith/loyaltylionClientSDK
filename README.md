# loyaltylionClientSDK
SDK for LoyaltyLion Client API



#example usage


    <?php

	  	require('lib/loyaltylionClient.php'); 
		use LoyaltyLionApp\LoyaltyLionClient;
		
	  	$loyaltyClient = new LoyaltyLionClient('Token','Secret');
	  	$loyaltyClient->sendRequest("https://api.loyaltylion.com/v2/customers", "email", "youremailaddress@test.com");
	  	echo $loyaltyClient->getRewardPoint();  
  	?>
 
 
