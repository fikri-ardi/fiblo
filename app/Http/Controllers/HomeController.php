<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use GuzzleHttp\Client;
use App\Enums\PostStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Use unsplash API
        // Configuration
        \Unsplash\HttpClient::init([
            'applicationId'    => 'PTLofgTCyG3DdSy0VlHNnc3J1XvwMFQqoFvorI0yk94',
            'secret'    => 'goVuwhRJCkSK7WJU8OSESmXB0lHulCxy5wTaNqweSXs',
            'callbackUrl'    => 'http://fiblo.test/',
            'utmSource' => 'Fiblo'
        ]);

        // Get some random photos
        $photos = \Unsplash\Photo::random(['query' => 'moutain'])->urls['regular'];

        /**
         * Get the dynamic greetings word
         * @return string
         */
        $greet = Carbon::greeting();

        /**
         * Quots Data fetch from github quotable API Source
         * @return json
         */
        $client = new Client();
        $url = "https://api.quotable.io/random?tags=love|famous-quotes|wisdom";

        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());

        /**
         * Post Data
         * @return Post
         */
        $posts = Post::exclude('body', 'status', 'updated_at')->postState(PostStatus::Published)->latest()->limit(6)->get();

        if (auth()->user() && auth()->user()->follows->count()) {
            $posts = auth()->user()->followedPost()->exclude('body', 'status', 'updated_at')->postState(PostStatus::Published)->latest()->limit(6)->get();
        }

        return view('home', compact(['posts', 'responseBody', 'greet', 'photos']));
    }
}