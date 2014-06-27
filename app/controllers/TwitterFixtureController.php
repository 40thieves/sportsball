<?php

class TwitterFixtureController extends Controller {

	public static function getAll()
	{		
		$fixtures = Fixture::getAllOngoing();

		foreach ($fixtures as $fixture) {
			//Setup current goals
			$goals = [];
			foreach($fixture->events as $event)
			{
				//TODO: Only check for events if last event reported at least x seconds ago
				//People keep tweeting about things causing duplicate events
				// echo date_diff($event->minute,date('m/d/Y h:i:s a', time()));
				// if (date_diff($event->minute,date('m/d/Y h:i:s a', time()))) {
				// 	return false;
				// }

				// Goals
				if ($event->eventID == 1)
				{
					if ( ! isset($goals[$event->teamID]))
						$goals[$event->teamID] = 1;
					else
						$goals[$event->teamID]++;
				}
			}

			$fixture->homeTeam->goals = isset($goals[$fixture->homeTeam->teamID]) ? $goals[$fixture->homeTeam->teamID] : 0;
			$fixture->awayTeam->goals = isset($goals[$fixture->awayTeam->teamID]) ? $goals[$fixture->awayTeam->teamID] : 0;

			if ($fixture->hashTag) {
				$hashTag = $fixture->hashTag;
			}
			else {
				$hashTag = "#ITAvsCRC";
			}

			$latestTweets = Twitter::getSearch([
				'q' => $hashTag,
				'count' => 20,
				'include_entities' => 0			
			]);
			
			//Lets store the data
			$tweets = [];

			foreach ($latestTweets->statuses as $tweet) {
				array_push($tweets,$tweet->text);
			}
			$tweets = implode("###",$tweets);

			$twitterresponse = TwitterResponse::createSingle($tweets,$fixture->fixtureID);

			if ($latestTweets) {
				if ( $event = self::detectEvents($latestTweets,$fixture) ) {				
					FixtureEvent::observe(new FixtureEventObserver);
					FixtureEvent::createSingle($event,$fixture);
				}
			}			
		}

	}

