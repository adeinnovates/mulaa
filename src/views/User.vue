<template>
    <div class="userpage products fill-height grey lighten-4 pa-5 page">
      <v-sheet
      id="scroll-area-2"
      class="overflow-y-auto"
     color="transparent"
    >
        <v-container>
          <div 
          class="text-right small text-uppercase"
          v-show="showWidget"
          >
        
          <Widget
          :thisUser="userDetails"
          >

          </Widget>
         <!-- <v-icon small color="teal">
              mdi-settings
              </v-icon>
              Widget -->
          </div>
                <div class="text-center">
                  
              <v-avatar class="my-2" size="80">
                <avatar :username=this.user 
                  :rounded=true
                  :src=this.userDetails.brand_image
                  :size=80
                  background-color="#23d2aa"
                  ></avatar>
                </v-avatar>
                <p class="title black--text darken-2 font-weight-black">
                        {{this.userDetails.business_name}}
                    </p>
                     <v-divider width=40% class="align-center d-block" style="margin: 0 auto"></v-divider>
                     <p class="mt-3 mb-3 caption grey--text text--darken-3" style="max-width:350px;margin:0 auto"> {{this.userDetails.business_description}}</p>
                </div>
                <!--<v-row justify="center" class="mb-4">
                    <v-btn small 
                    rounded 
                    class="mt-3 grad-bg2"
                   :href="bizPhone"
                    >
                        <v-icon left>mdi-whatsapp</v-icon>
                       <span class="caption dark-body-text"> chat</span> 
                        </v-btn> 
                </v-row> -->
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
                            <div v-if="emptyStore" class="mb-10 mx-auto">
                                 <v-img :src="require('../assets/unsuccessful.svg')" class="i450img mx-auto"></v-img>
                  <p class="title text-center font-weight-light mb-2 pa-3 red mx-auto">
                  This profile is currently empty
                  </p>
                            </div>
                <div v-else> 

                  <div v-if="!emptyLinks" id="links" 
                          class="mb-3 mt-2 pa-3 mx-auto"
                          style="border:3px dotted rgba(178, 223, 219, 0.3);background-color:rgba(178, 223, 219, 0.2);
                          border-radius:4px;max-width:854px;"
                          >
                         <!-- <v-progress-linear
                            :active=loadinglist
                            indeterminate
                            color="green"
                            ></v-progress-linear>-->
                          <v-card
                          color="#000028"
                          dark
                          class="mb-3"
                          
                          v-for="link in userLinks.slice(0, 4)" :key="link.linkID"
                          >
                              <a :href="link.short_link" target="_blank" class="white--text noline">
                          <v-card-title
                          class="mt-0 subtitle-1 py-2"
                          
                          >
                          <v-icon small left class="teal--text lighten-1">
              mdi-vector-link
              </v-icon>
                          <span class="title text-center" style="width:80%;">
                            {{link.link_title}}
                            </span>
                          <v-spacer></v-spacer>
                         
                          </v-card-title>
                          </a>
                          </v-card>
                  </div>

        <v-layout row wrap pt-3 mt-3 class="layout-desktop mx-auto" style="max-width:854px;">
                           
                         
                           <v-flex xs6 sm6 md4 lg4 v-for="product in filterHiddenProduct" :key="product.productID">
           <transition name="slide-fade" mode="out-in">
            
            <v-card flat hover class="text-xs-center ma-2" transition="slide-x-transition"
            style="border-radius:10px;"
            >
              <router-link
              :to="{
                   name: 'product',
                   params: {
                       id: product.productID,
                       theproducts:product,
                   }
               }"
              >
              <v-responsive class="pt-0" style="border-radius:10px;">
                <v-img
          :src="product.image"
          aspect-ratio="1.15"
          lazy-src="https://picsum.photos/id/1002/10/6"
         >
            <template v-slot:placeholder>
            <v-row
            class="fill-height ma-0"
            align="center"
            justify="center"
            >
            <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
            </v-row>
            </template>
         </v-img>
              </v-responsive>
              </router-link>
                 
              <!--<v-card-text>
                <div class="subheading text-truncate">
                  {{product.title.rendered}}
                </div>
                <div class="grey--text text-truncate"> {{product.acf.description}}</div>
              </v-card-text>-->  <!--<Buy :theproducts="product">

                </Buy>-->
               
              <v-card-actions>
                  
               <v-btn text color="#23d2aa" 
               class="caption"
               :to="{
                   name: 'product',
                   params: {
                       id: product.productID,
                       theproducts:product,
                   }
               }"
                >
                  <v-icon small left>mdi-cart</v-icon>
                  Buy
                </v-btn>
                
               
               
                <v-spacer></v-spacer>
                <div class="grey--text text--darken-3 caption"> ₦{{product.price}}</div>
              </v-card-actions>
              
              </v-card>
              
              </transition>
              
        </v-flex>
       
                       </v-layout>
                        </div>
        </v-container>
        </v-sheet>
       <v-row justify="center" class="mb-10"> 
           <p class="caption text--grey my-5" style="margin: 0 auto">
             
