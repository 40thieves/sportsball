<?php

class FixtureEventObserver {

	public function created($model)
	{
		$model->load('eventType', 'team', 'player');

		$channelName = 'fixture_' . $model->fixtureID;

		if ($model->eventID == 1)
		{
			Pusherer::trigger($channelName, 'event_goal', array(
				'event' => $model->toArray(),
			));
		}

		Pusherer::trigger($channelName, 'event_all', array(
			'event' => $model->toArray(),
		));
	}

}