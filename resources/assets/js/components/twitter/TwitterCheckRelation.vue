<template>
	<div>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <p class="text-center" style="color:red">* choose 2 usernames!</p>
        <div class="form-group col-sm-12">
          <label for="u1" class="col-sm-4 control-label ">Username 1</label>
          <div class="input-group col-sm-8 no_padding">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input id="u1" v-model="username1" type="text" class="form-control" placeholder="type username 1" required autofocus="off">
          </div>
        </div>
        <div class="form-group col-sm-12">
          <label for="u2" class="col-sm-4 control-label ">Username 2</label>
          <div class="input-group col-sm-8 no_padding">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon2">@</span>
            </div>
            <input id="u2" v-model="username2" type="text" class="form-control" placeholder="type username 2" required autofocus="off" @keyup.enter="searchUser">
          </div>
        </div>
        <div class="form-group col-sm-12">
          <div class="col-md-6 col-md-offset-4">
              <button type="button" @click="searchUser" class="btn btn-info btn-sm">
                  Show friendship
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
        username1:'',
        username2:'',
        result:false,
        loader:false,
        resultData:''
      }
    },
    props:['username1'],
    methods:{
      searchUser(){
        if(this.username1 !== null && this.username1 !== '' && this.username1 !== ' '){
          this.loader=true;
          let getData ={
            username1:this.username1,
            username2:this.username2
          }
          axios.post(this.url+'/twitter-check-friendship',getData).then( response=> {
            this.result=true;
            this.loader=false;
            this.resultData = response.data.result;
          });
        }
      }
    },
    mounted() {
      
    }
  }
</script>