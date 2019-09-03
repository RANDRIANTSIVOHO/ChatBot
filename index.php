<?php
require("config/secret.php");

$response_greeting = ["hi","hello","salut","salama"];

$hub_challenge = $_REQUEST['hub_challenge'];
$hub_verify_token = $_REQUEST['hub_verify_token'];
if ($hub_verify_token === $hubVerifyToken) {
	header('HTTP/1.1 200 OK');
	echo $hub_challenge;
	die;
} else {
      $input = json_decode(file_get_contents('php://input'), true);
      // Get error message
      $error = $input['error']['message'];
      // Get the Senders Page Scoped ID
      $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
      // Get the Recipient Page Scoped ID
      $recipient = $input['entry'][0]['messaging'][0]['recipient']['id'];
      // Get the Message text sent
      $message = $input['entry'][0]['messaging'][0]['message']['text'];
      // Get the Postbacks sent
      $postback = $input['entry'][0]['messaging'][0]['postback']['payload'];
      // Get the Entity response
      $entity = $input['entry'][0]['messaging'][0]['entity']['value'];
}

// handle bot's anwser
if ($postback == "first_get_start") {
 	$answer = "Salama ! Je suis Aina, ton assistante virtuelle. Qu'est-ce que je peux faire pour toi ?Pour des raisons de confidentialité, je n'ai pas accès à tes comptes, ni à tes demandes en cours. De ton côté, ne communique pas de données sensibles ou personnelles (N° carte, N° compte, codes, etc.) dans cette fenêtre de discussion.\nTu peux écrire tes questions sur nos produits et services. Ou utiliser mon menu :";
 	SendTextMessage($answer, $sender, $accessToken, $input);
 	die();
}

//set Message
if(in_array($message, $response_greeting)) {
    $answer = "Salama ! Je suis Aina, ton assistante virtuelle. Qu'est-ce que je peux faire pour toi ?Pour des raisons de confidentialité, je n'ai pas accès à tes comptes, ni à tes demandes en cours. De ton côté, ne communique pas de données sensibles ou personnelles (N° carte, N° compte, codes, etc.) dans cette fenêtre de discussion.\nTu peux écrire tes questions sur nos produits et services. Ou utiliser mon menu :";
    SendTextMessage($answer, $sender, $accessToken, $input);
} 
if($message == "blog"){
     $answer = ["attachment"=>[
      "type"=>"template",
      "payload"=>[
        "template_type"=>"generic",
        "elements"=>[
          [
            "title"=>"Welcome to SOGE",
            "item_url"=>"https://societegenerale.mg",
            "image_url"=>"https://societegenerale.mg/typo3temp/_processed_/csm_vignette_devenir_client_01_6ec4f1a34c.jpg",
            "subtitle"=>"societe generale Madagascar",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"https://societegenerale.mg",
                "title"=>"View Website"
              ],
              [
                "type"=>"postback",
                "title"=>"Start Chatting",
                "payload"=>"DEVELOPER_DEFINED_PAYLOAD"
              ]              
            ]
          ]
        ]
      ]
    ]];
    SendAttachementMessage($answer, $sender, $accessToken, $input);
}
if($message == "more") {
  $answer = ["attachment"=>[
      "type"=>"template",
      "payload"=>[
        "template_type"=>"button",
        "text"=>"What do you want to do next?",
        "buttons"=>[
          [
            "type"=>"web_url",
            "url"=>"https://petersapparel.parseapp.com",
            "title"=>"Show Website"
          ],
          [
            "type"=>"postback",
            "title"=>"Start Chatting",
            "payload"=>"USER_DEFINED_PAYLOAD"
          ]
        ]
      ]
      ]];
    SendAttachementMessage($answer, $sender, $accessToken, $input);
}
if($message == "today"){

 $answer = ["attachment"=>[
      "type"=>"template",
      "payload"=>[
        "template_type"=>"list",
        "elements"=>[
          [
             "title"=> "Classic T-Shirt Collection",
                    "image_url"=> "https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
                    "subtitle"=> "See all our colors",
                    "default_action"=> [
                        "type"=> "web_url",
                        "url"=> "https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",                       
                        "webview_height_ratio"=> "tall",
                        // "messenger_extensions"=> true,
                        // "fallback_url"=> "https://peterssendreceiveapp.ngrok.io/"
                    ],
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"https://petersfancybrownhats.com",
                "title"=>"View Website"
              ],
            ]
          ],
            [
            "title"=>"Welcome to Peter\'s Hats",
            "item_url"=>"https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",
            "image_url"=>"https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
            "subtitle"=>"We\'ve got the right hat for everyone.",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"https://petersfancybrownhats.com",
                "title"=>"View Website"
              ],
            ]
          ],
            [
            "title"=>"Welcome to Peter\'s Hats",
            "item_url"=>"https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",
            "image_url"=>"https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
            "subtitle"=>"We\'ve got the right hat for everyone.",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"https://petersfancybrownhats.com",
                "title"=>"View Website"
              ],
            ]
          ]

        ]
      ]
    ]];
    SendAttachementMessage($answer, $sender, $accessToken, $input);
}
if($message == "one") {
  $answer = ["text"=> "Salama ! Je suis Aina, ton assistante virtuelle. Qu'est-ce que je peux faire pour toi ?Pour des raisons de confidentialité, je n'ai pas accès à tes comptes, ni à tes demandes en cours. De ton côté, ne communique pas de données sensibles ou personnelles (N° carte, N° compte, codes, etc.) dans cette fenêtre de discussion.\nTu peux écrire tes questions sur nos produits et services. Ou utiliser mon menu :",
		    "quick_replies"=>[
		      [
		        "content_type"=>"text",
		        "title"=>"Information 😀",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ],[
		        "content_type"=>"text",
		        "title"=>"Reclamation 😎",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ],[
		        "content_type"=>"text",
		        "title"=>"Urgence 😱",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ]
		    ]
		  ];
	SendAttachementMessage($answer, $sender, $accessToken, $input);
}

