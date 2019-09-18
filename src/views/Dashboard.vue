<template>
    <div class="dashboard fill-height teal lighten-5">
         <v-container fluid fill-height teal lighten-5>
             <v-layout row wrap equal>
                <v-flex xs12 sm8 md8 pa-5>
                     <div class="text-center pt-5 mt-5 mb-2">
<v-sheet color="caption orange lighten-3 pa-2 rounded" style="color:#000028" elevation="1">
your link: {{userURL}} {{userPhone}}
<v-btn small text
>
    <!--<span class="caption teal--text">
    copy
    </span>-->
    </v-btn>
</v-sheet>
<p v-if="copySucceeded === true">Copied!</p>
    <p v-if="copySucceeded === false">Press CTRL+C to copy.</p>
</div>
                    <v-layout row wrap>
                       
                           <v-flex xs6 sm6 md4 lg4>
                                <v-card
                                color="#000028"
                                dark
                                class=ma-4
                                >
                                <v-card-text class="">
                                <div class="headline mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-3 mr-2">
                                    mdi-cart
                                    </v-icon>  
                                    Total Products
                                    </div>
                                <p class="font-weight-bold headline white--text">
                                    {{counted}}
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                           <v-flex xs6 sm6 md4 lg4>
                                <v-card
                                color="#000028"
                                dark
                                class=ma-4
                                >
                                <v-card-text class="white--text">
                                <div class="headline mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-3 mr-2">
                                    mdi-basket
                                    </v-icon>               
                                    Total Sales
                                </div>
                                <p class="font-weight-bold headline white--text">
                                    {{salesCount}}
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                           <v-flex xs6 sm6 md4 lg4 d-none d-sm-none d-md-flex>
                                <v-card
                                color="grey"
                                dark
                                class=ma-4
                                >
                                <v-card-text class="white--text">
                                <div class="headline mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-1 mr-2">
                                    mdi-account-check-outline
                                    </v-icon>  
                                    Total Leads
                                </div>
                                <p class="font-weight-bold headline white--text">
                                    coming soon
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                    </v-layout>

                   <EmptyState v-if="myproducts.length < 1"></EmptyState>
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
                           <v-flex xs6 sm6 md4 lg4 v-for="product in myproducts.slice(0, 4)" :key="product.id">
            <v-card flat hover class="text-xs-center ma-2">
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="2.75"
         ></v-img>
              </v-responsive>
              <v-card-text>
                <div class="subheading text-truncate">
                  {{product.title.rendered}}
                </div>
                <div class="grey--text text-truncate"> {{product.acf.description}}</div>
              </v-card-text>
              <v-card-actions>
               <!-- <v-btn text color="#23d2aa" :to="{name:'product',params: {
                    id: product.id
                  }}">
                  <v-icon small left>mdi-square-edit-outline</v-icon>
                  
                </v-btn>-->
                <Editor :theproducts="product"></Editor>
                <v-spacer></v-spacer>
                <div class="grey--text"> ₦{{product.acf.price}}</div>
              </v-card-actions>
              </v-card>
        </v-flex>
                       </v-layout>
                       <MoreBtn></MoreBtn>
                   </div>
                </v-flex>
                <v-flex sm1>
                    <v-divider
      class="mx-0"
      vertical
    ></v-divider>
                </v-flex>
                 <v-flex xs12 sm3 md3 pa-5 d-none d-sm-none d-md-flex>
                     <div class="pt-5 mt-5">
                        div right
                     </div>
                    
                </v-flex>
             </v-layout>
         </v-container>

      <v-bottom-sheet v-model="sheet" class="teal--text text--lighten-3">
      <v-sheet class="text-center" height="250px" style="background-color:#000028 !important;">
      <v-progress-linear
      :value="50"
      class="my-0"
      height="3"
      ></v-progress-linear>

      <v-btn
      class="mt-2"
      text
      color="red"
      @click="sheet = !sheet"
      >X</v-btn>
 <div class="pa-3">
   <p class="text-center teal--text text--lighten-3">
        Welcome {{this.user}},
        <br>
        Complete your profile to begin selling with mulaa  
        <v-btn
      class=""
      color="teal"
      to="/onboard"
      >Click Here</v-btn>
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
            userURL: 'https://shop.mulaa.co/u/'+this.$store.state.user,
            slides: 5,
    active: 1,
            dialog: false,
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            uploadMsg: '',
            infoBar: false,
            infoMsg: '', 
            products: ''
        }
    },
    created() {
        return this.fetchData()
    },
     watch: {
    // call again the method if the route changes
    //'$route': 'fetchData'
  },
    methods: {
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
        this.$store.dispatch('loadAllProducts', 'top')
         this.$store.dispatch('loadUserSales', this.user)
         
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
       userDetails: ' userDetails'
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
    counted : function () {
        return Object.keys(this.myproducts).length;
    },
    countApproved: function () {
        return Object.keys(this.approved).length;
    },
    salesCount: function(){
      return Object.keys(this.userSales).length;
    }
    }
}
</script>
<style>
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