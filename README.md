# loyaltylionClientSDK
SDK for LoyaltyLion Client API



#example usage


    <?php

	  	require('lib/loyaltylionClient.php'); 
		use LoyaltyLionApp\LoyaltyLionClient;
		
	  	$loyaltyClient = new LoyaltyLionClient('Token','Secret');
	  	echo $loyaltyClient->getRewardPoint('youremailaddress@test.com');  
  	?>
 
 