powered by <a href="https://mulaa.co/?utm_source=footer&utm_medium=userpage" target="_blank"><img :src="require('../assets/mulaalogo.png')" alt="" style="max-width:70px;margin-left:5px">
         </a>  </p>
        
       </v-row>

       <v-bottom-navigation
      scroll-target="#scroll-area-2"
      hide-on-scroll
      scroll-threshold="50"
      fixed
      color="#000028"
      horizontal
    >
      <v-btn
      :href="bizPhone"
      >
        <span>Chat</span>
        <v-icon>mdi-whatsapp</v-icon>
      </v-btn>

      <v-btn>
        <span>Email</span>
        <v-icon>mdi-email-outline</v-icon>
      </v-btn>
<!-- :href="`${userInstagram}`" -->
      <v-btn
      :href="`${userInstagram}`"
      target="_blank"
      >
        <span>Instagram</span>
        <v-icon>mdi-instagram</v-icon>
      </v-btn>
    </v-bottom-navigation>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import Buy from '@/components/BuyProduct'
import Widget from '@/components/GetWidget'
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
       Avatar,
       Widget
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
          showWidget: false,
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
            instagram: 'https://instagram.com/',
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
      userDetails: 'userDetails',
      userLinks: 'userLinks',
      emptyLinks:'emptyLinks'
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

      if(this.userProducts != ''){
        //console.log('reddd')
      return this.userProducts.filter((userproduct) => {
      return userproduct.title.match(this.search) || userproduct.price.match(this.search)
      })
      }else{
        console.log('No products yet')
        return null
      }
    
    },
    filterHiddenProduct: function(){
      if(this.filteredProducts != null){
 return this.filteredProducts.filter(function(product) {
					return product.hidden < 1 || product.hidden == false;
				});
      }else{
        return null
      }
     
    }, 
     userInstagram: function(){
       
       if(this.userDetails.instagram != undefined){
         //console.log('reddd ig')
       if(this.userDetails.instagram.includes('@') == true){
         
      const IG = this.userDetails.instagram
      const IGnameSplit = IG.split('@')
      const use = IGnameSplit[1]
     // console.log(IGnameSplit)
      return 'https://instagram.com/'+use
       }else if(this.userDetails.instagram){
          return 'https://instagram.com/'+this.userDetails.instagram
       }
       }else{
    return '#'
       }
   
      

     // return this.userDetails.instagram
     },
    
    },
    mounted() {
        this.getUserPhone()
        this.isPageOwner()
        //this.fetchLinks(this.name)
    },
     created() {
        this.fetchData()
       // console.log('name: '+ this.name)
    },
     watch: {
    // call again the method if the route changes
    getUserPhone(){
this.bizPhone = 'https://api.whatsapp.com/send?phone=234'+this.userDetails.phone_number
    },
    emptyLinks(val){
      if(val == true){
        return
      }
      return
    }
  },
    methods: {
       isPageOwner: function(){
       if (this.$store.getters.isLoggedIn != true){
           return console.log('not logged in')
       }else{
         //console.log('render user: '+ this.$store.getters.renderUser)
         //console.log(this.name)
         if(this.name == this.$store.getters.renderUser){
            return this.showWidget = true
         }
         //return console.log('loggedin user: '+ this.$store.getters.isLoggedIn)
       }
     },
    fetchData(){
      //console.log('this user '+this.name)
        this.$store.dispatch('loadUserProducts', this.name)
        this.$store.dispatch('loadUserDetails', this.name)
        this.$store.dispatch('loadDashboardLinks', this.name)
       // console.log('Name '+this.name)
    },
    getMerchant(){
      return this.userBusiness
    },
    getMerchantInfo(){
      return this.userDetails
    },
    getUserPhone(){
this.bizPhone = 'https://api.whatsapp.com/send?phone=234'+this.userDetails.phone_number
    },
    fetchLinks(val){
      const linkURL = 'https://shop.mulaa.co/api/wp-json/mulaa-link/v1/links'
        //return new Promise((resolve, reject) => {
      
      if (val != ''){
        this.$http.get(`${linkURL}`+'?author='+val+'&skip_cache=1')
        .then(resp => { 
          if(resp.data.length > 0){
            const user_links = resp.data
            //const authorID = resp.data.theAuthor
            
            console.log('links method: '+JSON.stringify(resp.data))
          }else {
           // console.log('No links')
            
            return
          }
          return
          //resolve(resp)
        })
        .catch(err => {
          
          console.log(err)
          //reject(err)
        })
      }else {console.log('An error occured loading links data, try again later')}
    //})
    }
    
  }
    
}
</script>
<style>
[style*="--aspect-ratio"] > :first-child {
  width: 100%;
}
[style*="--aspect-ratio"] > img {  
  height: auto;
} 
@supports (--custom:property) {
  [style*="--aspect-ratio"] {
    position: relative;
  }
  [style*="--aspect-ratio"]::before {
    content: "";
    display: block;
    padding-bottom: calc(100% / (var(--aspect-ratio)));
  }  
  [style*="--aspect-ratio"] > :first-child {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
  }  
}

a.noline{
  text-decoration: none;
}
a.noline:hover{
  color: #B2DFDB;
}
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
/*
.layout-desktop{
  border-radius: 25px 25px 0 0;
  background-color:#fff;
  padding: 20px 5px 0px 5px !important;
}
*/
.i450img{
  max-width:450px;
}

@media (max-width: 360px) {

  .v-application .pa-5.userpage{
    padding: 1px !important;
  }
  
}
</style>