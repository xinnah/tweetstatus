<template>
    <div>
        <div class="payment_section" id="payment-check-confirm">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="heading">
                <h1 class="title">Payment method </h1>
              </div>
            </div>
            <div class="panel-body">
                <div v-if="result_error !== ''" class="result_error_section">
                    <div class="alert alert-danger alert-dismissable ">
                        
                        <h4><b> {{result_error}}</b></h4>
                    </div>
                </div>
                <div class="sucess_section" style="text-align:center">
                    <i class="fas fa-check-circle" style="font-size: 100px; color: #58d458;"></i>
                </div>
                <!-- Payment section -->
                <div class="my-lg-gutter"></div>
                <div class="col-xs-12">
                    <div class="form-group">

                        <button type="submit" id="btn_login" class="btn btn-default align-center" @click="paymentConfirm">Confirm</button>
                    </div>
                </div> 
            </div>
            
          </div>
        </div>
        
        
    </div>
</template>

<script>
    export default {
        data(){
          return {
            url:$("#base_url").val(),
            result_error:''
          }
        },
        props:['planid','userid'],
        methods:{
            
            paymentConfirm(){
                let getData = {
                    fk_package_id:this.planid,
                    fk_user_id:this.userid
                };
                axios.post(this.url+'/user-purchase-package',getData).then( response=> {
                    
                    if(response.data.status === 'success'){
                        this.result_error = '';
                        this.$emit("paymentcheck", true);
                    }else{
                        this.result_error = response.data.result;
                    }
                });
                
            },
          
          
        },
        mounted() {
            $('html, body').animate({
              scrollTop: $("#payment-check-confirm").offset().top
            }, 2000);
        }
    }
</script>
