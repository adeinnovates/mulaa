<template>
    <div class="dashboard fill-height teal lighten-5 page pa-5 mt-10">
      <v-sheet v-if="userAcctStatus != ''" color="caption red lighten-2 pa-2 rounded my-3" style="color:#000028" elevation="1">
{{userAcctStatus}}
<v-btn small text
>
    <!--<span class="caption teal--text">
    copy
    </span>-->
    </v-btn>
</v-sheet>
<v-sheet v-else color="caption orange lighten-4 pa-2 rounded my-3" style="color:#000028" elevation="1">
Hello {{user}}
</v-sheet>

        <v-expansion-panels>
    <v-expansion-panel
      v-for="(item,i) in 5"
      :key="i"
    >
      <v-expansion-panel-header>Item</v-expansion-panel-header>
      <v-expansion-panel-content>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
    </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'

export default {
    data() {
      return {

      }
    },
     created() {
        return this.fetchUserData()
    },
     methods: {
fetchUserData(){
        this.$store.dispatch('loadUserDetails', this.user)
        //console.log(userDetails)
    }
     },
  computed: {
        ...mapGetters([
             'renderUser'
           ]),
      ...mapState({
      registerMsg:'registerMsg',
      color:'color',
      show:'show',
      loading:'loading',
      user: 'user',
      allProducts: 'allProducts',
      myproducts:'myproducts',
      Discounted:'Discounted',
      userPhone: 'userPhone',
       userDetails: 'userDetails',
       userAcctStatus: 'userAcctStatus'
      }),
    userSales: {
      get() {
        return this.$store.state.userSales;
      },
      set(value) {
        this.$store.commit('user_sales', value);
      }
    },
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
    },
    salesCount: function(){
      return Object.keys(this.userSales).length;
    }
    }

}
</script>