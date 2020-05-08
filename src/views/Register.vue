<template>
    <div class="register">
 <v-content>
  <v-container fluid pa-1>
    <v-layout row wrap align-center="align-center" justify-center="justify-center" pa-5>
      <v-flex xs12 sm4 id="sign-in-text-wrapper" text-xs-center px-5>
        <div class="headline font-weight-light text-center my-5" v-if="!show2">
          Sign Up</div>
            <div class="headline font-weight-light text-center my-2" v-else>
             Welcome Back
            </div>
            <div>
                 <p v-if=" !show2 " class="body-2 teal--text text--lighten-3 text-capitalize text-center">Already have an account? <span @click="show2 = true" style="cursor: pointer;text-decoration:underline">Login</span></p>
  <p v-else class="body-2 teal--text text--lighten-3 text-capitalize text-center">Don't have an account? <span @click="show2 = false" style="cursor: pointer;text-decoration:underline">Register here</span></p>
            </div>
            <v-snackbar v-model=snackbar :timeout="10000" top right :color="color" :value=registerMsg>
  <span>{{registerMsg}}</span>
  <!--<v-btn flat color="white" @click="snackbar = false">close</v-btn>-->
</v-snackbar>
<v-card
    max-width="454"
    class="mx-auto extra-round pa-4"
    elevation=3
    light="light"
    :loading="loading"
  >
  <v-overlay 
:value="loading"
dark
:z-index="9999">
 <v-progress-circular indeterminate
 :size="100"
      :width="5"
 >loading account</v-progress-circular>
    </v-overlay>
    <v-card-title class="caption text-center d-block py-5" v-if="!show2">
     <v-row
      justify="space-around"
    >
    <v-col
        class="text-center"
        cols="12"
      >
 <v-icon class="teal--text">mdi-account-key-outline</v-icon>
    </v-col>
     </v-row>
        <p class="text-center title teal--text font-weight-light">
          
          Your one link, multiple products, sell better, starts below</p>
    </v-card-title>
    <v-card-title class="body-2 text-capitalize text-center d-block py-5" v-else>
      Sign in <br>
       <p class="text-center caption teal--text font-weight-light">
      Enable more sales in less time
</p>
    </v-card-title>
    <v-card-text>
      <v-layout column align-center justify-center pa-0>
      <v-form 
      ref="form"
      v-model="valid"
      >
<v-flex xs12 class="form-wrapper" v-show="!show2"><!-- :rules="nameRules" [nurules.required, nurules.min]-->

<v-tooltip v-model="usertip" top>
            <template> <!-- v-slot:activator="{ on }" -->
            <v-text-field
              filled
              full-width
              single-line
             v-model="userCred.username"
              label="Username"
              :rules="nameRules"
              hint="This will be your store link (USERNAME.mulaa.store) a-z no spaces allowed"
            persistent-hint
              background-color="#f4f8f7"
              class="teal--text form-field mb-5"
              prepend-inner-icon="mdi-account-outline"
              :append-icon="usertip ? 'mdi-alert-circle-check' : 'mdi-alert-circle'"
              @click:append="usertip = !usertip"

            ></v-text-field>
 </template>
            <span>choose preferred username, only letters no space</span>
          </v-tooltip>

            <v-text-field
              filled
              full-width
              single-line
              :rules="emailRules"
                            label="Email"
                            v-model="userCred.email"
              background-color="#f4f8f7"
              color="grey darken-2"
              prepend-inner-icon="mdi-email-outline"
            ></v-text-field>
            
            <v-text-field
              v-model="userCred.password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              filled
              full-width
              single-line
              label="Password"
              :rules="[maxrules.required, maxrules.min, maxrules.max]"
              background-color="#f4f8f7"
              color="grey darken-2"
              prepend-inner-icon="mdi-lock-outline"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-flex>

          <!-- login form -->

          <v-flex xs12 class="form-wrapper mt-5" v-show="show2">
            <v-text-field
              filled
              full-width
              single-line
             v-model="user.username"
              label="username"
              background-color="#f4f8f7"
              class="teal--text form-field"
              prepend-inner-icon="mdi-account-outline" mb-0
            ></v-text-field>
            <v-text-field
              v-model="user.password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              filled
              full-width
              single-line
              label="Password"
              background-color="#f4f8f7"
              color="grey darken-2"
              prepend-inner-icon="mdi-lock-outline"
              @click:append="show1 = !show1"
            ></v-text-field>
        
          </v-flex>

        </v-form>
      </v-layout>
      </v-card-text>
    <v-card-actions class="pa-2 align-center">
      <v-btn 
      large ripple
       class="ml-10 px-5 mb-5 text teal--text" 
      color="#23d2aa" 
      @click="register(userCred)"
      :loading="loading" v-show="!show2">
      <span class="caption px-5">Sign Up</span>
      </v-btn>

       <v-btn 
             large ripple
             class="px-5 mb-5 text teal--text" 
      color="#23d2aa" 
            id="sign-in"
            @click="login(user)"
          :loading="loading" v-show="show2"><span class="caption px-5">Login</span></v-btn>

    </v-card-actions>

