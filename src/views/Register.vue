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
<v-flex xs12 class="form-wrapper" v-show="!show2">
            <v-text-field
              filled
              full-width
              single-line
             v-model="userCred.username"
              label="Username"
              :rules="nameRules"
              hint="a-z no spaces allowed"
              background-color="#f4f8f7"
              class="teal--text form-field"
              prepend-inner-icon="mdi-account-outline" mb-0
            ></v-text-field>
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
       class="px-5 mb-5 text teal--text" 
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
  </v-card>
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
      this.test();
    },
    methods: {
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
                  this.loading = false
                  axios.get('https://mulaa.me/u/api/?key=P1fjdH02F3y2&url='+priUrl+'&custom='+userUnik)
                  return this.$router.push({name: 'dashboard'})//{name: 'dashboard', params: { sheet: true }}
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
        usernameraw:'',
        user:{
          username: '',
          password: ''
        },
        userCred:
            {
                username: '',
                email:'',
                password:'',
                /*"roles": [
                  "author"
                ]*/
            },
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
      (v) => v && v.length <= 10 || 'Name must be less than 10 characters'
    ]
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