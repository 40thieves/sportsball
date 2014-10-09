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
			'competition' => Competition::find($id)
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