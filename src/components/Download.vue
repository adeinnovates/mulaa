<template>
    <div class="digital fill-height teal lighten-5">
       
       <v-content>
  <v-container fluid pa-1>
    <v-layout row wrap align-center="align-center" justify-center="justify-center" pa-5>
      <v-flex xs12 sm4 id="sign-in-text-wrapper" text-xs-center px-5>
        <v-card
    max-width="454"
    class="mx-auto extra-round pa-4"
    elevation=10
    light="light"
    :loading="loading" 
  >
<v-card-title class="000028--text font-weight-light text-center d-block display-1">
Download page
</v-card-title>

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
    data(){
        return{
            loading: null,
        }
    },
    computed: {
      ...mapState({
      loading:'loading',
      userKey:'userKey',
      theProduct:'theProduct',
      downloadLink: 'downloadLink'
      }),
    },
    methods: {
        fetchData(){
        //this.$store.dispatch('loadProduct', this.$route.params.id)
        //this.$store.dispatch('loadUserDetails', this.nname)
        console.log("download key: "+this.$route.params.key)
    },
    },
    created() {
this.fetchData()
    }
}
</script>