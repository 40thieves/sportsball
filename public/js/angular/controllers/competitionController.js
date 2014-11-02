angular.module('AdminApp.Controllers',[])

	.controller('CompetitionController',function($scope,$http,Competition)
	{
		$scope.CompetitionData = {};

		$scope.loading = true;

		Competition.get()
			.success(function(data)
			{
				$scope.competitions = data;
				$scope.loading = false;
			});

		$scope.submitCompetition = function()
		{
			$scope.loading = true;

			Competition.save($scope.CompetitionData)
				.success(function(data)
				{
					Comment.get()
						.success(function(getData)
						{
							$scope.competitions = getData;
							$scope.loading = false;
						});
				})
				.error(function(data)
				{
					console.log(data);
				});
		}

		$scope.deleteCompetition = function()
		{
			$scope.loading = true;

			Competition.destroy(id)
				.success(function(data)
				{
					Competition.get()
						.success(function(getData)
						{
							$scope.competitions = getData;
							$scope.loading = false;
						})
				});
		}
	})