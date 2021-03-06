<?php

namespace App\Jobs;

use App\Services\SubscriberService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
//  implements ShouldQueue
class PublishMessageToTopic
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Subscriber
     */
    public $subscribers;

    /**
     * @var object
     */
    public $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscribers, $payload)
    {
        $this->subscribers = $subscribers;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SubscriberService $subscriberService)
    {   
        $subscriberService->publish($this->subscribers, $this->payload);
    }
}
