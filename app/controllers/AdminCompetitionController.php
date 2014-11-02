<?php

class AdminCompetitionController extends AdminController {

	public function showOverview()
	{
		$this->layout->content = View::make('admin/competitions',[
			'activePanel' => 'competitions',
			'competitions' => Competition::get()
		]);
	}

	public function showSingle($id)
	{
		$this->layout->content = View::make('admin/competitions/single',[
			'activePanel' => '',
			'competition' => Competition::find($id)->with('teams')->firstOrFail()
		]);
	}

	public function showAddNewTeam($id)
	{
		$competition = Competition::find($id)->with('teams')->firstOrFail();

		$this->layout->content = View::make('admin/competitions/single/teams',[
			'activePanel' => '',
			'competition' => $competition,
			'teams' => Team::get()->filter(function($team) use ($competition){				
				return !in_array($team->id, $competition->teams->lists('teamID'));
			})
		]);
	}

	public function showNew()
	{
		$this->layout->content = View::make('admin/competitions/new',[
			'activePanel' => ''
		]);
	}

	public function postNew()
	{
		Competition::create([
			'name' => Input::get('name')
		]);

		$this->showOverview();
	}

}