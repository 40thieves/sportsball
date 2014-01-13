## Sportsball

### Realtime sports API

API for delivering sports statistics and updates over websockets, built on Laravel, for Portsmouth University Web Research unit. Still a WIP.

#### Requirements

* [Composer](http://getcomposer.org)

#### Installation

* Clone down: `git clone git@github.com:40thieves/sportsball.git`
* Run `composer install`
* `chmod -R 777 app/storage`

#### (WIP) Usage

On the homepage, open up the JS console. On another tab, or in another browser, navigate to `/trigger`.

#### Quick API docs

* /api
	* /fixture - list of ongoing fixtures
	* /fixture/:id - teams, score, stadium, events
		* /score - calculated score
		* /teams - teams playing
		* /events - list of events
		* /stadium - stadium
	* /events - list of all events from ongoing fixtures
		* /events/:id - single event
	* /team - list of teams
	* /team/:id - team info, players
		* /players - team players
	* /player - list of players
	* /player/:id - player info