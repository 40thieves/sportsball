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
		$fixtures = Fixture::getAllOngoing();

		$this->layout->content = View::make('admin/fixtures',[
			'activePanel' => 'fixtures',
			'fixtures' => $fixtures
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

	public function showTeams()
	{
		$teams = Team::getAll();

		$this->layout->content = View::make('admin/teams',[
			'activePanel' => 'teams',
			'teams' => $teams
		]);
	}


}