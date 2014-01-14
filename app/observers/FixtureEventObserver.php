<?php

class FixtureEventObserver {

	public function created($model)
	{
		Pusherer::trigger('fixture_' . $model->fixtureID, 'event_' . $model->eventID, array(
			'event' => $model->toArray(),
		));
	}

}