<template>
  <v-app>
    <Navbar v-if="!$route.meta.hideNavigation"/>

    <v-content v-if="$route.path == '/user'" class="mb-0 pa-0 dark-theme">
      <router-view></router-view>
    </v-content>
    <v-content v-else-if="$route.path == '/onboard'" class="mb-0 pa-0 dark-theme">
      <router-view></router-view>
    </v-content>
    <v-content v-else class="mb-0 pa-0">
      <router-view></router-view>
    </v-content>

  </v-app>
</template>

<script>
import HelloWorld from './components/HelloWorld';
import Navbar from '@/components/Navbar'

export default {
  name: 'App',
  components: {
     Navbar,
  },
  data: () => ({
    //
    theme: 'dark-theme'
  }),
   created(){
     if (this.$store.getters.isLoggedIn != true){
       //this.$router.push("/user");
     }
    }
};
</script>
