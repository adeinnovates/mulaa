<template>
    <div class="pa-5 mt-0 pt-0">
        <v-container>
            <v-row>
                <v-col cols="12">
                        <v-row
                        align="center"
                        justify="center"
                        >
                            <v-card
                            max-width="344"
                            class="mx-auto mb-2 pt-0 transparent"
                            elevation="0"
                            >
                                <v-card-text class="pt-0">
                                <div class="text-center">
                                    <v-img :src="require('../assets/successful.svg')" max-width="300" class="mb-3"></v-img>
                                </div>
                                <div class="text-center headline font-weight-light teal--text d-block">
                                Welcome, let's create your first product!
                                
                                <!-- <v-divider class="mt-3"></v-divider>-->
                               <!-- <v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> -->
                            </div>
                             <AddProduct></AddProduct>
                                </v-card-text>
                            </v-card>
                            
                            
                           
                           
                           
                            
                         </v-row>                       
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import AddProduct from '@/components/AddProduct'
export default {
    props: [

    ],
     components: {
        AddProduct
  },
    data(){
return{

}
    },
    computed: {
        ...mapGetters([
             'renderUser'
           ]),
      ...mapState([
      'loading',
      'user',
      'allProducts',
      'myproducts',
      'Discounted',
    ]),
    }
}
</script>