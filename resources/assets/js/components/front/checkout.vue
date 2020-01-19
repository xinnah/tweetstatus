<template>
    <div>
        <notification></notification>
        <div class="auth_check" v-if="auth_check && auth_status">
            <login @logincheck="setLogin"></login>
        </div>
        <div class="billing_check" v-if="billing_status">
            <billing :planid="plan.id" :userid="user.id" @billingcheck="setBilling"></billing>
        </div>
        <div class="payment_check" v-if="payment_status">
            <payments :planid="plan.id" :userid="user.id" @paymentcheck="setPayment"></payments>
        </div>
        <div class="payment_check" v-if="successfully_status">
            <div class="payment_section">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <div class="heading">
                    <h1 class="title">Successfully </h1>
                  </div>
                </div>
                <div class="panel-body">
                    <h4 class="text-center">Successfully done.</h4>
                    <div class="my-lg-gutter"></div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <a :href="url+'/dashboard'" type="submit" id="btn_login" class="btn btn-default align-center" >Go to your dashboard</a>
                        </div>
                    </div> 
                </div>
                
              </div>
            </div>
        </div>
    </div>
</template>

<script>
    import login from './login-registration.vue';
    import billing from './billing.vue';
    import payments from './payment.vue';
    import notification from './../NotificationMsg.vue';
    export default {
        data(){
          return {
            url:$("#base_url").val(),
            auth_status:false,
            billing_status:false,
            payment_status:false,
            successfully_status:false
          }
        },
        props:['plan','user'],
        computed: {
            auth_check(){
                
                if(this.user !== null){
                    this.auth_status=false;
                    this.billing_status = true;
                    return false;
                }else{
                    this.auth_status=true;
                    this.billing_status = false;
                    return true;
                }
            }

        },
        components:{
          login,billing,payments, notification
        },
        methods:{
          setLogin(status){
            if(status === true){
                this.billing_status = true;
                this.auth_status = false;
            }else{
                this.billing_status = false;
                this.auth_status = true;
            }
          },
          setBilling(status){
            if(status === true){
                this.billing_status = false;
                this.payment_status = true;
            }else{
                this.billing_status = true;
                this.payment_status = false;
            }
          },
          setPayment(status){
            if(status === true){
                this.payment_status = false;
                this.successfully_status = true;
            }else{
                this.payment_status = true;
                this.successfully_status = false;
            }
          },
          
        },
        mounted() {
            
        }
    }
</script>