<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Post;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Enums\PostStatus;

class Home extends Component
{
    public function render()
    {
        // // Use unsplash API
        // // Configuration
        // \Unsplash\HttpClient::init([
        //     'applicationId' => 'PTLofgTCyG3DdSy0VlHNnc3J1XvwMFQqoFvorI0yk94',
        //     'secret' => 'goVuwhRJCkSK7WJU8OSESmXB0lHulCxy5wTaNqweSXs',
        //     'callbackUrl' => 'http://fiblo.test/',
        //     'utmSource' => 'Fiblo'
        // ]);

        // // Get some random photos
        // $photos = \Unsplash\Photo::random(['query' => 'moutain'])->urls['regular'];
        $photos = env('DUMMY_IMAGE');

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
        $posts = Post::exclude('body', 'status', 'updated_at')
            ->postState(PostStatus::Published)
            ->latest()
            ->limit(6)
            ->get();

        if (auth()->user() && auth()->user()->follows->count()) {
            $posts = auth()->user()
                ->followedPost()
                ->exclude('body', 'status', 'updated_at')
                ->postState(PostStatus::Published)
                ->latest()
                ->limit(6)
                ->get();
        }

        return view('livewire.home', compact('posts', 'responseBody', 'greet', 'photos'));
    }
}