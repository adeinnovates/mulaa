<template>
    <div class="dashboard fill-height teal lighten-5 pa-1 page">
         <v-container fluid fill-height teal lighten-5>
             <v-layout row wrap equal>
                <v-flex xs12 sm8 md7 pa-5>
                   <!-- <div class="text-center pt-5 mt-3 mb-1">
                        <v-sheet v-if="counted == 1" color="caption red lighten-4 pa-2 rounded my-3" style="color:#000028" elevation="0">
{{userAcctStatus}}
</v-sheet>
<v-sheet v-else color="caption orange lighten-4 pa-2 rounded" style="color:#000028" elevation="0">
your link: {{userURL}}
</v-sheet>
</div>
-->

<v-layout row wrap pt-10>
                       
                           <v-flex xs12 sm6 md3 lg3>
                                <v-chip
                                class="ma-2 teal lighten-4"
                                color=""
                                >
                                <v-avatar left>
                                <v-icon class="grey--text text--darken-4">
                                    mdi-link
                                    </v-icon>  
                                </v-avatar>
                                    Total Clicks 
                                    <v-avatar right
                                    class="teal darken-1 white--text"
                                    >
                                    {{linkStat.clicks}}
                                     </v-avatar>
                                </v-chip>
                               
                           </v-flex>
                           <v-flex xs12 sm6 md3 lg3>
                                <v-chip
                                class="ma-2 teal lighten-4"
                                color=""
                                >
                                <v-avatar left>
                                <v-icon class="grey--text text--darken-4">
                                    mdi-link
                                    </v-icon>  
                                </v-avatar>
                                    Unique Clicks 
                                    <v-avatar right
                                    class="teal darken-1 white--text"
                                    >
                                    {{linkStat.uniqueClicks}}
                                     </v-avatar>
                                </v-chip>
                           </v-flex>

                          
                    </v-layout>
                    <v-layout row wrap pt-2>
                       
                           <v-flex xs6 sm6 md4 lg4>
                                <v-card
                                color="#000028"
                                dark
                                class=ma-2
                                >
                                <v-card-text class="">
                                <div class="title mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-3 mr-2">
                                    mdi-cart
                                    </v-icon>  
                                    Total Products
                                    </div>
                                <p class="font-weight-bold display-2 white--text">
                                    {{counted}}
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                           <v-flex xs6 sm6 md4 lg4>
                                <v-card
                                color="#000028"
                                dark
                                class=ma-2
                                >
                                <v-card-text class="white--text">
                                <div class="title mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-3 mr-2">
                                    mdi-basket
                                    </v-icon>               
                                    Total Sales
                                </div>
                                <p class="font-weight-bold display-2 white--text">
                                    {{salesCount}}
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                           <v-flex xs6 sm6 md4 lg4 d-none d-sm-none d-md-flex>
                                <v-card
                                color="grey"
                                dark
                                class=ma-2
                                >
                                <v-card-text class="white--text">
                                <div class="title mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-1 mr-2">
                                    mdi-account-check-outline
                                    </v-icon>  
                                    Total Leads
                                </div>
                                <p class="font-weight-bold display-1 white--text">
                                    coming soon
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                    </v-layout>

                   <EmptyState v-if="counted < 1"></EmptyState>
                   <div v-else>
                       <!-- <div class="text-center mt-5 pt-4">
                            <v-sheet color="transparent">Add a new product</v-sheet>
                            <v-spacer></v-spacer>
                            <v-btn class="mx-2 mt-2" fab dark color="teal lighten-3 teal--text">
                                <v-icon dark>mdi-plus</v-icon>
                            </v-btn>
                        </div>-->
                        <AddProduct></AddProduct>
                        <p class="overline mb-0">products</p>
                       <v-layout row wrap pt-2 mt-1>
                            <!--<v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> -->
                           <v-flex xs6 sm6 md4 lg4 v-for="product in userProducts.slice(0, 4)" :key="product.productID">
            <v-card flat hover class="text-xs-center ma-2">
              <div v-if="product.hidden == 1" class="hiddenProd">
            <v-chip
            class="ma-2 point"
            color="red"
            label
            x-small
            text-color="white"
            >
            <v-icon x-small left>mdi-close</v-icon>
            hidden
            </v-chip>
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="1.75"
         ></v-img>
              </v-responsive>
              <v-card-text class="pb-0">
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
              </div>
              
               <div v-else class="visibleProd">
                  <v-chip
                  class="ml-5 mt-4 point"
                  color="white"
                  text-color="grey darken-1"
                  small
                  >
                  <v-avatar
                  left
                  class="ml-n4 grey lighten-4"
                  small
                  >
                  {{product.pageView}}
                  </v-avatar>
                  <v-icon small color="grey lighten-2">mdi-eye</v-icon>
                  </v-chip>
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="1.75"
         ></v-img>
              </v-responsive>
              <v-card-text class="pb-0">
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
                <div class="grey--text small mr-2"> ₦{{product.price}}</div>
              </v-card-actions>
              </div>

              </v-card>
        </v-flex>
                       </v-layout>
                       <MoreBtn></MoreBtn>
                   </div>
                </v-flex>
                <!--
                <v-flex sm1>
                    <v-divider
      class="mx-0"
      vertical
    ></v-divider>
                </v-flex>
                -->
                 <v-flex pa-5 d-none d-sm-none d-md-flex class="border-left">
                  
                     <div class="pt-5 mt-5 pl-10">
                       <p class="caption small">
                         My store link preview: 
                         <v-chip
      class="ma-1 teal lighten-4"
    >
      {{userURL}}
    </v-chip>
              

                       </p>
                        <vue-friendly-iframe :src="previewUrl"></vue-friendly-iframe>
                     </div>
                    
                </v-flex>
             </v-layout>
         </v-container>

      <v-bottom-sheet v-model="sheet" class="teal--text text--lighten-3">
      <v-sheet class="text-center" height="270px" style="background-color:#000028 !important;border-top-left-radius:25px;border-top-right-radius:25px;">
      <!--<v-progress-linear
      :value="50"
      class="my-0"
      height="3"
      ></v-progress-linear>
      -->

      <!--<v-btn
      class="mt-2"
      text
      color="red"
      @click="sheet = !sheet"
      >X</v-btn>-->
 <div class="pa-3">
   <p class="text-center teal--text text--lighten-3 pt-2">
      Congrats {{this.user}},
        <br>
        You just uploaded a product for sale, well done! <br>
        Before this becomes open for customers to buy, complete your profile to sell better with mulaa  
        <v-btn
        ripple
        small
      class="my-2"
      color="teal"
      to="/onboard"
      >Update Profile</v-btn>
