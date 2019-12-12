<template>
  <v-app>
    <v-snackbar
        v-model="snackWithButtons"
        :timeout="timeout"
        bottom
        left
        class="snack"
      >
        {{ snackWithBtnText }}
        <v-spacer />
        <v-btn
          dark
          flat
          color="#00f500"
          @click.native="refreshApp"
        >
          {{ snackBtnText }}
        </v-btn>
        <v-btn
          icon
          @click="snackWithButtons = false"
        >
          <v-icon>close</v-icon>
        </v-btn>
      </v-snackbar>
    
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
    theme: 'dark-theme',
    refreshing: false,
      registration: null,
      snackBtnText: '',
      snackWithBtnText: '',
      snackWithButtons: false,
      timeout: 0,
  }),
   created(){
     /*if (this.$store.getters.isLoggedIn != true){
       //this.$router.push("/user");
     }*/
     document.addEventListener(
    'swUpdated', this.showRefreshUI, { once: true }
  );
  navigator.serviceWorker.addEventListener(
    'controllerchange', () => {
      if (this.refreshing) return;
      this.refreshing = true;
      window.location.reload();
    }
  );
    },

    methods: {
    showRefreshUI(e) {
      // Display a snackbar inviting the user to refresh/reload the app due
      // to an app update being available.
      // The new service worker is installed, but not yet active.
      // Store the ServiceWorkerRegistration instance for later use.
      this.registration = e.detail;
      this.snackBtnText = 'Refresh';
      this.snackWithBtnText = 'New version available!';
      this.snackWithButtons = true;
    },
    refreshApp() {
      this.snackWithButtons = false;
      // Protect against missing registration.waiting.
      if (!this.registration || !this.registration.waiting) { return; }
      this.registration.waiting.postMessage('skipWaiting');
    },
  },
};
</script>
<style>
 @import "https://cdn.jsdelivr.net/npm/animate.css@3.5.1";
 .page {
    /*position: fixed;*/
    width: inherit;
  }
</style>