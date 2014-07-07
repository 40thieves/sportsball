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

	public function showFixture()
	{
		$this->layout->content = View::make('admin/fixture',[
			'activePanel' => 'fixture'
		]);
	}

	public function showTeams()
	{
		$this->layout->content = View::make('admin/teams',[
			'activePanel' => 'teams'
		]);
	}


}