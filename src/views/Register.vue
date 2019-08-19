<template>
    <div class="register">
 <v-content>
  <v-container fluid pa-1>
    <v-layout row wrap align-center="align-center" justify-center="justify-center" pa-5>
      <v-flex xs12 sm4 id="sign-in-text-wrapper" text-xs-center px-5>
        <div class="headline font-weight-light text-center my-5" v-if="!show2">
             Basic Information
            </div>
            <div class="headline font-weight-light text-center my-5" v-else>
             Welcome
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
    <v-card-title class="caption text-capitalize text-center d-block py-5" v-if="!show2">
        The last link between you and sales. <br> Take the first step below
    </v-card-title>
    <v-card-title class="body-2 text-capitalize text-center d-block py-5" v-else>Sign in</v-card-title>
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
              label="Name"
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
              label="Name"
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
      <v-btn rounded 
      large 
      class="px-5 mb-5 text indigo--text" 
      color="#BEE890" 
      @click="register(userCred)"
      :loading="loading" v-show="!show2">
      <span class="caption px-5">Sign Up</span>
      </v-btn>

       <v-btn 
            rounded large ripple
            class="px-5 mb-5 text indigo--text" 
            color="#BEE890" 
            id="sign-in"
            @click="login(user)"
          :loading="loading" v-show="show2"><span class="caption px-5">Login</span></v-btn>
    </v-card-actions>
  </v-card>

</v-flex>

    </v-layout>
  </v-container>
    </v-content>
    
  </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
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
    },
    methods: {
      login (user) {
        this.loading = true;
            this.$store
              .dispatch("login", user)
              .then(() => this.$router.push("/")) //this.$router.push("/")
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
                this.newlogin (userdets)
                })
              .catch(err => {
                this.loading = false
                console.log(err)
              });
          },
          newlogin (user) {
        this.loading = true;
            this.$store
              .dispatch("login", user)
              .then(
                () => {
                  this.loading = false
                  this.$router.push("/onboard")
                  }
                ) //this.$router.push("/")
              .catch(err => {
                this.loading = false
                console.log(err)
                }
                );
          }
        
    },
    data() {
      return {
        user:{
          username: '',
          password: ''
        },
        userCred:
            {
                username:'',
                email:'',
                password:'',
                "roles": [
                  "author"
                ]
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