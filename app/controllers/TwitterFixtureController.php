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
			self::detectEvents($latestTweets);
		}
	}

	public static function detectEvents($tweets) {
		$thesaurus = Config::get('app.thesaurus');
				
		self::detectScore("It's 1-0");

		//Loop through each status
		foreach ($tweets->statuses as $t) {
			
			//Look for goal or synonyms
			foreach ($thesaurus['goal'] as $keyword) {
				if (strstr($t->text, $keyword)) {
					echo $t->text . '<br/>';
					echo $keyword;
		
					self::detectScore($t->text);

					//Break the loop - we have our mention of a goal
					break;
				}				
			}											
		}
	}

	public static function detectScore($tweet) {
		$currentScore = null;
		//Try and find something which resembles a score
		//??Should this only be applied to tweets which mention events
		if ( $scoreMentioned = preg_match_all("/\d\-\d/", $tweet) ) {
			echo "Score mentioned";

			//We may be onto something
			if ($scoreMentioned != $currentScore) {

			}
		}

	}
}