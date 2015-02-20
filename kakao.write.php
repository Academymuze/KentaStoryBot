<?php
	require_once ("kakao.config.php");

	$token = $_SESSION['token'];
	$refresh_token = $_SESSION['refresh_token'];

	$i = 1;

	while ($i < 2) {
		$rand_num = rand(0,2);
		switch($rand_num) {
			case "0" :
			$params = sprintf( 'content=내용&permission=F&enable_share=true'); // permission = A (전체 공개) , F ( 친구 공개 ) , M ( 나만 보기 ) enable_share= true( 공유 허용 ), false ( 공유 비허용 ) 
			$opts = array( 
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer {$token}"
			),
			CURLOPT_URL => "https://kapi.kakao.com/v1/api/story/post/note", 
			CURLOPT_SSL_VERIFYPEER => false, 
				CURLOPT_SSLVERSION => 1,
			CURLOPT_POST => true, 
			CURLOPT_POSTFIELDS => $params, 
			CURLOPT_RETURNTRANSFER => true, 
			);
			$curl = curl_init();
			curl_setopt_array($curl, $opts);
			$result = curl_exec($curl);
			curl_close($curl);
			$params = sprintf( 'grant_type=refresh_token&client_id=%s&refresh_token=%s', $kakao_app_id, $refresh_token); 
			$opts = array( 
				CURLOPT_URL => $kakao_get_token, 
				CURLOPT_SSL_VERIFYPEER => false, 
					CURLOPT_SSLVERSION => 1,
				CURLOPT_POST => true, 
				CURLOPT_POSTFIELDS => $params, 
				CURLOPT_RETURNTRANSFER => true, 
				CURLOPT_HEADER => false 
			 ); 
		}
	}

?>