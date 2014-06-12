<?php

class TwitterFixtureController extends Controller {

	public static function getSingle($id)
	{
		$fixture = Fixture::getSingleOngoing($id);

		if ($fixture->hashTag) {
			$hashTag = $fixture->hashTag;
		}
		else {
			$hashTag = "ENGvHON";
		}

		$latestTweets = Twitter::getSearch([
			'q' => $hashTag,
			'count' => 20,
			'include_entities' => 0			
		]);

		if ($latestTweets) {
			if ( $event = self::detectEvents($latestTweets,$fixture) ) {
				FixtureEvent::observe(new FixtureEventObserver);
				FixtureEvent::createSingle($event);
			}
		}
	}

	public static function detectEvents($tweets,$fixture) {
		$thesaurus = Config::get('app.thesaurus');
				
		//This will need refining
		$goalProbability = 0;
		$homeTeamProbability = 0;
		$awayTeamProbability = 0;

		$count = sizeof($tweets->statuses);

		//Loop through each status
		foreach ($tweets->statuses as $t) {
			
			//Look for goal or synonyms
			foreach ($thesaurus['goal'] as $keyword) {
				if (strstr($t->text, $keyword)) {
					echo $t->text . '<br/>';
					echo $keyword;

					$goalProbability += 1 / $count;
		
					self::detectScore($t->text);

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
		}

		if ( $goalProbability > 0.5 ) {
			return [
				'eventID' => 1,
				'teamID' => $homeTeamProbability > $awayTeamProbability ? $homeTeamProbability : $awayTeamProbability,
				'minute' => 10
			];
		}
		
	}

	public static function detectScore($tweet) {
		$currentScore = null;
		//Try and find something which resembles a score
		//??Should this only be applied to tweets which mention events
		if ( $scoreMentioned = preg_match_all("/\d\-\d/", $tweet) ) {
			echo "Score mentioned";

			//We may be onto something
			//Another day though
			// if ($scoreMentioned != $currentScore) {

			// }
		}

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