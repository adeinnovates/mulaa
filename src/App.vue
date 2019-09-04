<template>
  <v-app>
    <Navbar v-if="!$route.meta.hideNavigation"/>

    <v-content v-if="$route.path == '/user'" class="mb-0 pa-0 dark-theme">
    <transition name="router-anim" enter-active-class="animated fadeInDown" leave-active-class="animated fadeOutDown" mode="out-in">
      <router-view></router-view>
      </transition>
    </v-content>
    <v-content v-else-if="$route.path == '/onboard'" class="mb-0 pa-0 dark-theme">
    <transition name="router-anim" enter-active-class="animated fadeInDown" leave-active-class="animated fadeOutDown" mode="out-in">
      <router-view></router-view>
      </transition>
    </v-content>
    <v-content v-else class="mb-0 pa-0">
      <transition name="router-anim" enter-active-class="animated fadeInDown" leave-active-class="animated fadeOutDown" mode="out-in">
      <router-view></router-view>
      </transition>
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
<style>
 @import "https://cdn.jsdelivr.net/npm/animate.css@3.5.1";
 .page {
    /*position: fixed;*/
    width: inherit;
  }
</style>