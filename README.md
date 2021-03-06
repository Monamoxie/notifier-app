<p align="center"><a href="https://github.com/monamoxie/notifier-app"><img src="/public/logo.png" width="100" height="100"></a></p>

## About

A simple HTTP notification system. A server (or set of servers) will keep track of topics ->
subscribers where a topic is a string and a subscriber is an HTTP endpoint. When a message is published on a topic, it is forwarded to all subscriber endpoints

 
## HOW TO TEST
- Clone the project
- Copy contents of .env.example into .env using `cp .env.example .env`
- Generate an app key using `php artisan key:generate`
- Create a database and fill in the details in your newly created .env file where necessary
- Run the migration command `php artisan migrate`
- Run the seed command `php artisan db:seed` 
-  Run `php artisan serve` in the root directory. This should fire up a development server on port 8000. 
-  cd into 00-subscriber-server-1 directory and run `php artisan serve --port=9000` to fire up a second development server for the subscriber 1 app. You can use any port you want, but remember to include the correct port when subscribing
-  Repeat the above process for 00-subscriber-server-2 using a different port.
-  Now you should have 3 development servers running concurrently


## HOW IT WORKS

- The publisher app is the default app and sits in the root directory
- All HTTP routes are stored in the api routes file of each application, not web
-  The publisher app contains two routes, one to subscribe a url to a topic
-  The second to publish a payload to each subscribers of that topic


## API DOCUMENTATION AND REQUIREMENTS
| URI 	| METHOD 	| BODY 	 	|
|----:	|--------	|------	|
|  /subscribe/{topic:topic}  	|POST        	| url: string -for instance, "http://127.0.0.1:9500/api/technology"   	|
|    /publish/{topic:topic} 	|  POST      	|      	payload: JSON -for instance, {"title": "Technology Update","message": "It's a new day. Whooooray for technology!!!" } |


## AVAILABLE TOPICS IN THE DB SEEDER
- technology
- gender-equality
- agriculture
- business
- world-peace

## WHAT TO EXPECT
- The subscribe endpoint will register the url provided to that topic
- The publish endpoint will dispatch the provided payload to all url actively subscribed and waiting for the payload. For this demo, the sync queue driver was used to keep things simple and because it's just a demo. In production or in real case scenarios, we may have to use a more robust solution like redis.
- When each subscribing server receives data from the publisher, it immediately writes the received data into a log file. 
- To confirm if data actually reached the subscribing server, navigate to it's storage -> logs directory and open the laravel.log file to see the received data.

## License

[MIT license](https://opensource.org/licenses/MIT).
