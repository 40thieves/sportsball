<?php

class TwitterFixtureController extends Controller {

	public static function getSingle($id)
	{
		$fixture = Fixture::getSingleOngoing($id);

		if ($fixture->hashTag) {
			$hashTag = $fixture->hashTag;
		}
		else {
			$hashTag = "ENGvECU";
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
		var_dump($thesaurus);
		
		foreach ($tweets->statuses as $t) {
			echo $t->text . '<br/>';
			foreach ($thesaurus['goal'] as $keyword) {
				if (strstr($t->text, $keyword)) {
					echo $keyword;
				}
				else {
					echo 'SAVED!!!';
				}
			}											
		}
	}
}