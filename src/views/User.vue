<template>
    <div class="userpage products fill-height grey lighten-5 pa-5 page">
        <v-container>
                <div class="text-center">
                  
              <v-avatar class="my-2" size="80">
                <avatar :username=this.user 
                  :rounded=true
                  :src=this.userDetails.brand_image
                  :size=80
                  background-color="#23d2aa"
                  ></avatar>
                </v-avatar>
                <p class="title grey--text darken-2 font-weight-black">
                        {{name}}
                    </p>
                     <v-divider width=50% class="align-center d-block" style="margin: 0 auto"></v-divider>
                     <p class="mt-2 mb-0 caption grey--text darken-1 font-weight-light" style="max-width:550px;margin:0 auto"> {{this.userDetails.business_description}}</p>
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
                           
                         
                           <v-flex xs6 sm6 md4 lg4 v-for="product in filterHiddenProduct" :key="product.productID">
           <transition name="slide-fade" mode="out-in">
            <v-card flat hover class="text-xs-center ma-2" transition="slide-x-transition">
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="1.15"
          @click="overlay = !overlay"
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
                       id: product.productID,
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
                <div class="grey--text caption"> ₦{{product.price}}</div>
              </v-card-actions>
              </v-card>
              </transition>
              
        </v-flex>
       
                       </v-layout>
                        </div>
        </v-container>
       <v-row justify="center"> 
           <p class="caption text--grey my-5" style="margin: 0 auto">
             
powered by <a href="https://mulaa.co/?utm_source=footer&utm_medium=userpage" target="_blank"><img :src="require('../assets/mulaalogo.png')" alt="" style="max-width:70px;margin-left:5px">
         </a>  </p>
        
       </v-row>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import Buy from '@/components/BuyProduct'
import Avatar from 'vue-avatar'
export default {
  metaInfo() {
    let pageTitle = this.name
    return {
      title: pageTitle ? pageTitle : this.getMerchant,
      titleTemplate: '%s - mulaa.co',
      htmlAttrs: {
        lang: 'en',
        amp: true
      },
      
      meta: [
     {property: 'og:title', content: this.getMerchant},
     {property: 'og:type', content: this.getMerchantInfo.business_name},
     {property: 'og:url', content: this.pagePath},
     {property: 'og:image', content: this.getMerchantInfo.brand_image},
     {property: 'og:description', content: this.getMerchantInfo.business_description},
      ]
    }
    },
    components: {
       Avatar
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
          inputs: [
            {
                name: ''
            }
        ],
            search:'',
            overlay:false,
            userdata: this.$route.params.name,
            dialog: false,
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            uploadMsg: '',
            infoBar: false,
            infoMsg: '', 
            products: '',
            bizPhone: '',
            merchantName : '',
            pagePath: 'https://shop.mulaa.co'+ this.$route.path
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
      userImage:'userImage',
      userDetails: 'userDetails'
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
        return userproduct.title.match(this.search) || userproduct.price.match(this.search)
      })
    },
    filterHiddenProduct: function(){
      return this.filteredProducts.filter(function(product) {
					return product.hidden < 1 || product.hidden == false;
				});
    }
    },
    mounted() {
        this.getUserPhone()
    },
     created() {
        this.fetchData()
       // console.log('name: '+ this.name)
    },
     watch: {
    // call again the method if the route changes
    getUserPhone(){
this.bizPhone = 'https://api.whatsapp.com/send?phone=234'+this.userDetails.phone_number
    }
  },
    methods: {
    fetchData(){
      //console.log('this user '+this.name)
        this.$store.dispatch('loadUserProducts', this.name)
        this.$store.dispatch('loadUserDetails', this.name)
        //console.log('biz desc '+this.userDesc)
    },
    getMerchant(){
      return this.userBusiness
    },
    getMerchantInfo(){
      return this.userDetails
    },
    getUserPhone(){
this.bizPhone = 'https://api.whatsapp.com/send?phone=234'+this.userDetails.phone_number
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