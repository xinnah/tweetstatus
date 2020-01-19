<template>
    <div id="login-register">
        <div class="login_section" v-if="login_status">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="heading">
                <h1 class="title">Account Login </h1>
              </div>
            </div>
            <div class="panel-body">
                <div v-if="result_error !== ''" class="result_error_section">
                    <div class="alert alert-danger alert-dismissable ">
                        
                        <h4><b> {{result_error}}</b></h4>
                    </div>
                </div>
                <div id="login_form" class="col-sm-10 col-sm-offset-2">
                    <input type="hidden" name="action" value="login" id="action"/>
                    <input type="hidden" name="noUserAuth" value="true" />
                    <div class="row">
                        <div class="col-xs-12 mtp10 no_padding">
                            <div class="form-group col-xs-9 no_margin">
                                <input type="email" v-model="l_email" name="email" id="email" placeholder="Email" required class="form-control" value="" autofocus>
                            </div>
                            <div class="check_field col-xs-3 no_padding">
                                <b v-if="email_error" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{email_error_msg}}</b>
                            </div>
                        </div>
                        <div class="col-xs-12 mtp10 no_padding">
                            <div class="form-group col-xs-9 no_margin">
                                <input type="password" v-model="l_pass" name="password" id="password" class="form-control" placeholder="Password" required @keyup.enter="login_user" autocomplete="off" />
                                
                            </div>
                            <div class="check_field col-xs-3 no_padding">
                                <b v-if="pass_error" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{pass_error_msg}}</b>
                            </div>
                        </div>
                        <div class="my-lg-gutter"></div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" name="btn_login" id="btn_login" class="btn btn-default align-center" @click="login_user">LOGIN INTO ACCOUNT</button>
                            </div>
                        </div>
                    </div>
                    <div class="my-lg-gutter"></div>
                    <p class="text-center">Don't have an account? <a @click="singup">SIGN UP</a></p>
                </div> 
            </div>
            
          </div>
        </div>
        <div class="registration_section" v-if="reg_status">
           <div class="panel panel-info">
            <div class="panel-heading">
              <div class="heading">
                <h1 class="title">Create an Account</h1>
              </div>
            </div>
            <div class="panel-body">
                <div v-if="signup_result_error !== ''" class="result_error_section">
                    <div class="alert alert-danger alert-dismissable ">
                        
                        <h4><b> {{signup_result_error}}</b></h4>
                    </div>
                </div>
                <div id="registration_form">
                    <input type="hidden" name="action" value="signup" id="action"/>
                    <input type="hidden" name="noUserAuth" value="true" />
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <input type="text" v-model="f_name" name="first_name" id="first_name" placeholder="First Name" required class="form-control" value="" autocomplete="off" autofocus>
                                <b v-if="fname_error" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{fname_error_msg}}</b>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <input type="text" v-model="l_name" name="last_name" id="last_name" placeholder="Last Name" required class="form-control" value="" autocomplete="off" />
                                <b v-if="lname_error" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{lname_error_msg}}</b>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <input type="email" v-model="semail" name="email" id="email" placeholder="Email" required class="form-control" value="" autocomplete="off" />
                                <b v-if="semail_error" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{semail_error_msg}}</b>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <input type="text" v-model="phone" name="phone" id="phone" placeholder="Phone" required class="form-control" value="" autocomplete="off" />
                                <b v-if="phone_error" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{phone_error_msg}}</b>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <input type="password"  v-model="password" name="password" id="password" class="form-control" placeholder="Password" required="" autocomplete="off" oncopy="return false;" onpaste="return false;" oncut="return false;"/>
                                <b v-if="password_error" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{password_error_msg}}</b>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <input type="password" v-model="c_password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password" required="" autocomplete="off" oncopy="return false;" onpaste="return false;" oncut="return false;" @keyup.enter="singup_user">
                                <b v-if="cpassword_error" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{cpassword_error_msg}}</b>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" name="btn_register" id="btn_register" class="btn btn-default align-center" @click="singup_user">CREATE ACCOUNT</button>
                            </div>
                        </div>
                    </div>
                    <div class="my-sm-gutter"></div>
                    <p class="text-center">Already have an account? <a @click="login">LOGIN</a></p>
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
            reg_status:false,
            login_status:true,
            l_email:'',
            l_pass:'',
            email_error:false,
            email_error_msg:'',
            pass_error:false,
            pass_error_msg:'',
            fname_error:false,
            fname_error_msg:'',
            lname_error:false,
            lname_error_msg:'',
            semail_error:false,
            semail_error_msg:'',
            phone_error:false,
            phone_error_msg:'',
            password_error:false,
            password_error_msg:'',
            cpassword_error:false,
            cpassword_error_msg:'',
            f_name:'',
            l_name:'',
            semail:'',
            password:'',
            c_password:'',
            phone:'',
            result_error:'',
            signup_result_error:''

          }
        },
        http: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        methods:{
            singup(){
                this.reg_status=true;
                this.login_status=false;
            },
            login(){
                this.reg_status=false;
                this.login_status=true;
            },
            login_user(){

                if(!this.l_email) {
                    this.email_error = true;
                    this.email_error_msg = "Email required";
                }else if(!this.validEmail(this.l_email)) {
                    this.email_error = true;
                    this.email_error_msg = "Valid email required";
                }else{
                    this.email_error = false;
                    this.email_error_msg = "";
                }

                if(!this.l_pass){
                    this.pass_error = true;
                    this.pass_error_msg = "Password required";
                }else{
                    this.pass_error = false;
                    this.pass_error_msg = "";
                }

                if(this.email_error === false && this.pass_error === false){
                    let getData = {
                        email:this.l_email,
                        pass:this.l_pass
                    };
                    axios.post(this.url+'/user-login',getData).then( response=> {
                        if(response.data.status === 'success'){
                            this.result_error = '';
                            this.$emit("logincheck", true);
                            window.location.href=window.location.href;
                        }else{
                            this.result_error = response.data.result;
                        }
                    });
                }
            },
            singup_user(){
                if(!this.f_name){
                    this.fname_error = true;
                    this.fname_error_msg = "First name required";
                }else{
                    this.fname_error = false;
                    this.fname_error_msg = "";
                }
                if(!this.l_name){
                    this.lname_error = true;
                    this.lname_error_msg = "Last name required";
                }else{
                    this.lname_error = false;
                    this.lname_error_msg = "";
                }
                if(!this.phone){
                    this.phone_error = true;
                    this.phone_error_msg = "Phone number required";
                }else{
                    this.phone_error = false;
                    this.phone_error_msg = "";
                }
                if(!this.password){
                    this.password_error = true;
                    this.password_error_msg = "Password required";
                }else if(this.password.length < 6){
                    this.password_error = true;
                    this.password_error_msg = "Password must be 6 character";
                }else{
                    this.password_error = false;
                    this.password_error_msg = "";
                }
                if(!this.c_password){
                    this.cpassword_error = true;
                    this.cpassword_error_msg = "Confirm password required";
                }else if(this.password !== this.c_password){
                    this.cpassword_error = true;
                    this.cpassword_error_msg = "Password does not match the confirm password";
                }else{
                    this.cpassword_error = false;
                    this.cpassword_error_msg = "";
                }
                if(!this.semail){
                    this.semail_error = true;
                    this.semail_error_msg = "Email required";
                }else if(!this.validEmail(this.semail)) {
                    this.semail_error = true;
                    this.semail_error_msg = "Valid email required";
                }else{
                    this.semail_error = false;
                    this.semail_error_msg = "";
                }

                if(this.fname_error === false && this.lname_error === false && this.semail_error === false && this.phone_error === false && this.password_error === false && this.cpassword_error === false){

                    let getData = {
                        first_name:this.f_name,
                        last_name:this.l_name,
                        phone:this.phone,
                        password:this.password,
                        email:this.semail
                    };
                    axios.post(this.url+'/user-signup',getData).then( response=> {
                        //console.log(response.data);
                        if(response.data.status === 'success'){
                            this.signup_result_error = '';
                            this.$emit("logincheck", true);
                            window.location.href=window.location.href;
                        }else{
                            this.signup_result_error = response.data.result;
                        }
                    });
                }
                
            },
            validEmail: function (email) {
              var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(email);
            }
          
          
        },
        mounted() {
            if($("#login-register")){
              $('html, body').animate({
                scrollTop: $("#login-register").offset().top
              }, 2000);
            } 
        }
    }
</script>
