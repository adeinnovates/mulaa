<template>
<nav>
    <v-snackbar v-model="notice" :timeout="10000" top color="success">
        <span>awesome, product added to store</span>
        <v-btn text color="white" @click="notice = false">Close</v-btn>
    </v-snackbar>

     <v-app-bar
    color="#000028"
    flat 
    app
  >
    <v-app-bar-nav-icon @click="menu = !menu" class="teal--text text--lighten-3"></v-app-bar-nav-icon>

    <v-toolbar-title><span class="mr-2 teal--text text--lighten-3 pt-5">
      <v-img :src="require('../assets/mulaalogo-white.png')" max-width="80" class=mt-6></v-img>
      </span></v-toolbar-title>

    <v-spacer></v-spacer>
<!--
    <v-btn icon>
      <v-icon>mdi-heart</v-icon>
    </v-btn>

    <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn> 
    -->
    <div class="white--text mr-4">
      Updates <span class="announcekit-widget ml-1"></span>
      </div> 
    <v-btn
        text
        rounded ripple
        href="#"
        target="_blank"
        color="teal"
      >
       <span v-if="isLoggedIn"><a @click="logout" style="text-decoration: none;" class="teal--text small">Logout</a></span>
       <span v-else><router-link to="/user" style="text-decoration: none;" class="teal--text small">Login</router-link></span>
      </v-btn>
    </v-app-bar>


    <v-navigation-drawer v-model="menu" app class="darkbg">
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title teal--text text--lighten-3">
             Mulaa
          </v-list-item-title>
          <v-list-item-subtitle class="caption teal--text text--lighten-2">
            Digital retail enablement
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider light inset></v-divider>
        <v-list>
          <v-list-item>
           <!-- <v-list-item-avatar color="teal">
              <v-img :src=userimg v-if="userimg != ''"></v-img>
              <span v-else class="white--text headline">US</span>
            </v-list-item-avatar>-->
            <avatar :username=this.user></avatar>
          </v-list-item>

 <v-list-item
            link
            two-line
          >
            <v-list-item-content>
              <v-list-item-title class="title teal--text text--lighten-3">
                {{user}}
                </v-list-item-title>
              <v-list-item-subtitle class="caption teal--text text--lighten-3">
                {{userEmail}}
                <v-icon class="teal--text text--lighten-3">
                   mdi-user
                  </v-icon>
               </v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-action>
              <v-icon class="teal--text text--lighten-3">mdi-menu-down</v-icon>
            </v-list-item-action>
          </v-list-item>
        </v-list>
     

      <v-divider></v-divider>

<v-list
        nav
        dense
      >
        <v-list-item v-for="link in links" :key="link.text" router :to="link.route">
          <v-list-item-icon>
            <v-icon class="mr-2 teal--text text--lighten-4">{{link.icon}}</v-icon>
          </v-list-item-icon>
          <v-list-item-title class="teal--text text--lighten-4">{{link.text}}</v-list-item-title>
        </v-list-item>
    </v-list>
    <v-spacer></v-spacer>
<template v-slot:append>
        <div class="pa-4 text-higlight">
          <p class="caption">
            © Mulaa.co, <br>Mulaa Analytics 2019 - {{new Date().getFullYear()}}
          </p>
          <span class="caption">
            A mobile-first sales-enablement for creators, thought leaders and solopreneurs - enabling you monetise your audience and build your leads list with one link - no middleman or website needed 😎👌🏼.
          </span>
        </div>
      </template>

    </v-navigation-drawer>
    </nav>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import Avatar from 'vue-avatar'
export default {
  components: {
    Avatar
  },
    data(){
        return{
          userimg: '',//'http://dev.mulaa.co/imgapi/uploads/avatar/' + this.user +'.jpg',
            menu: false,
            theme: true,
            userAuth: false,
            links: [
                {icon: 'mdi-view-dashboard-variant', text: 'Dashboard', route:'/'},
                {icon: 'mdi-cart', text: 'Products', route:'/products'},
                {icon: 'mdi-store', text: 'Sales', route:'/sales'},
                {icon: 'mdi-download', text: 'Digital Assets', route:'/digital'},
                {icon: 'mdi-cog-outline', text: 'Settings', route:'/settings'},
                //{icon: 'mdi-account', text: 'Account Activation', route:'/onboard'}
            ],
            notice: false
        }
    },
    computed: {
      ...mapState([
      'registerMsg',
      'color',
      'show',
      'loading',
      'user',
      'allProducts',
      'userEmail',
      'userDetails'
    ]),
        isLoggedIn: function() {
          return this.$store.getters.isLoggedIn;
        }
      },
      methods: {
        logout: function() {
          this.$store.dispatch("logout").then(() => {
            this.$router.push("/user");
          });
        }
      }
}
</script>

<style>
.darkbg{
  background-color: #000028 !important;
}
.text-higlight{
  color: #c1c1ff !important;
}
</style>