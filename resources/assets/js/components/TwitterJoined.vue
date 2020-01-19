<template>
	<div>
    <div class="row">
      <div class="col-md-offset-2">
        <p class="text-center" style="color:red">* choose a username to see</p>
        <div class="form-group col-sm-12">
          
            <label for="keyword" class="col-sm-4 control-label ">Username</label>
            <div class="input-group col-sm-8 no_padding">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
              </div>
              <input id="keyword" v-model="username" type="text" class="form-control" name="keyword" placeholder="type username" required autofocus="off" @keyup.enter="searchUser">
            </div>
        </div>
        <div class="form-group col-sm-12">
          <div class="col-md-6 col-md-offset-4">
              <button type="button" @click="searchUser" class="btn btn-info btn-sm">
                  Check join time
              </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="loader" class="loader-datatable" id="loader-joined"><span><img :src="url+'/public/loader.gif'"></span></div>
    <div class="join_section" v-if="result">
      <div class="alert alert-success alert-dismissable ">
         <blockquote class="blockquote"><h4><b><i class="fas fa-clipboard-check"></i> {{resultData}}</b></h4> </blockquote>
      </div>
    </div>
	</div>
</template>
<script>
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        username:'',
        result:false,
        loader:false,
        resultData:''
      }
    },
    props:['username'],
    methods:{
      searchUser(){
        if(this.username !== null && this.username !== '' && this.username !== ' '){
          var name = this.username;
          this.loader=true;
          let getData ={
            username:name
          }
          axios.post(this.url+'/twitter-check-user',getData).then( response=> {

            if(response.data.status === 'success'){
              this.result = true;     
              this.loader=false;
              if(response.data.result === 'no'){
                this.resultData = "No user found";
              }else{
                this.resultData = '@'+name+' joined twitter on '+response.data.result;
              }
            }
          });
        }
      }
    },
    mounted() {
      
    }
  }
</script>