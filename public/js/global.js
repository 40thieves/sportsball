var global = global || {};

global.triggerForm = {
	_init : function () {
		$('select[name="fixtureID"').bind('change',function(evt){
			$.get('/api/fixture/' + $(this).val() + '/teams')
			.done(function(response){
				console.log('Request for Teams Succeeded with response',response);
				
				var teamContainer = $('select[name="teamID"]');
				if ( !teamContainer.length ) {
					teamContainer = $('<select>').attr('name','teamID');
					$('select[name="fixtureID"').after(teamContainer);
				}
				
				var homeTeam = $('<option>').attr('value',response.home_team.teamID).html(response.home_team.team_details.name);				
				var awayTeam = $('<option>').attr('value',response.away_team.teamID).html(response.away_team.team_details.name);				
				
				teamContainer.html('').append($('<option>').html('SELECT')).append(homeTeam).append(awayTeam);
				
				//Not quite working
				teamContainer.unbind('change').bind('change',function(evt){
					$.get('/api/team/' + $(this).val() + '/players')
					.done(function(response){
						console.log('Request for Player Succeeded with response',response);
						var playerContainer = $('select[name="playerID"]');
						if ( !playerContainer.length ) {
							playerContainer = $('<select>').attr('name','playerID');
							$('select[name="teamID"]').after(playerContainer);
						}

						playerContainer.html('').append( $('<option>').html('SELECT') );
						
						$(response.players).each(function(){
							playerContainer.append( $('<option>').attr('value',this.playerID).html(this.name) );
						});
					})
					.fail(function(response){
						console.log('Request for Player Failed with response',response);
					});
				});
			})
			.fail(function(response){
				console.log('Request for Teams Failed with response',response);
			});

		});
		$('form').bind('submit',function(evt){
			evt.preventDefault();
			$.post('/api/events',$(this).serializeArray())
			.done(function(response){
				console.log('Event Post Succeeded with response',response);
			})
			.fail(function(response){
				console.log('Event Post Failed with response',response);
			});
		});
		
	}
};

global.ticker = {
	update : function(data) {
		var ticker = $('#ticker');
		var event = data.event;

		// Event name - event.event_type.label
		// Team name - event.team.name
		// Player name - event.player.name
		// Minute - event.minute

		var item = $('<p>');
		ticker.prepend(item);
		item.append($('<span>').addClass('event').html(event.event_type.label));
		item.append($('<span>').addClass('team').html(event.team.name));
		item.append($('<span>').addClass('player').html(event.player.name + ' ' + event.minute));
	}
};

global.goalIncrementer = function(data) {
	var $goals = $('#team-goals-' + data.event.teamID)
	,	newGoals = parseInt($goals.html(), 10) + 1
	;
	$goals.html(newGoals);
};

$(document).ready(global.triggerForm._init);