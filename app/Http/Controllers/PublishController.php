<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublishRequest;
use App\Jobs\PublishMessageToTopic;
use App\Models\Topic;
use App\Services\TopicService;
use Illuminate\Http\Request;

class PublishController extends Controller
{
    /**
     * @param PublishRequest $request
     * @param Topic $topic
     * 
     * @return Illuminate\Http\Response
     */
    public function publish(PublishRequest $request, Topic $topic)
    {
        $topicSubscribers = $topic->subscriber; 
        
        // dispatch job
        PublishMessageToTopic::dispatch($topicSubscribers, $request->payload);

        return $this->successResponse('Message succesfully sent to subscribers');
    }
}