if ($message == "Information 😀") {
	$answer = ["text"=> "Tu peux écrire tes questions sur nos produits et services. Ou utiliser mon menu :",
		    "quick_replies"=>[
		      [
		        "content_type"=>"text",
		        "title"=>"Information 😀",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ],[
		        "content_type"=>"text",
		        "title"=>"Reclamation 😎",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ],[
		        "content_type"=>"text",
		        "title"=>"Urgence 😱",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ]
		    ]
		  ];
	SendAttachementMessage($answer, $sender, $accessToken, $input);
}
if ($message == "Reclamation 😎") {
	$answer = ["text"=> "Tu peux écrire tes questions sur nos produits et services. Ou utiliser mon menu :",
		    "quick_replies"=>[
		      [
		        "content_type"=>"text",
		        "title"=>"Information 😀",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ],[
		        "content_type"=>"text",
		        "title"=>"Reclamation 😎",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ],[
		        "content_type"=>"text",
		        "title"=>"Urgence 😱",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ]
		    ]
		  ];
	SendAttachementMessage($answer, $sender, $accessToken, $input);
}
if ($message == "Urgence 😱") {
	$answer = ["text"=> "Tu peux écrire tes questions sur nos produits et services. Ou utiliser mon menu :",
		    "quick_replies"=>[
		      [
		        "content_type"=>"text",
		        "title"=>"Information 😀",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ],[
		        "content_type"=>"text",
		        "title"=>"Reclamation 😎",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ],[
		        "content_type"=>"text",
		        "title"=>"Urgence 😱",
		        "payload"=>"<POSTBACK_PAYLOAD>"
		      ]
		    ]
		  ];
	SendAttachementMessage($answer, $sender, $accessToken, $input);
}


//send message text to facebook bot
function SendTextMessage($answer, $sender, $accessToken, $input){
	$response = [
	    'recipient' => [ 'id' => $sender ],
	    'message' => [ 'text' => $answer ]
	];

	$ch = curl_init('https://graph.facebook.com/v3.3/me/messages?access_token='.$accessToken);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

	if(!empty($input)){
	$result = curl_exec($ch);
	}
	curl_close($ch);
	
}

//send message attachement to facebook bot
function SendAttachementMessage($answer, $sender, $accessToken, $input){
	$response = [
	    'recipient' => [ 'id' => $sender ],
	    'message' => $answer
	];

	$ch = curl_init('https://graph.facebook.com/v3.3/me/messages?access_token='.$accessToken);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

	if(!empty($input)){
	$result = curl_exec($ch);
	}
	curl_close($ch);
}

?>