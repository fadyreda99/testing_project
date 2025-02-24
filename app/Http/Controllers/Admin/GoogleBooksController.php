<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Books;

class GoogleBooksController extends Controller
{
      // Redirect to Google for authentication
      public function redirectToGoogle()
      {
          $client = new Google_Client();
          $client->setClientId(env('GOOGLE_CLIENT_ID'));
          $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
          $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
          $client->addScope(Google_Service_Books::BOOKS);
  
          $authUrl = $client->createAuthUrl();
          return redirect()->away($authUrl);
      }
  
      // Handle Google callback and retrieve access token
      public function handleGoogleCallback(Request $request)
      {
          $client = new Google_Client();
          $client->setClientId(env('GOOGLE_CLIENT_ID'));
          $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
          $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
  
          if ($request->get('code')) {
              // Exchange the code for an access token
              $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
              $client->setAccessToken($token);
  
              // Store token for future requests (optional)
              session(['google_token' => $token]);
  
              // Now you can use the Google Books API
              $booksService = new Google_Service_Books($client);
  
              // Example: Get book details
              $bookId = 'your-book-id'; // Replace with actual book ID
              $book = $booksService->volumes->get($bookId);
  
              return view('book.details', compact('book'));
          }
  
          return redirect()->route('google.login');
      }
}
