angular.module('competitionService',[])

	.factory('Competition',function($http)
	{
		return {
			
			get : function() {
				return $http.get('/api/competitions');
			},

			save: function(competitionData)
			{
				return $http({
					method: 'POST',
					url: '/api/competitions',
					headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
					data: $.param(competitionData)
				});
			},

			destroy: function(id)
			{
				return $http.delete('/api/competitions/' + id);
			}
			
		}
	});