<v-card-actions v-show="!show2">
<p
class="caption d-block"
style="font-size: 0.875rem;
line-height: 1.375rem;
letter-spacing: 0.0071428571em;
color: rgba(0, 0, 0, 0.54);
"
>
By using mulaa.co, you agree to our  <a href="https://mulaa.co/go/terms-of-service" target="_blank"><span style="cursor: pointer;text-decoration:underline">terms</span></a> and you're not selling something on our prohibited list.
</p>
</v-card-actions>

    <v-card-actions v-show="show2">
 <p
 style="font-size: 0.875rem;
    line-height: 1.375rem;
    letter-spacing: 0.0071428571em;
    color: rgba(0, 0, 0, 0.54);
    "
 >
            
              Forgot password? <a href="https://shop.mulaa.co/api/forgot-password/" target="_blank"><span style="cursor: pointer;text-decoration:underline">Reset password</span></a></p>
    </v-card-actions>

  </v-card>



<v-overlay 
:value="confirmation"
:opacity="0.9"
>
<v-layout row wrap mx-auto>
  <v-flex xs10 sm9 md9 lg9>
<div class="headline font-weight-light"></div>
  </v-flex>
 <v-flex xs2 sm3 md3 lg3 text-right>
    <v-btn
icon
@click="confirmation = false"
>
<v-icon right>mdi-close</v-icon>
</v-btn>
  </v-flex>
</v-layout>

<v-layout row wrap mx-auto>
  <v-flex>
<v-card
    class="mx-auto"
    max-width="344"
    outlined
    color="#23d2aa"
  >
  <v-card-text class="pa-10 deep-purple--text text--darken-4">
  <h2 class="title mb-3">
    Thank You for Signing Up! <br>

Check the confirmation email at {{this.userCred.email}}
  </h2>
  <p>
    <strong> Note:</strong> If you do not receive the email in few minutes:
  </p>
  <ul>
    <li>
      check spam folder (and move email to inbox)
    </li>
    <li>
      verify if you typed your email correctly
    </li>
    <li>
      if you can't resolve the issue, please contact team@mulaa.co
    </li>
  </ul>

  <div class="text-cente">
<v-btn class="caption my-5" x-large color="#000028" href="/"
>
<v-icon small left>mdi-chevron-right</v-icon>
Continue to Login
</v-btn>
</div>
  </v-card-text>
</v-card>
  </v-flex>
</v-layout>


</v-overlay>

<v-row justify="center"> 
           <p class="caption text--grey my-5" style="margin: 0 auto">
<img :src="require('../assets/mulaalogo-white.png')" alt="" style="max-width:100px;">
           </p>
        
       </v-row>
</v-flex>

    </v-layout>
  </v-container>
    </v-content>
    
  </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'
