<template>
    <div class="digital fill-height teal lighten-5">
        download page
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'

export default {
    data(){
        return{

        }
    },
    computed: {
      ...mapState({
      loading:'loading',
      userKey:'userKey',
      theProduct:'theProduct',
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