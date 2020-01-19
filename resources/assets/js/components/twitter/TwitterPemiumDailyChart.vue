<template>
	<div style="widows: 100%">
		<highcharts :options="chartOptions"></highcharts>	
	</div>
</template>

<script>
	export default {
		data() {
      		return {
	      	url:$("#base_url").val(),
	      	date:'',
	      	totalUnfollowers:'',
	      	totalFollowers:'',
	      	chartOptions: {
	      		title: {
			        text: 'Daily reports combined Followers and Unfollowers'
			    },
			    xAxis: {
			        categories: []
			    },
			    labels: {
			        items: [{
			            //html: 'Follow back  non-follow back',
			            style: {
			                left: '50px',
			                top: '18px',
			                //color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
			            }
			        }]
			    },
			    series: [{
			    	type: 'column',
        			name: 'Unfollowers',
		          	data: [] // sample data
		        },{
			        type: 'column',
			        name: 'Followers',
			        data: []
		        },{
			        type: 'pie',
			        name: 'Total ',
			        data: [{
			            name: 'Unfollowers',
			            y: 0,
			            //color: Highcharts.getOptions().colors[1] // John's color
			        }, {
			            name: 'Followers',
			            y: 0,
			            //color: Highcharts.getOptions().colors[2] // Joe's color
			        }],
			        center: [100, 80],
			        size: 100,
			        showInLegend: true,
			        dataLabels: {
			            enabled: true
			        }
			    }]
		      }
	      }
    },
    
    props:['totalUnfollowers', 'totalFollowers', 'date'],
    
    http: {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
      
    methods:{
    },
    mounted(){
		this.chartOptions.series[0].data = this.totalUnfollowers;
		this.chartOptions.series[1].data = this.totalFollowers;
		
		this.chartOptions.series[2].data[0].y = this.totalUnfollowers;
		this.chartOptions.series[2].data[1].y = this.totalFollowers;
		this.chartOptions.xAxis.categories = this.date;
    },
        
  }
</script>