<v-img :src="require('../assets/winner.svg')"></v-img>
      </p>
   </div>
      
      </v-sheet>
      </v-bottom-sheet>

    </div>
</template>

<script>
import EmptyState from '@/components/EmptyProducts'
import MoreBtn from '@/components/MoreBtn'
import AddProduct from '@/components/AddProduct'
import Editor from '@/components/Editor'

import { mapState, mapGetters } from 'vuex'

export default {
    props: ['theproducts'],
    components: {
        EmptyState,
        MoreBtn,
        AddProduct,
        Editor,
  },
    data(){
        return{
          sheet: this.$route.params.sheet || false,
            copySucceeded: null,
            userURL: 'https://mulaa.me/u/'+this.$store.state.user,
            previewUrl:'https://shop.mulaa.co/u/'+this.$store.state.user,
            slides: 5,
    active: 1,
            dialog: false,
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            uploadMsg: '',
            infoBar: false,
            infoMsg: '', 
            products: '',
            previewStore: this.userURL
        }
    },
    created() {
      //this.fetchUserData()
      //console.log('created')
        return this.fetchData()
        
    },
    /* watch: {
    // call again the method if the route changes
    '$route': 'fetchData'
     },*/
    methods: {
      linkData(){
        if(linkStat.length>0){
          console.log(linkStat)
return linkStat;
        }
return 0;
      },
      fetchUserData(){
        this.$store.dispatch('loadUserDetails', this.user)
        //console.log('fetch userDetails')
    },
        handleCopyStatus(status) {
      this.copySucceeded = status
    },
    move(amount) {
      let newActive
      const newIndex = this.active + amount
      if (newIndex > this.slides) newActive = 1
      if (newIndex === 0) newActive = this.slides
      this.active = newActive || newIndex
    },
    jump(index) {
      this.active = index
    },
    fetchData(){
        //this.$store.dispatch('loadAllProducts', 'top')
         this.$store.dispatch('loadUserSales', this.user)
         this.$store.dispatch('loadUserDetails', this.user)
          this.$store.dispatch('linkStats', this.user)
          
         
       // this.$store.dispatch('getUser', this.user)
       //this.reload()
    }
    
  },
  mounted(){
      //this.$store.dispatch('loadUserProducts', this.user)
    },
  computed: {
        ...mapGetters([
             'renderUser'
           ]),
      ...mapState({
      registerMsg:'registerMsg',
      color:'color',
      show:'show',
      loading:'loading',
      user: 'user',
      allProducts: 'allProducts',
      myproducts:'myproducts',
      Discounted:'Discounted',
      userPhone: 'userPhone',
       userDetails: 'userDetails',
       userAcctStatus: 'userAcctStatus',
       userProducts:'userProducts',
       linkStat: 'linkStat'
      }),
    userSales: {
      get() {
        return this.$store.state.userSales;
      },
      set(value) {
        this.$store.commit('user_sales', value);
      }
    },
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
      get(value) {
        return this.$store.state.userProducts;
      },
      set(value) {
        this.$store.commit('loadUserProducts', value);
      }
    },
     currentUserDetail: {
      get() {
        return this.$store.state.userDetails;
      },
      set(value) {
        this.$store.commit('loadUserDetails', value);
      }
    },
    counted : function () {
        return Object.keys(this.userProducts).length;
    },
    countApproved: function () {
        return Object.keys(this.approved).length;
    },
    salesCount: function(){
      return Object.keys(this.userSales).length;
    },
    hiddenProd: function(){
     
    }
    },
    watch: {
      '$route': 'fetchData',
      counted(newVal, oldVal){
          if(newVal == 1){
            return this.sheet = true
          }
      }
    }
}
</script>
<style>
.border-left{
  border-left:1px dashed #4DB6AC;
  background-color: #80CBC4!important;
}
.hotGrad{
  background: #f857a6;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #ff5858, #f857a6);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #ff5858, #f857a6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.hotGrad2{
  background: #e43a15;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #e65245, #e43a15);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #e65245, #e43a15); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.calmGrad{
  background: #5f2c82;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #49a09d, #5f2c82);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #49a09d, #5f2c82); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.calmGrad2{
  background: #24C6DC;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #514A9D, #24C6DC);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #514A9D, #24C6DC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
.v-application .teal.lighten-5{
  background-image: url('~@/assets/bg-wrap.png') !important;
}
.theme--light.v-text-field--outlined fieldset {
    border-color: rgba(178, 223, 219, 0.54) !important;
}
.img-inputer.img-inputer--light, .img-inputer.img-inputer--{
  border-color: rgba(178, 223, 219, 0.54) !important;
  background-color:rgba(224, 242, 241, 0.24)!important;
}
.vue-friendly-iframe{
  padding:6em 2em;
  background-color:#B2DFDB;
  max-width: 380px;
    border-radius: 25px;
}
.vue-friendly-iframe iframe{
  border:0;
  height: 530px;
  display:block;
margin: 0 auto;
}
.teal-bg{
  background-color:#B2DFDB;
}
.small{
  font-size: 11px !important;
}
.hiddenProd{
    border-bottom: 2px solid red;
    filter: alpha(opacity=80);
  /* Modern Browsers */
  opacity: 0.8;
}
.visibleProd{
opacity: 1;
}
.visibleProd .point{
position: absolute;
  z-index:2;
}
.hiddenProd .point{
  position: absolute;
  z-index:9999;
}
.hiddenProd::before {   /* Added */
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color:transparent;
  transition: 0.5s;
}
    .headlineText{
        color: #000028;
    }
    .equal{
        height: 100%;
    }
    .equal>div{
        flex:1;
        flex-direction: column;
    }


.prev,
.next {
  position: absolute;
  top: 50%;
  width: 50px;
  height: 50px;
  border: 2px solid #221e21;
  color: #221e21;
  border-radius: 50%;
  margin-top: -25px;
  margin-left: 25px;
  cursor: pointer;
  line-height: 48px;
  text-align: center;
  text-indent: -2px;
  transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.prev:hover,
.next:hover {
  background: #221e21;
  color: #fff;
  transform: scale(1.2);
}
.prev:active,
.next:active {
  transform: translate(0, 3px) scale(1.2);
}

.next {
  right: 0;
  margin-left: auto;
  margin-right: 25px;
  text-indent: 2px;
}

.dots {
  position: fixed;
  display: block;
  width: 100%;
  text-align: center;
  bottom: 20px;
}
.dots li {
  width: 6px;
  height: 6px;
  border-radius: 3px;
  background: #221e21;
  opacity: 0.2;
  display: inline-block;
  margin: 0 3px;
  cursor: pointer;
  transition: opacity 0.4s ease-in-out, width 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.dots li.active {
  width: 22px;
  opacity: 1;
}
.slides {
  display: flex;
  /*height: 100%;*/
  align-items: center;
  justify-content: center;
  font-weight: bold;
}

.slides .animated {
  transition: all 400ms;
  position: absolute;
  transform: translate(-50%, -50%);
}
.slides .slide-in {
  opacity: 0;
  transform: translate(-40%, -50%);
}
.slides .slide-in-active {
  transition-delay: 150ms;
}
.slides .slide-out {
  opacity: 1;
}
.slides .slide-out-active {
  opacity: 0;
  transform: translate(-60%, -50%);
}

</style>