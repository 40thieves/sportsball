<?php

class AdminController extends BaseController {

	protected $layout = 'layouts.master';

	public function showIndex()
	{
		$fixtures = Fixture::getAllOngoing();

		$this->layout->content = View::make('admin/admin',[
			'fixtures' => $fixtures,
			'activePanel' => 'overview'
		]);
	}

	public function showFixtures()
	{
		$ongoingFixtures = Fixture::getAllOngoing();
		$pastFixtures = Fixture::getAllPast();

		$this->layout->content = View::make('admin/fixtures',[
			'activePanel' => 'fixtures',
			'ongoingFixtures' => $ongoingFixtures,
			'recentFixtures' => $pastFixtures
		]);
	}

	public function showFixtureDetails($id)
	{
		$fixture = Fixture::getSingle($id);

		//Temporary code for data reformatting
		// foreach ($fixture->twitterresponses as $response) {
		// 	if ($tweets = explode("###",$response->content)) {
		// 		foreach ($tweets as $tweet) {
		// 			Tweet::createSingle($tweet,$response->twitterresponseID);
		// 		}
		// 	}
		// }

		$this->layout->content = View::make('admin/fixtures/single',[
			'activePanel' => '',
			'fixture' => $fixture
		]);
	}

	public function showFixtureAnalysis($id)
	{
		$fixture = Fixture::getSingle($id);

		$words = [];

		foreach ($fixture->twitterresponses as $response) {
			
			foreach ($response->tweets as $tweet) {
				$tweetwords = explode(" ",$tweet->content);

				foreach ($tweetwords as $w) {
					if (array_key_exists($w, $words)) {
						$words[$w]++;
					}
					else {
						$words[$w] = 1;
					}
				}		
			}
			
		}

		array_multisort($words,SORT_DESC);

		$this->layout->content = View::make('admin/fixtures/single/analysis',[
			'activePanel' => '',
			'fixture' => $fixture,
			'words' => $words
		]);
	}

	public function showNewFixture()
	{
		$teams = Team::getAll();

		$this->layout->content = View::make('admin/fixtures/new',[
			'activePanel' => '',
			'teams' => $teams
		]);	
	}

	public function postNewFixture()
	{
		Fixture::createSingle();

		$this->showNewFixture();
	}

	public function showNewFact($id)
	{
		$fixture = Fixture::getSingle($id);
		
		$this->layout->content = View::make('admin/fixtures/single/facts',[
			'activePanel' => '',
			'fixture' => $fixture
		]);
	}

	public function postNewFact()
	{
		return 'test';
	}

}