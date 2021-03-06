<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriptionRequest;
use App\Models\Topic;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    /**
     * Create a new subscription
     * 
     * @param \App\Http\Requests\CreateSubscriptionRequest $request
     * @param \App\Models\Topic $topic
     * @param \App\Services\SubscriberService $subscriberService
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(CreateSubscriptionRequest $request, Topic $topic, SubscriberService $subscriberService)
    { 
        if ($subscriberService->isSubscriptionExist($topic->id, $request->url)) {
            return $this->errorResponse('Duplicate Entry: Subscription for this already exists', [], 400);
        }
        else if (!$subscriberService->create($topic->id, $request->url)) {
            return $this->errorResponse('An error occured. Please try again');
        }

        return $this->successResponse('Subscription successfully created', [
            'url' => $request->url,
            'topic' => $topic->topic
        ]);
    }
}
