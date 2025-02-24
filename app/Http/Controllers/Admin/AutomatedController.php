<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

class AutomatedController extends Controller
{
    public function automate(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'url' => 'required|url',
            // 'button_id' => 'required|string',
        ]);

        $url = $request->input('url');
        $buttonId = $request->input('button_id');

        // Selenium server URL
        $host = 'http://localhost:4444/wd/hub'; // Replace with your Selenium server address

        // Create a WebDriver instance
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

        try {
            // Navigate to the URL
            $driver->get($url);

            // Find the button by ID and click it
            $driver->findElement(WebDriverBy::id($buttonId))->click();

            // Return a JSON response
            return response()->json(['status' => 'Task Completed']);
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json(['status' => 'Error', 'message' => $e->getMessage()], 500);
        } finally {
            // Quit the driver
            $driver->quit();
        }
    }
}
