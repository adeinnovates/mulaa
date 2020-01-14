<template>
    <v-dialog transition="slide-x-transition" dark persistent v-model="dialog" max-width="454" class="extra-round extra white--text">
        <template v-slot:activator="{ on }">
            <v-btn color="#23d2aa"  
               class="mt-7"
               v-on="on"
               ref="popupBtn"
             id="popupBtn"
                >
                  <v-icon small left>mdi-cart</v-icon>
                  Pay Now
                </v-btn>
        </template>

            <v-card
            max-width="454"
            class="mx-auto"
            >
            <v-card-title>
                <span class="headline text-center font-weight-light mb-2">
                    Mulaa Checkout
                </span>
            </v-card-title>
                
            <v-card-text class="pa-5">
                <v-img :src="require('../assets/winner.svg')"></v-img>
                <span class="title text-center font-weight-light mb-2 pa-5 green">
                    You have initiated a Transaction on behalf of {{}} Bank Transfer option, you agree to make an Internet Transfer as payment for your transaction.
                </span>
                 <v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> 
            </v-card-text>
           
         
             <v-card-actions>
               <v-btn text color="teal lighten-3 overline" @click="dialog = false">
              <v-icon right-3 color="teal lighten-3" class="mr-2">mdi-cancel</v-icon>
             Close
              </v-btn>
            </v-card-actions>
            </v-card>
            
    </v-dialog>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'

export default {
    props: ['payOptions','dialog2'],
    data(){
        return {
 dialog: false,
 successimg: `../assets/successful.svg`//`@/assets/images/successful.svg`,
        }
    },
     computed: {
      ...mapState({
      registerMsg:'registerMsg',
      loading:'loading',
      }),
      loading: {
      get() {
        return this.$store.state.loading;
      },
      set(value) {
        this.$store.commit('loading', value);
      }
    }
     }
}
</script>
<style scoped>
    .theme--dark.v-card{
        background-color:#000028;
    }
    .red{
        display: block;
        border-radius: 5px;
    }
    .green{
        display: block;
        border-radius: 5px;
    }
</style>