<?php

class Security
{
  private function base64UrlEncode(string $data)
  {
    $b64 = base64_encode($data);

    $url = strtr($b64, '+/', '-_');

    return rtrim($url, '=');
  }

  private function base64UrlDecode(string $data)
  {
    $b64 = strtr($data, '-_', '+/');

    return base64_decode($b64);
  }

  public function securedEncrypt(string $data)
  {
    $first_key = base64_decode(FIRSTKEY);
    $second_key = base64_decode(SECONDKEY);

    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($iv_length);

    $first_encrypted = openssl_encrypt($data, 'aes-256-cbc', $first_key, OPENSSL_RAW_DATA , $iv);
    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

    $output = base64_encode($iv.$second_encrypted.$first_encrypted);

    return $output;
  }

  public function securedDecrypt(string $input)
  {
    $first_key = base64_decode(FIRSTKEY);
    $second_key = base64_decode(SECONDKEY);
    $mix = base64_decode($input);

    $iv_length = openssl_cipher_iv_length('aes-256-cbc');

    $iv = substr($mix, 0, $iv_length);
    $second_encrypted = substr($mix, $iv_length, 64);
    $first_encrypted = substr($mix, $iv_length + 64);

    $data = openssl_decrypt($first_encrypted, 'aes-256-cbc', $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

    if (hash_equals($second_encrypted, $second_encrypted_new))
    {
      error_log('yes');
      return $data;
    }
    error_log('no');
    return FALSE;
  }

  public function jwtEncode(string $data)
  {
    $header = [
      'alg' => 'HS256',
      'typ' => 'JWT'
    ];

    $header = json_encode($header);
    $header = $this->base64UrlEncode($header);

    $iat = time();
    $exp = $iat + pow(60, 2);

    $payload = [
      'iat' => $iat,
      'exp' => $exp,
      'aud' => $data
    ];

    $payload = json_encode($payload);
    $payload = $this->base64UrlEncode($payload);

    $signature = hash_hmac('sha256', "$header.$payload", 'minha-senha', TRUE);
    $signature = $this->base64UrlEncode($signature);

    return "$header.$payload.$signature";
  }

  public function jwtDecode(string $token)
  {
    $part = explode('.', $token);

    $header = $part[0];
    $payload = $part[1];
    $signature = $part[2];

    $payloadArray = json_decode($this->base64UrlDecode($payload), TRUE);
    $exp = $payloadArray['exp'];

    if ($exp < time())
    {
      return 'Sessão expirada';
    }

    // if for $payload['aud']

    $validate = hash_hmac('sha256', "$header.$payload", 'minha-senha', TRUE);
    $validate = $this->base64UrlEncode($validate);

    if ($signature === $validate)
    {
      return 'Valid';
    }
    else
    {
      return 'invalid';
    }
  }
}