var charts = charts || (function(){
    var _args = {}; 
	var totalPaid;			
	var remainingDue;
	var billNames = new Array();
	var amountsDue;

    return {
        init : function(Args) {
            _args = Args;
			totalPaid = _args[0];			
			remainingDue = _args[1];

        },
        doughnut : function() 
		{
            var data = {
			labels: 
			[
				"Total Paid",
				"Remaining Due",
			],
			datasets: 
			[{
				data: [totalPaid, remainingDue],
				backgroundColor: 
				[
					"#FFA500",
					"gray",
				],
				hoverBackgroundColor: 
				[
					"#FFA500",
					"gray",
				]
			}]
			};
			var ctx = document.getElementById("doughnut");
			var myDoughnutChart = new Chart(ctx, {type: 'doughnut', data: data});  
		}		
    };
	

}());