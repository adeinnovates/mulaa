<template>
    <div class="userpage products fill-height grey lighten-5 pa-5 page">
        <v-container>
                <div class="text-center">
                <v-avatar class="my-5" size="60">
                <img v-if="this.userImage != ''" src="https://vuetifyjs.com/apple-touch-icon-180x180.png" alt="avatar">
                <img else :src="require('../assets/profile.png')" alt="avatar">
                </v-avatar>
                <p class="title grey--text darken-2 font-weight-black">
                        {{name}}
                    </p>
                     <v-divider width=50% class="align-center d-block" style="margin: 0 auto"></v-divider>
                     <p class="mt-2 mb-0 caption grey--text darken-1 font-weight-light">{{userDesc}}</p>
                </div>
                <v-row justify="center" class="mb-4">
                    <v-btn small 
                    rounded 
                    class="mt-3 grad-bg2"
                   :href="bizPhone"
                    >
                        <v-icon left>mdi-whatsapp</v-icon>
                       <span class="caption dark-body-text"> chat</span> 
                        </v-btn> 
                </v-row>
                <!--<v-row justify="center" class="mb-4">
                    <v-btn
                    small
                    block
                    text
                    href=""
                    height="32"
                    class="grey--text darken-2 caption grad-bg2 mb-1"
                    >
                         <span class="caption dark-body-text">
                             website
                         </span>
                        </v-btn>
                </v-row>
                -->

                 <v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> 
                            <div v-if="emptyStore" class="mb-10">
                                 <v-img :src="require('../assets/unsuccessful.svg')"></v-img>
                  <span class="title text-center font-weight-light mb-2 pa-5 red">
                  This store in currently empty
                  </span>
                            </div>
                <div v-else> 
        <v-layout row wrap pt-2 mt-1>
                           
                         
                           <v-flex xs6 sm6 md4 lg4 v-for="product in filterHiddenProduct" :key="product.id">
           <transition name="slide-fade" mode="out-in">
            <v-card flat hover class="text-xs-center ma-2" transition="slide-x-transition">
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="1.15"
         ></v-img>
              </v-responsive>
              <!--<v-card-text>
                <div class="subheading text-truncate">
                  {{product.title.rendered}}
                </div>
                <div class="grey--text text-truncate"> {{product.acf.description}}</div>
              </v-card-text>-->
              <v-card-actions>
                  
               <v-btn text color="#23d2aa" 
               class="caption"
               :to="{
                   name: 'product',
                   params: {
                       id: product.id,
                       theproducts:product
                   }
               }"
                >
                  <v-icon small left>mdi-cart</v-icon>
                  Buy
                </v-btn>
                
                <!--<Buy :theproducts="product">

                </Buy>-->
               
                <v-spacer></v-spacer>
                <div class="grey--text caption"> ₦{{product.acf.price}}</div>
              </v-card-actions>
              </v-card>
              </transition>
        </v-flex>
       
                       </v-layout>
                        </div>
        </v-container>
       <v-row justify="center"> 
           <p class="caption text--grey my-5" style="margin: 0 auto">
powered by <img :src="require('../assets/mulaalogo.png')" alt="" style="max-width:70px;margin-left:5px">
           </p>
        
       </v-row>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import Buy from '@/components/BuyProduct'
export default {
    components: {
       // Buy
  },
  props: ['name','theproducts']
   /* props: {
       name: {
            type: String,
            default: 'No User Found'
        },

    }*/,
     data(){
        return{
            search:'',
            userdata: this.$route.params.name,
            dialog: false,
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            uploadMsg: '',
            infoBar: false,
            infoMsg: '', 
            products: '',
            bizPhone: ''
        }
    },
    computed: {
        ...mapGetters([
             'renderUser'
           ]),
      ...mapState({
          emptyStore: 'emptyStore',
      registerMsg:'registerMsg',
      color:'color',
      show:'show',
      loading:'loading',
      user:'user',
      userDesc:'userDesc',
      userKey:'userKey',
      userBusiness:'userBusiness',
      userPhone:'userPhone',
      myproducts:'myproducts',
      userProducts:'userProducts',
      Discounted:'Discounted',
      userUrl:'userUrl',
      userImage:'userImage'
      }),
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
    filteredProducts: function(){
      return this.userProducts.filter((userproduct) => {
        return userproduct.title.rendered.match(this.search) || userproduct.acf.price.match(this.search)
      })
    },
    filterHiddenProduct: function(){
      return this.filteredProducts.filter(function(product) {
					return product.acf.hidden === false;
				});
    }
    },
    mounted() {
        this.bizPhone = 'https://api.whatsapp.com/send?phone='+this.userPhone
    },
     created() {
        this.fetchData()
       // console.log('name: '+ this.name)
    },
    methods: {
    fetchData(){
        this.$store.dispatch('loadUserProducts', this.name)
        this.$store.dispatch('loadUserDetails', this.name)
    }
    
  }
    
}
</script>
<style>
    .slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active for <2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>