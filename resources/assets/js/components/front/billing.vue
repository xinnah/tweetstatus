<template>
    <div>
      <div class="billing_section" v-if="purchase_check" id="billing-section">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="heading">
              <h1 class="title">Billing address</h1>
            </div>
          </div>
          <div class="panel-body">
            <div id="registration_form">
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <label for="first_name">First name</label>
                  <div class="form-group">
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" required class="form-control" value="" autocomplete="off" />
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <label for="last_name">Last name</label>
                  <div class="form-group">
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required class="form-control" value="" autocomplete="off" />
                  </div>
                </div>
                
                <div class="col-xs-12">
                  <label for="email">Email</label>
                  <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Email" required class="form-control" value="" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-12">
                  <label for="address">Address</label>
                  <div class="form-group">
                      <input type="text" name="address" id="address" class="form-control" placeholder="Address" required="" autocomplete="off" oncopy="return false;" onpaste="return false;" oncut="return false;"/>
                  </div>
                </div>
                <div class="col-xs-12">
                  <label for="address_two">Address 2 (Optional)</label>
                  <div class="form-group">
                      <input type="text" name="address_two" id="address_two" class="form-control" placeholder="Address 2" required="" autocomplete="off" oncopy="return false;" onpaste="return false;" oncut="return false;"/>
                  </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <label for="Country">Country</label>
                  <div class="form-group">
                    <input type="text" name="country" id="Country" placeholder="Country Name" required class="form-control" value="" autocomplete="off" />
                  </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <label for="State">State</label>
                  <div class="form-group">
                    <input type="text" name="State" id="State" placeholder="State" required class="form-control" value="" autocomplete="off" />
                  </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <label for="Zip">Zip</label>
                  <div class="form-group">
                      <input type="text" name="Zip" class="form-control" id="Zip" placeholder="Zip" required="" autocomplete="off" oncopy="return false;" onpaste="return false;" oncut="return false;"/>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <button type="submit" name="btn_register" id="btn_register" class="btn btn-default align-center" @click="billing_user">Order Confirm</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="payment_check" v-if="successfully_status">
        <div class="payment_section">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="heading">
                <h1 class="title">Warning </h1>
              </div>
            </div>
            <div class="panel-body">
              <h4 class="text-center">You are already purchase a package.</h4>
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
    export default {
        data(){
          return {
            url:$("#base_url").val(),
            successfully_status:false,
            purchase_check:false,
          }
        },
        props:['planid','userid'],
        
        methods:{
            
          billing_user(){
            this.$emit("billingcheck", true);
            
          },
          
        },
        mounted() {
          
         let getData = {
            fk_package_id:this.planid,
            fk_user_id:this.userid
          };
          axios.post(this.url+'/check-user-purchase-package',getData).then( response=> {
            if(response.data === 'yes'){
              this.$notify({
                group: 'notificationStatus',
                title: 'Success',
                text: "Successfully! done",
                type:'success'
              });
              this.successfully_status = true;
              this.purchase_check = false;
            }else{
              this.successfully_status = false;
              this.purchase_check = true;
            }

          }); 
        }
    }
</script>
