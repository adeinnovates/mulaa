<template>
    <v-dialog v-model="dialog" max-width="454" class="extra-round extra" transition="slide-x-reverse-transition">
        <template v-slot:activator="{ on }">
        <v-btn small color="success"
          :disabled=false
          v-on="on" elevation="3"
          >Subscribe</v-btn>
          
        </template>

            <v-card
            max-width="454"
            class="mx-auto teal lighten-5 mb-0"
            >

            <v-card-title>
            <div class="headline font-weight-light headlineText">
                Mulaa Plan Subscription 
            </div>
            </v-card-title>
            <v-container class="white lighten-5 mb-0">
                <v-row>
                <v-col>
                    <v-card-text class="pa-5">
                        like
                    </v-card-text>
                </v-col>
                </v-row>
            </v-container>
            </v-card>
    </v-dialog>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'

export default {
     props: ['amount','planID','userEmail'],
     components: {
   
  },
data(){
        return{
            dialog: false,
        }
},
 methods: {

 }
    
}
</script>