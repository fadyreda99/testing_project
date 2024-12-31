<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
// use ParagonIE\RandomLib\Factory;
use ParagonIE\RandomLib\Random;
use RandomLib\Factory;
use SodiumException;

class RobinHoodController extends Controller
{

    // public function generateKeys()
    // {
    //     $keypair = sodium_crypto_sign_keypair();
    //     $privateKey = sodium_crypto_sign_secretkey($keypair);
    //     $publicKey = sodium_crypto_sign_publickey($keypair);

    //     return [
    //         'private_key' => base64_encode($privateKey),
    //         'public_key' => base64_encode($publicKey),
    //     ];
    // }

    // Generate signature for the request
    public function generateSignature($apiKey, $privateKey, $currentTimestamp, $path, $method, $body = [])
    {
        // For GET requests or requests without a body, omit the body from the message
        if (empty($body)) {
            $message = $apiKey . $currentTimestamp . $path . $method;
        } else {
            // For requests with a body, include the body in the message (JSON encoded)
            $message = $apiKey . $currentTimestamp . $path . $method . json_encode($body);
        }

        // Debug: Log the constructed message to verify the format
        logger()->info("Message to sign: " . $message);

        // Decode the base64 private key
        $privateKeyDecoded = base64_decode($privateKey);

        // Ensure the private key is valid
        if (strlen($privateKeyDecoded) !== SODIUM_CRYPTO_SIGN_SECRETKEYBYTES) {
            throw new \Exception('Invalid private key length.');
        }

        // Sign the message using sodium
        $signedMessage = sodium_crypto_sign_detached($message, $privateKeyDecoded);

        // Return the signature in base64
        return base64_encode($signedMessage);
    }



    // Get Trading Pairs from Robinhood API
    public function getTradingPairs(Request $request)
    {
        $apiKey = 'rh-api-546fe23d-ef43-4118-a353-e24a1bfffb78'; // Your API key
        $privateKey = "NKqcx+4tPQMZxc6Bxkx+lDxXpF8cGu6xSY+shP7fdQSYkpEWiwZSORzXk2OJozi6VOsM4CRqZuut7pUeTqltrg=="; // Get private key from .env
        $currentTimestamp = time(); // Current Unix timestamp
        $path = "/api/v1/crypto/trading/trading_pairs/?symbol=BTC-USD"; // Request path
        $method = "GET"; // HTTP method
        $body = []; // No body needed for GET requests

        // Ensure private key is available
        if (!$privateKey) {
            throw new \Exception('Private key is missing.');
        }

        // Debug: Check message and signature
        $message = $apiKey . $currentTimestamp . $path . $method . json_encode($body);
        $signature = $this->generateSignature($apiKey, $privateKey, $currentTimestamp, $path, $method, $body);

        // Debug: Output signature and message for troubleshooting
        Log::channel('daily')->info("Message: " . $message);
        Log::channel('daily')->info("Signature: " . $signature);

        // Send GET request to Robinhood API with headers
        $url = "https://trading.robinhood.com/api/v1/crypto/trading/trading_pairs/?symbol=BTC-USD";
        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'x-timestamp' => $currentTimestamp,
            'x-signature' => $signature,
            'Content-Type' => 'application/json; charset=utf-8'
        ])->get($url);

        // Return the response
        return response()->json($response->json());
    }

    public function getAccounts(Request $request)
    {
        $apiKey = 'rh-api-546fe23d-ef43-4118-a353-e24a1bfffb78'; // Your API key
        $privateKey = "NKqcx+4tPQMZxc6Bxkx+lDxXpF8cGu6xSY+shP7fdQSYkpEWiwZSORzXk2OJozi6VOsM4CRqZuut7pUeTqltrg=="; // Get private key from .env
        $currentTimestamp = time(); // Current Unix timestamp
        $path = "/api/v1/crypto/trading/accounts/"; // Request path
        $method = "GET"; // HTTP method
        $body = []; // No body needed for GET requests

        // Ensure private key is available
        if (!$privateKey) {
            throw new \Exception('Private key is missing.');
        }

        // Build message for signature generation
        $message = $apiKey . $currentTimestamp . $path . $method . json_encode($body);

        // Generate the signature
        $signature = $this->generateSignature($apiKey, $privateKey, $currentTimestamp, $path, $method, $body);

        // Log for debugging
        Log::channel('daily')->info("Message: " . $message);
        Log::channel('daily')->info("Signature: " . $signature);

        // Send GET request to Robinhood API with the necessary headers
        $url = "https://trading.robinhood.com/api/v1/crypto/trading/accounts/";

        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'x-timestamp' => $currentTimestamp,
            'x-signature' => $signature,
            'Content-Type' => 'application/json; charset=utf-8',
        ])->get($url);

        // Return the response
        return response()->json($response->json());
    }
}
