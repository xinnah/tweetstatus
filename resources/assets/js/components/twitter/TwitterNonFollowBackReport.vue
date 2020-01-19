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
			        text: 'Daily reports non-follow back'
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
        			name: 'Non Follow back',
		          	data: [] // sample data
		        }]
		      }
	      }
    },
    props:['date','nonfollowback'],
      

    methods:{

    },
    mounted(){
    	this.chartOptions.series[0].data = this.nonfollowback;
		this.chartOptions.xAxis.categories = this.date; 
    },
        
  }
</script>