export default {
    created(){
      if(this.$store.getters.isLoggedIn=== true){
       // this.$router.push('/') //this.$store.getters.isLoggedIn
      }
    },
    computed: {
      ...mapState([
      'registerMsg',
      'color',
      'show',
      'loading'
    ]),
    snackbar: {
      get() {
        return this.$store.state.snackbar;
      },
      set(value) {
        this.$store.commit('snackbar', value);
      }
    },
    loading: {
      get() {
        return this.$store.state.loading;
      },
      set(value) {
        this.$store.commit('loading', value);
      }
    }
    },
    mounted(){
      //this.load();
      //this.test();
    },
    methods: {
      confirmed(){
return this.$router.push({name: 'dashboard', params: { popWelcome: true }})
      },
      test(){
        console.log(decodeURI('https:\/\/mulaa.me\/u\/randommmmm'))
      },
      login (user) {
        this.loading = true;
            this.$store
              .dispatch("login", user)
              .then(() => this.$router.push({name: 'dashboard'})) //this.$router.push("/")
              .catch(err => {
                this.loading = false
                console.log(err)
                }
                );
          },
          register (userdets) {

            if (this.$refs.form.validate() == true){
            //console.log(this.$refs.form.validate())
            
            this.loading = true; 
            this.$store
              .dispatch("register", userdets).then(() => {
                //this.$refs.form.reset()
                console.log('done')
                return this.newlogin (userdets)
                })
              .catch(err => {
                this.loading = false
                console.log(err)
              });   
          }
          },
          newlogin (user) {
        this.loading = true;
        //console.log(JSON.stringify(user))
        
        const userUnik = user.username
        const priUrl = 'https://shop.mulaa.co/u/'+userUnik
        //user.username
         /* axios.get('https://mulaa.me/u/api/?key=P1fjdH02F3y2&url='+priUrl+'&custom='+userUnik)
          .then(resp => {
          
            console.log(resp.short);
            //this.loading = false;
          }).catch(err => {
                this.loading = false
                console.log(err)
                }
              );
        */
            this.$store
              .dispatch("login", user)
              .then(
                () => {
                  //this.loading = false
                  axios.get('https://mulaa.me/u/api/?key=P1fjdH02F3y2&url='+priUrl+'&custom='+userUnik)
                  //this.confirmation = true
                  const useridVal = this.$store.state.userId
                  //console.log(localStorage.getItem('token'))
//console.log(useridVal)
//console.log('referred by :'+this.referralName)

const options = {
            headers: {'Authorization': 'Bearer '+localStorage.getItem('token')}
            }
           
           if(this.referralName !=''){
//this.$http.put
                axios.post('https://shop.mulaa.co/api/wp-json/wp/v2/users/'+useridVal, {
                title: '',
                content: '',
                fields : {
                referal: this.referralName,
                },
                 status: "publish"
            }, options)
            .then(resp => {
 this.loading = false
this.confirmation = true
            })
           }else{
this.loading = false
this.confirmation = true
           }
                  //return this.$router.push({name: 'dashboard', params: { popWelcome: true }})//{name: 'dashboard', params: { sheet: true }}
                  }
                ) //this.$router.push("/")
              .catch(err => {
                this.loading = false
                console.log(err)
                }
              ); 
          },
          sellerId (value) {
            const letters = /^[a-z]+$/;
            return letters.test(value)
          }
        
    },
    data() {
      return {
        isFormValid: false,
        usertip: false,
        confirmation: false,
        usernameraw:'',
        user:{
          username: '',
          password: ''
        },
        userCred:
            {
                username: this.$route.query.storename || '',
                email:'',
                password:'',
                /*"roles": [
                  "author"
                ]*/
            },
            referralName: this.$route.query.ref || '',
            theme: 'dark-theme',
            valid: false,
        show1: false,
        show2: false,
        /*show: false,
        snackbar: false,*/
        emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ],
       nameRules: [
        (v)=> /^[a-z0-9]+$/.test(v) || 'lowercase only, no space allowed',
      (v) => !!v || 'Name is required',
      (v) => v && v.length <= 20 || 'Name must be less than 20 characters'
    ],
    nurules: {
          required: value => !!value || 'Required.',
          min: v => v.length >= 6 || 'Min 6 characters'
        },
        maxrules: {
          required: value => !!value || 'Required.',
          min: v => v.length >= 6 || 'Min 6 characters',
          max: v => v.length <= 16 || 'Max 16 characters'
        }
      }
    }
}
</script>

<style>
    .dark-theme{
  background: #000028 !important;
  color: #fff;
}  
@media (min-width: 970px){
    #sign-in-text-wrapper{
        height:100vh;
    }
    }
</style>