<template>
	<div>
		<div class="panel">
			<div class="panel-body">
				<div v-if="checkLoad">
		          <div class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div>
		        </div>	
			</div>
		</div>
		<div class="chart-group" v-if="!checkLoad">
			<div class="row">
				<div class="col-sm-12">
					<highcharts :options="chartOptions"></highcharts>
				</div>
			</div>
			<br>
			<div class="row" v-if="premium">
				<premiumCharts :totalUnfollowers="totalUnfollowers" :totalFollowers="totalFollowers" :date="chartOptions.xAxis.categories"></premiumCharts>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<followbackReport :date="chartOptions.xAxis.categories" :followback="chartOptions.series[0].data"></followbackReport>
				</div>
				<div class="col-sm-6">
					<nonFollowbackReport :date="chartOptions.xAxis.categories" :nonfollowback="chartOptions.series[1].data"></nonFollowbackReport>
				</div>
			</div>
			<br>
		</div>
	</div>
</template>

<script>
	import followbackReport from './TwitterFollowBackReport.vue';
  	import nonFollowbackReport from './TwitterNonFollowBackReport.vue';
  	import premiumCharts from './TwitterPemiumDailyChart.vue';
	export default {
		data() {
      		return {
	      	url:$("#base_url").val(),
	      	checkLoad:false,
	      	date:'',
	      	followback:'',
	      	unfollowBack:'',
	      	premium:false,
	      	totalFollow:'',
	      	totalUnfollow:'',
	      	totalUnfollowers:'',
	      	totalFollowers:'',
	      	chartOptions: {
	      		title: {
			        text: 'Daily reports combined Follow back and non-follow back'
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
		        },{
			        type: 'column',
			        name: 'Non Follow back',
			        data: []
		        },{
			        type: 'pie',
			        name: 'Total ',
			        data: [{
			            name: 'Follow back',
			            y: 0,
			            //color: Highcharts.getOptions().colors[1] // John's color
			        }, {
			            name: 'Non Follow back',
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
    props:['plan'],
    components:{
      followbackReport, nonFollowbackReport, premiumCharts
    },
    http: {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
      

    methods:{
    },
    mounted(){
		this.checkLoad = true;
    	setTimeout(() => {
	    	let getData ={
				pid:this.plan.id
			}
			axios.get(this.url+'/twitter-user-daily-report/'+this.plan.id).then( response=> {
				
				if(response.data.type === 'success'){
					//console.log(response.data);
					this.totalfollow = response.data.value.totalFollow;
					this.totalUnfollow = response.data.value.totalUnfollow;
					this.followback = response.data.value.followback;
					this.unfollowBack = response.data.value.unfollowBack;
					this.totalUnfollowers = response.data.value.totalUnfollowers;
					this.totalFollowers = response.data.value.totalFollowers;
					this.premium = response.data.value.pemium;

					this.chartOptions.series[0].data = response.data.value.followback;
					this.chartOptions.series[1].data = response.data.value.unfollowBack;
					
					this.chartOptions.series[2].data[0].y = response.data.value.totalfollow;
					this.chartOptions.series[2].data[1].y = response.data.value.totalUnfollow;
					this.chartOptions.xAxis.categories = response.data.value.date;
				}
				this.checkLoad = false;
			});
			console.log(this.chartOptions);
		}, 2000); 
    },
        
  }
</script>
