## Sportsball

### Realtime sports API

API for delivering sports statistics and updates over websockets, built on Laravel, for Portsmouth University Web Research unit.

#### Installation

* Clone down: `git clone git@github.com:40thieves/sportsball.git`
* `chmod -R 777 app/storage`
* Add Pusher API key to `app/config/packages/artdarek/pusherer/config.php`
* Create `sportsball` database

#### Database Seeding

Import the `create.sql` file into your database.

If you have `composer` run `php artisan migrate`. Otherwise, follow these steps:

* Add `isOngoing` attribute (of type string, length 1) to the `fixture` table
* Add `teamID` attribute (of type integer) to the `fixtureEvent` table
* Create foreign key between `teamID` on the `fixtureEvent` table and `teamID` on the `team` table
* Rename `event` table to `eventType`

#### Usage

The homepage will display a list of ongoing matches (these are set using the `isOngoing` flag in the `fixture` table). Any new events sent over WebSockets will be parsed and updated on this page.

 On another tab, or in another browser, navigate to `/trigger`. Create a new event using the form. The event will be added to the database and send over WebSockets to any other active clients.

#### Documentation

##### WebSocket channels

A new channel is created for each `Fixture`. The channels are generally named `fixture_fixtureID`, so for example,  where `fixtureID` is 1, the channel will be `fixture_1`.

Currently, there are two events that are sent over channels:

* `event_goal`
	* Triggered when a new goal event is created
	* Contains event data like event name, team name, player name, minute
* `event_all`
	* Triggered when any new event type is created
	* Includes goals
	* Same data structure as `event_goal`

##### Quick and dirty RESTful API docs

* `/api`
	* `/fixture` - list of ongoing fixtures
	* `/fixture/:id` - teams, score, stadium, events
		* `/score` - calculated score
		* `/teams` - teams playing
		* `/events` - list of events
		* `/stadium` - stadium
	* `/events` - list of all events from ongoing fixtures
		* `/events/:id` - single event
	* `/team` - list of teams
	* `/team/:id` - team info, players
		* `/players` - team players

