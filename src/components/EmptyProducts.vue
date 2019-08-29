<template>
    <div class="pa-5 mt-5">
        <v-container>
            <v-row>
                <v-col cols="12">
                        <v-row
                        align="center"
                        justify="center"
                        >
                            <v-card
                            max-width="344"
                            class="mx-auto mb-2"
                            >
                                <v-card-text>
                                <div class="text-center">
                                    😊
                                </div>
                                </v-card-text>
                            </v-card>
                            <p class="text-center display-1 font-weight-light teal--text">
                                Welcome, lets create your first product!
                                
                                <!-- <v-divider class="mt-3"></v-divider>-->
                               <!-- <v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> -->
                            </p>
                            
                           
                            <AddProduct></AddProduct>
                           
                            
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