<template>
    <div class="products fill-height teal lighten-5">
        <v-container>
            <v-layout row wrap equal>
                <v-flex xs12 sm8 md8 pa-5>
                     <AddProduct></AddProduct>

                     <v-row>
                       <v-col>
                         <div class="pa-5 teal lighten-4 mb-5" style="border-radius:10px">
                         <v-text-field v-model="search" :clearable=true
                         color="teal lighten-3 teal--text"
            label="Search"
            placeholder="Search Product Name or Price"
            prepend-inner-icon="mdi-magnify"
          ></v-text-field>
          </div>
                       </v-col>
                     </v-row>
                        <p class="overline mb-0">products</p>
                    <v-layout row wrap pt-2 mt-1>
                            <v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> 
                           <v-flex xs6 sm6 md4 lg4 v-for="product in filteredProducts" :key="product.productID">
            <v-card flat hover class="text-xs-center ma-2">
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="1.75"
         ></v-img>
              </v-responsive>
              <v-card-text>
                <div class="subheading text-truncate">
                  {{product.title}}
                </div>
                <div class="grey--text text-truncate small"> {{product.description}}</div>
              </v-card-text>
              <v-card-actions>
               <!-- <v-btn text color="#23d2aa" :to="{name:'product',params: {
                    id: product.id
                  }}">
                  <v-icon small left>mdi-square-edit-outline</v-icon>
                  
                </v-btn>-->
                <Editor :theproducts="product"></Editor>
                <v-spacer></v-spacer>
                <div class="grey--text small"> ₦{{product.price}}</div>
              </v-card-actions>
              </v-card>
        </v-flex>
                       </v-layout>

                </v-flex>
            </v-layout>

        </v-container>
    </div>
</template>
<script>
import EmptyState from '@/components/EmptyProducts'
//import MoreBtn from '@/components/MoreBtn'
import AddProduct from '@/components/AddProduct'
import Editor from '@/components/Editor'

import { mapState, mapGetters } from 'vuex'

export default {
    props: ['theproducts'],
    components: {
        //EmptyState,
        //MoreBtn,
        AddProduct,
        Editor
  },
    data(){
        return{
          search:'',
            slides: 5,
    active: 1,
            dialog: false,
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            uploadMsg: '',
            infoBar: false,
            infoMsg: '', 
            products: '',
        }
    },
    created() {
        this.fetchData()
       // console.log(this.$route)
    },
    methods: {
    fetchData(){
        this.$store.dispatch('loadAllProducts', 'top')
       // this.$store.dispatch('getUser', this.user)
       //this.reload()
    },
    reload(){
      this.$router.go()
    }
  },
  mounted(){
       
    },
  computed: {
        ...mapGetters([
             'renderUser'
           ]),
      ...mapState([
      'registerMsg',
      'color',
      'show',
      'loading',
      'user',
      'allProducts',
      'myproducts',
      'Discounted',
      'userUrl'
    ]),
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
    currentUserProd: {
      get() {
        let theUserProducts = this.$store.state.userProducts;
        if (theUserProducts.length > 0){
          return theUserProducts
        }else{
console.log('No products yet')
return null
        }
      },
      set(value) {
        this.$store.commit('loadUserProducts', value);
      }
    },
    counted : function () {
        return Object.keys(this.currentUserProd).length;
    },
    countApproved: function () {
        return Object.keys(this.approved).length;
    },
    filteredProducts: function(){
        if(this.currentUserProd != null){
      return this.currentUserProd.filter((myproduct) => {
        return myproduct.title.match(this.search) || myproduct.price.match(this.search)
      })
    }else{
      return null
    }
    }
    }
}
</script>