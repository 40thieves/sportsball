<?php

class TwitterDataMiningController extends Controller {

	public static function getAll()
	{		
		$twitterresponses = TwitterResponse::get();

		foreach ($twitterresponses as $response) {
			echo "<p>";
			$tweets = explode('###',$response);

			foreach ($tweets as $tweet) {
				echo $tweet . "</br>";
			}

			echo "</p>";
		}	

	}
}

