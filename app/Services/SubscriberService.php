<?php

namespace App\Services;

use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SubscriberService
{

    /**
     * @param int $topicId
     * @param string $url
     * 
     * @return bool
     */
    public function create(int $topicId, string $url): bool
    {
        DB::beginTransaction();

        $subscriber = new Subscriber;
        $subscriber->url = $url;
        $subscriber->topic()->associate($topicId);
        $subscriber->save();
        DB::commit();

        return true;
    }

    /**
     * @param int $topicId
     * @param string $url
     * 
     * @return bool
     */
    public function isSubscriptionExist(int $topicId, string $url): bool
    {
        return Subscriber::where('topic_id', $topicId)->where('url', $url)->exists();
    }


    /**
     * @param mixed $subscribers
     * @param mixed $payload
     * 
     * @return bool
     */
    public function publish($subscribers, $payload): array
    { 
        $client = new Client();  
        foreach ($subscribers as $subscriber) { 
            try {
                $client->request('POST', $subscriber->url, [
                    'headers' => [ 
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ], 'json' => [
                        'topic' => $subscriber->topic->topic,
                        'data' => $payload
                    ]
                ]); 
            } catch (\Throwable $th) {
                Log::error('An error occured while publishing', $th->getMessage());
            }
        };
       return [true];
    }
}