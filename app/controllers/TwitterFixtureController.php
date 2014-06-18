<?php

class TwitterFixtureController extends Controller {

	public static function getSingle($id)
	{
		$fixture = Fixture::getSingleOngoing($id);

		if ($fixture->hashTag) {
			$hashTag = $fixture->hashTag;
		}
		else {
			$hashTag = "AUSvsNED";
		}

		$latestTweets = Twitter::getSearch([
			'q' => $hashTag,
			'count' => 20,
			'include_entities' => 0			
		]);

		if ($latestTweets) {
			if ( $event = self::detectEvents($latestTweets,$fixture) ) {				
				FixtureEvent::observe(new FixtureEventObserver);
				FixtureEvent::createSingle($event,$fixture);
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

		$count = sizeof($tweets->statuses);

		//Loop through each status
		foreach ($tweets->statuses as $t) {

			
			//Look for goal or synonyms
			foreach ($thesaurus['goal'] as $keyword) {
				if (strstr($t->text, $keyword)) {					

					$tweetsCounted++;

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

			//Checking all tweets for all of these
			//Should we set a breakout flag??
			foreach ($thesaurus['superlatives'] as $keyword) {
				if (strstr($t->text, $keyword)) {

					$tweetsCounted++;
					
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
			
			//Need to expand for feasibility - perhaps check if we 
			if ( self::detectScore($t->text) ) {
				
				$tweetsCounted++;

				$goalProbability += 0.5 / $count;
			}
		}

		$likelyScorer = $homeTeamProbability > $awayTeamProbability ? $fixture->homeTeam->teamID : $fixture->homeTeam->teamID;
		
		//Output something
		echo "Tweets Counted: " . $tweetsCounted . "\n";
		echo "Probability: " . $goalProbability . "\n";
		echo "Likely Scorer: " . $likelyScorer . "\n";

		//FIXME: Dropping to 40% may need to tweak in future		
		if ( $goalProbability > 0.4 ) {
			return [
				'eventID' => 1,
				'teamID' => $likelyScorer,
				'minute' => date('m/d/Y h:i:s a', time())
			];
		}
		
	}

	public static function detectScore($tweet) {
		
		$currentScore = null;
		//Try and find something which resembles a score		
		if ( $scoreMentioned = preg_match_all("/\d\-\d/", $tweet) ) {
			//This needs work
			//We need to also establish if its the score we are expecting
			//True or false doesn't really cut it
			return true;
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