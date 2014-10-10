<?php

class AdminTeamController extends AdminController {

	public function showOverview()
	{
		$this->layout->content = View::make('admin/teams',[
			'activePanel' => 'teams',
			'teams' => Team::get()
		]);
	}

	public function showSingle($id)
	{
		$this->layout->content = View::make('admin/teams/single',[
			'activePanel' => '',
			'team' => Team::find($id)
		]);
	}

	public function showNew()
	{
		$this->layout->content = View::make('admin/teams/new',[
			'activePanel' => ''
		]);
	}

	public function postNew()
	{
		Team::create([
			'name' => Input::get('name')
		]);

		$this->showOverview();
	}

}