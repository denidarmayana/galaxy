<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (!function_exists("json_success")) {
	function json_success($message,$data)
	{
		$data = [
			'code'=>200,
			'message'=>$message,
			'data'=>$data,
		];
		echo json_encode($data);
	}
}

if (!function_exists("json_error")) {
	function json_error($message,$data)
	{
		$data = [
			'code'=>203,
			'message'=>$message,
			'data'=>$data,
		];
		echo json_encode($data);
	}
}

if (!function_exists("jsons")) {
	function jsons()
	{
		return header('Content-Type: application/json');
	}
}

if (!function_exists("generate_jwt")) {
	function generate_jwt($user_id) {
		date_default_timezone_set("Asia/Jakarta");
	    $key = "PTDeltaGlobalTechnindo";
	    $issued_at = time();
	    $expiration_time = $issued_at + (60 * 60); // 1 hour

	    $payload = array(
	        'user_id' => $user_id,
	        'iat' => $issued_at,
	        'exp' => $expiration_time
	    );
	    return JWT::encode($payload,$key, 'HS256');
	}
}

if (!function_exists("verify_jwt")) {
	function verify_jwt($token) {
        $key = 'PTDeltaGlobalTechnindo'; // You might want to use a more secure key here
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return json_encode($decoded);
        } catch (\Exception $e) {
            return $e;
        }
    }
}


if (!function_exists("number")) {
	function number($no) {
	    return number_format($no,0,',','.');
	}
}