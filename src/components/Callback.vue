<template>
    <v-dialog transition="slide-x-transition" dark hide-overlay v-model="dialog" max-width="454" class="extra-round extra white--text">
        <template v-slot:activator="{ on }">
            <v-btn text color="#23d2aa"  
               class="caption"
               v-on="on"
               ref="popupBtn"
             id="popupBtn"
                >
                  <v-icon small left>mdi-cart</v-icon>
                  Buy
                </v-btn>
        </template>

            <v-card
            max-width="454"
            class="mx-auto"
            >
          
<v-row align="center" justify="center">
                   
</v-row>
            <!--<v-card-title>
                <span class="headline font-weight-light mb-2">
                Confirmation
                </span>
                </v-card-title>
                -->
            <v-card-text class="pa-5">
            
            <div v-if="paymentStatus.status === 'success'">
                
                <v-img :src="require('../assets/winner.svg')"></v-img>
                <span class="title text-center font-weight-light mb-2 pa-5 green">
                    transaction successful with response {{paymentStatus.message}}
                </span>
            </div>
            <div v-else>
                 <v-img :src="require('../assets/unsuccessful.svg')"></v-img>
                  <span class="title text-center font-weight-light mb-2 pa-5 red">
                  transaction not successful with response {{paymentStatus.message}}
                  </span>
            </div>
         
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

export default {
    props: ['paymentStatus'],
    data(){
        return {
 dialog: false,
 successimg: `../assets/successful.svg`//`@/assets/images/successful.svg`,
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