	public static function detectEvents($tweets,$fixture) {
		$thesaurus = Config::get('app.thesaurus');
				
		//This will need refining
		$goalProbability = 0;
		$homeTeamProbability = 0;
		$awayTeamProbability = 0;

		//Need a flag to display info in response
		$tweetsCounted = 0;
		$goalCount = 0;
		$concedeCount = 0;
		$superCount = 0;
		$scoreCounted = 0;
		$explCount = 0;

		$count = sizeof($tweets->statuses);

		//Loop through each status
		foreach ($tweets->statuses as $t) {

			
			//Look for goal or synonyms
			foreach ($thesaurus['goal'] as $keyword) {
				if (strstr($t->text, $keyword)) {					

					$tweetsCounted++;
					$goalCount++;

					$goalProbability += 1 / $count;		

					$team = self::detectTeam($t->text,$fixture->homeTeam->name,$fixture->awayTeamName);

					if ($team == 'home') {
						$homeTeamProbability += 1 / $count;
					}
					elseif ($team == 'away') {
						$awayTeamProbability += 1 / $count;
					}

					//Break the loop - we have our mention of a goal
					break;
				}								
			}

			//Look for goal or synonyms
			foreach ($thesaurus['conceded'] as $keyword) {
				if (strstr($t->text, $keyword)) {					

					$tweetsCounted++;
					$concedeCount++;

					$goalProbability += 1 / $count;		

					$team = self::detectTeam($t->text,$fixture->homeTeam->name,$fixture->awayTeamName);

					if ($team == 'home') {
						$awayTeamProbability += 1 / $count;
					}
					elseif ($team == 'away') {
						$homeTeamProbability += 1 / $count;
					}

					//Break the loop - we have our mention of a goal
					break;
				}								
			}

			//Checking all tweets for all of these
			//Should we set a breakout flag??
			foreach ($thesaurus['superlatives'] as $keyword) {
				if (strstr($t->text, $keyword)) {

					$tweetsCounted++;
					$superCount++;
					
					$goalProbability += 0.5 / $count;

					$team = self::detectTeam($t->text,$fixture->homeTeam->name,$fixture->awayTeamName);

					//Reduced probabilities here??
					//Is a superlative less likely to be about a particular team??
					if ($team == 'home') {
						$homeTeamProbability += 0.5 / $count;
					}
					elseif ($team == 'away') {
						$awayTeamProbability += 0.5 / $count;
					}

					//Break the loop - we have our mention of a superlative
					break;
				}
			}

			//Checking all tweets for all of these
			//Should we set a breakout flag??
			foreach ($thesaurus['expletives'] as $keyword) {
				if (strstr($t->text, $keyword)) {

					$tweetsCounted++;
					$explCount++;
					
					$goalProbability += 0.5 / $count;

					$team = self::detectTeam($t->text,$fixture->homeTeam->name,$fixture->awayTeamName);

					//Reduced probabilities here??
					//Is an expletive less likely to be about a particular team??
					if ($team == 'home') {
						$awayTeamProbability += 0.5 / $count;
					}
					elseif ($team == 'away') {
						$homeTeamProbability += 0.5 / $count;
					}

					//Break the loop - we have our mention of a superlative
					break;
				}
			}													
			
			//Need to expand for feasibility - perhaps check if we 
			if ( $team = self::detectScore($t->text,$fixture) ) {
				
				$tweetsCounted++;
				$scoreCounted++;

				if ($team == 'home') {
					$homeTeamProbability += 1 / $count;
				}
				elseif ($team == 'away') {
					$awayTeamProbability += 1 / $count;
				}

				$goalProbability += 1 / $count;
			}
		}

		$likelyScorer = $homeTeamProbability > $awayTeamProbability ? $fixture->homeTeam->teamID : $fixture->awayTeam->teamID;
		
		//Output something
		echo "Tweets Counted: " . $tweetsCounted . "\n";
		echo "Tweets Counted (Goals): " . $goalCount . "\n";
		echo "Tweets Counted (Conceded): " . $concedeCount . "\n";
		echo "Tweets Counted (Superlatives): " . $superCount . "\n";
		echo "Tweets Counted (Expletives): " . $explCount . "\n";
		echo "Tweets Counted (Score): " . $scoreCounted . "\n";
		echo "Probability: " . $goalProbability . "\n";
		echo "Likely Scorer: " . $likelyScorer . "\n";

		//FIXME: Dropping to 40% may need to tweak in future		
		if ( $goalProbability > 0.4 ) {
			return [
				'eventID' => 1,
				'teamID' => $likelyScorer,
				'minute' => date('Y-m-d H:i:s')
			];
		}
		
	}

	public static function detectScore($tweet,$fixture) {
		
		$currentScore = null;		

		//Try and find something which resembles a score		
		if ( $scoreMentioned = preg_match_all("/(?<homeGoals>\d)\-(?<awayGoals>\d)/", $tweet,$matches) ) {
			
			//If people are tweeting about an increased score then there is probably an event to report
			if ( ( $matches['homeGoals'][0] + $matches['awayGoals'][0] ) - ( $fixture->homeTeam->goals + $fixture->awayTeam->goals ) >= 1 ) {
				
				//Home or away incremented by 1, lets report it
				//FIXME: Need to expand to recover missed evemts
				if ( $matches['homeGoals'][0] - $fixture->homeTeam->goals === 1 ) {
					return 'home';
				}
				elseif ( $matches['awayGoals'][0] - $fixture->awayTeam->goals === 1 ) {
					return 'away';
				}
			}

		}
		return false;

	}

	public static function detectTeam($tweet,$home,$away) {
		$homeMentioned = strstr($tweet, $home);
		$awayMentioned = strstr($tweet, $away);

		if ($homeMentioned || $awayMentioned) {
			if ($homeMentioned && $awayMentioned) {
				//Too complicated to deal with both teams in one tweet
				return;
			}
			return $homeMentioned ? 'home' : 'away';
		}
		return;

	}
}