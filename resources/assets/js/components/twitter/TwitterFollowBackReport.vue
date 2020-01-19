<template>
	<div>
		<highcharts :options="chartOptions"></highcharts>
		
	</div>
</template>

<script>
	
	export default {
		data() {
      		return {
	      	url:$("#base_url").val(),
	      	chartOptions: {
	      		title: {
			        text: 'Daily reports Follow back'
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
        			name: 'Follow back',
		          	data: [] // sample data
		        }]
		      }
	      }
    },
    props:['date','followback'],
      

    methods:{

    },
    mounted(){
    	this.chartOptions.series[0].data = this.followback;
		this.chartOptions.xAxis.categories = this.date; 
    },
        
  }
</script>
