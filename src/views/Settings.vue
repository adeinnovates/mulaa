<template>
    <div class="dashboard fill-height teal lighten-5 page pa-3 mt-10">
<div
class="headline lighten-4 pa-4 font-weight-light teal--text mb-n6 mt-5 mx-auto"
style="max-width:950px"
>
Hello, <br> {{user}}
</div>
 <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#000028">{{infoMsg}}</span>
  <!--<v-btn flat color="white" @click="snackbar = false">close</v-btn>-->
</v-snackbar>
 <v-container fluid fill-height teal lighten-5>
    <v-layout row wrap equal center mx-auto style="max-width:950px;">
                <v-flex xs12 sm8 md7 pa-5>
<v-card
style="border-top-left-radius:15px;border-top-right-radius:15px;"
class="my-5"
outlined
>
<v-card-title>
      <span class="grey--text overline">Business Profile</span>
    </v-card-title>
<v-list two-line subheader class="pa-3">
      <v-subheader>Profile Settings  
        <div class="flex-grow-1"></div>
        <EditSettings :theuser="userDetails" :user="user" :userImg="this.userProfile.profileImg"></EditSettings>
        </v-subheader>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="teal--text subtitle-1 text--darken-2 text-uppercase">
            <v-icon small color="teal">mdi-account-card-details-outline</v-icon>
            Business Name</v-list-item-title>
          <v-list-item-subtitle class="caption">{{userDetails.business_name}}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action>
          
        </v-list-item-action>
      </v-list-item>
<v-divider inset></v-divider>
      <v-list-item three-line>
        <v-list-item-content>
          <v-list-item-title class="teal--text subtitle-1 text--darken-2 text-uppercase">
            <v-icon small color="teal">
              mdi-domain
              </v-icon>
            Business Description</v-list-item-title>
          <v-list-item-subtitle class="caption">{{userDetails.business_description}}</v-list-item-subtitle>
        </v-list-item-content>
         <v-list-item-action>
          
        </v-list-item-action>
      </v-list-item>
<v-divider inset></v-divider>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="teal--text subtitle-1 text--darken-2 text-uppercase">
             <v-icon small color="teal">
              mdi-map-marker
              </v-icon>
            Business Address
            </v-list-item-title>
          <v-list-item-subtitle class="caption">{{userDetails.business_address}}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action>
          
        </v-list-item-action>
      </v-list-item>
    </v-list>
</v-card>


  <v-card 
  outlined
  class="my-5"
  >
  <v-card-title>
      <span class="font-weight-light grey--text overline">Sales Profile</span>
    </v-card-title>
  <v-list two-line subheader class="pa-5">

    <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="teal--text subtitle-1 text--darken-2 text-uppercase">
            <v-icon small color="teal">
              mdi-currency-ngn
              </v-icon>
            Store Delivery Charge</v-list-item-title>
          <v-list-item-subtitle class="caption grey lighten-4 pa-3 mt-2">{{userDetails.delivery_fee}}</v-list-item-subtitle>
        </v-list-item-content>
        
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="teal--text subtitle-1 text--darken-2 text-uppercase">
            <v-icon small color="teal">
              mdi-cash
              </v-icon>
            Payment Key</v-list-item-title>
          <v-list-item-subtitle class="caption grey lighten-4 pa-3 mt-2">{{userDetails.payment_key}}</v-list-item-subtitle>
        </v-list-item-content>
        
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="teal--text subtitle-1 text--darken-2 text-uppercase">Facebook Pixel</v-list-item-title>
          <v-list-item-subtitle class="caption grey lighten-4 pa-3 mt-2">{{userDetails.facebook_pixel}}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>


      <v-list-item>
        <v-list-item-content>
          <v-list-item-title
          class="teal--text subtitle-1 text--darken-2"
          >Profile Photo</v-list-item-title>
          <v-list-item-subtitle>
          
          </v-list-item-subtitle>
        </v-list-item-content>

        <v-list-item-avatar
        tile
        size="100"
      >
       <input 
accept="image/png, image/jpeg, image/bmp"
type="file" 
style="display:none;" 
@change="onFileChanged"
ref="imageinput"
>
<v-overlay 
:value="overlay"
dark
:z-index="9999">
 <v-progress-circular :value="progressValue"></v-progress-circular>
    </v-overlay>
    <div class="text-center mb-5">
    <v-avatar color="#23d2aa" @click="$refs.imageinput.click()" width="70" height="70">
      <img v-if="userProfile.profileImg !=null || undefined" :src="userProfile.profileImg" alt="avatar">
      <v-icon v-else dark>mdi-camera</v-icon>
    </v-avatar>
  </div>
      </v-list-item-avatar>
      </v-list-item>
<v-divider inset></v-divider>
<v-list-item>
   <v-list-item-content>
     <v-list-item-title
          class="teal--text subtitle-1 text--darken-2 mb-1 text-uppercase"
          >
          <v-icon small color="teal">
              mdi-settings
              </v-icon>
          Mulaa Widget
          </v-list-item-title>
          <v-list-item-subtitle class="caption mb-3">
            Embed your mulaa store on your own website/Wordpress
            </v-list-item-subtitle>
  <v-textarea
          filled
          name="input-7-4"
          :readonly=true
          color="teal"
          label="Copy the code below"
          id="embed-code"
          class="small teal lighten-5"
          :value="embedcode"
        ></v-textarea>
        <div class="my-1">
        <v-btn depressed small
        class="white--text"
        color="#000028"
         @click.stop.prevent="copyEmbedCode">Copy Code</v-btn>
      </div>

         </v-list-item-content>
</v-list-item>
    </v-list>
  </v-card>
 
                </v-flex>
                <!-- right column-->
                <v-flex flex xs12 md5 pa-5>
<v-card
style="border-top-left-radius:15px;border-top-right-radius:15px;"
 outlined
 max-width="344"
  class="my-5 mx-auto"
>
<v-card-title>
      <span class="font-weight-light grey--text overline">Mulaa Profile</span>
    </v-card-title>

    <v-card-text>
       <v-sheet 
        class="pa-5"
        v-show="paid"
        color="blue lighten-5"
        style="border:3px dotted rgba(178, 223, 219, 0.3);
                          border-radius:4px;"
        >
        <p class="title text--grey">
        Active Subscription 
      </p>
     
      <div class="blue--text">
        You are subscribed to <strong>{{subName}}</strong>
      </div>
       
        </v-sheet>

        <v-sheet 
        class="pa-5"
        v-show="!paid"
        color="orange lighten-5"
        style="border:3px dotted rgba(178, 223, 219, 0.3);
                          border-radius:4px;"
        >
        <p class="title text--grey">
        No Subscription
      </p>
     
      <div class="text--primary">
        Limited products are displayed on your mulaa link. To display all your products and access all mulaa premium benefits, upgrade to one of our subscription plans below.
      </div>
       
        </v-sheet>


        <div
        v-show="!paid"
        >
          <h3 
          class="title text--accent-3 font-weight-light my-3">
            Choose a plan that works for you
            </h3>
<v-overlay :value="subOverlay">
      <v-progress-circular indeterminate size="84"></v-progress-circular>
    </v-overlay>

    <div 
    v-show="referred"
    >

 <v-sheet 
        class="pa-5"
        color="teal lighten-5"
        style="border:2px dotted rgba(178, 223, 219, 0.3) !important;border-radius:0px;"
        >
        <span class="teal--text subtitle-1 text--darken-1">
          (Discounted) Annual Mogul: N52,500 <v-btn small color="success"
          
          @click="doSubscription('PLN_eoildbokktq5sle', '5250000')"
          >Subscribe</v-btn>
        </span>
      <div class="grey--text text--darken-2 mt-2">
        Unlimited products,
Unlimited content links,
0% transaction charge,
12 months subscription (3 months free)
      </div>
       
        </v-sheet>
        <v-divider inset></v-divider>
        <v-sheet 
        class="pa-5"
        color="teal lighten-5"
        style="border:2px dotted rgba(178, 223, 219, 0.3) !important;border-radius:0px;"
        >
        <span class="teal--text subtitle-1 text--darken-1">
          (Discounted) Quarterly Sprinter: N13,500 <v-btn small color="success"
          
          @click="doSubscription('PLN_c7p40gbev53tons', '1350000')"
          >Subscribe</v-btn>
        </span>
      <div class="text--darken-2 grey--text mt-2">
        Unlimited products,
Unlimited content links,
0% transaction charge,
3 months subscription (pay Quarterly)
      </div>
       
        </v-sheet>

    </div>


          <v-sheet 
        class="pa-5"
        color="teal lighten-5"
        style="border:2px dotted rgba(178, 223, 219, 0.3) !important;border-radius:0px;"
        >
        <span class="teal--text subtitle-1 text--darken-1">
          Annual Mogul: N54,000 <v-btn small color="success"
          :disabled=disabled
          @click="doSubscription('PLN_g4m3pjhpsgb3u14', '5400000')"
          >Subscribe</v-btn>
        </span>
      <div class="grey--text text--darken-2 mt-2">
        Unlimited products,
Unlimited content links,
0% transaction charge,
12 months subscription (3 months free)
      </div>
       
        </v-sheet>
        <v-divider inset></v-divider>
        <v-sheet 
        class="pa-5"
        color="teal lighten-5"
        style="border:2px dotted rgba(178, 223, 219, 0.3) !important;border-radius:0px;"
        >
        <span class="teal--text subtitle-1 text--darken-1">
          Quarterly Sprinter: N15,000 <v-btn small color="success"
          :disabled=disabled
          @click="doSubscription('PLN_xbwopoov59jncbi', '1500000')"
          >Subscribe</v-btn>
        </span>
      <div class="text--darken-2 grey--text mt-2">
        Unlimited products,
Unlimited content links,
0% transaction charge,
3 months subscription (pay Quarterly)
      </div>
       
        </v-sheet>
<v-divider inset></v-divider>
        <v-sheet 
        class="pa-5"
        color="teal lighten-5"
        style="border:2px dotted rgba(178, 223, 219, 0.3) !important;border-radius:0px;"
        >
        <span class="teal--text subtitle-1 text--darken-1">
          Monthly Starter: N6,000 <v-btn small color="success"
          :disabled=disabled
          @click="doSubscription('PLN_pzvz7tl3qnrwbdh', '600000')"
          >Subscribe</v-btn>
        </span>
      <div class="text--darken-2 grey--text mt-2">
        Unlimited products,
Unlimited content links,
0% transaction charge,
1 months subscription
      </div>
       
        </v-sheet>
<v-divider inset></v-divider>
        <v-sheet 
        class="pa-5"
        color="teal lighten-5"
        style="border:2px dotted rgba(178, 223, 219, 0.3) !important;border-radius:0px;"
        >
        <span class="teal--text subtitle-1 text--darken-1">
          Base Plan: N1,000 (x6) 
        </span><v-btn small color="success"
        :disabled=disabled
        @click="doSubscription('PLN_n4bg3qza5v3va6r', '100000')"
        >Subscribe</v-btn>
      <div class="text--darken-2 grey--text mt-2">
        Maximum 3 products
 content links
1% transaction charge
x6 <strong>(Six months subscription = NGN6,000)</strong>
      </div>
        </v-sheet>
<!--
        <v-divider inset></v-divider>
        <v-sheet 
        class="pa-5"
        color="teal lighten-5"
        style="border:2px dotted rgba(178, 223, 219, 0.3) !important;border-radius:0px;"
        >
        <span class="teal--text subtitle-1 text--darken-1">
          Test Plan: N50 
        </span><v-btn small color="success"
        :disabled=false
        @click="doSubscription('PLN_vuxlonot3gy9bmg')"
        >Subscribe</v-btn>
      <div class="text--darken-2 grey--text mt-2">
        Maximum 3 products
 content links
1% transaction charge
x6 <strong>(Six months subscription = NGN6,000)</strong>
      </div>
        </v-sheet>
        -->
        </div>
    </v-card-text>

</v-card>
                </v-flex>
    </v-layout>
         
 </v-container>
    </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import Avatar from 'vue-avatar'
import EditSettings from '@/components/EditSettings'
import UserSubscribe from '@/components/Subscribe'

import axios from 'axios'

export default {
  components: {
    Avatar,
     EditSettings,
     UserSubscribe
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
       userAcctStatus: 'userAcctStatus'
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
    salesCount: function(){
      return Object.keys(this.userSales).length;
    },
    myProfileImg: {
    get: function() {
      //concat using template literal
      return userDetails.brand_image 
    }
  }
    },
    data() {
      return {
        disabled: false,
        nextPlanDate:'',
        embedcode: `<div class="mulaa_embed" data-src="https://mulaa.me/u/`+ this.$store.state.user +`" style="height:400px;width:680px;margin: 10px auto" data-responsive="true" data-img="https://shop.mulaa.co/shop_cover.png" data-css="background:url('//shop.mulaa.co/loading.gif') white center center no-repeat;border:0px;float:middle;" data-Id="mulaa-sdk" data-Class="mulaa-sdk" data-name="mulaa.co"></div>
        `+'<script src="https://shop.mulaa.co/async-iframe.js"',
        paid: false,
        referred:false,
        subName: '',
        skk: process.env.VUE_APP_SECRET_KEY,
        subOverlay:true,
        infoMsg: '', 
        infoBar: false,
 valid:'',
  overlay: false,
   progressValue:'',
   plans: {
     starter: 'PLN_pzvz7tl3qnrwbdh',
     Active: 'PLN_xbwopoov59jncbi',
     Leading: 'PLN_g4m3pjhpsgb3u14',
     Base: 'PLN_n4bg3qza5v3va6r',
   },
  userProfile: 
            {
                city:'',
                phone:'',
                validid: [],
                profileImg: this.myProfileImg
            },
            userURL: 'https://mulaa.me/u/'+this.$store.state.user,
      }
    },
     created() {
        return this.fetchUserData()
    },
     methods: {
       copyEmbedCode () {
          let testingCodeToCopy = document.querySelector('#embed-code')
          testingCodeToCopy.setAttribute('type', 'text')   
          testingCodeToCopy.select()

          try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            alert('Embed code was copied ' + msg);
          } catch (err) {
            alert('Oops, unable to copy');
          }

          /* unselect the range */
          testingCodeToCopy.setAttribute('type', 'hidden')
          window.getSelection().removeAllRanges()
        },
       doSubscription(level, amnt){
            //console.log(level)
            this.subOverlay = !this.subOverlay
            //let skey = 'sk_live_01952d79b3b14815af91d560256959358299e123'
            let subData = {
            email: this.userDetails.user_email,
            amount: amnt,
            currency: "NGN",
            callback_url: "http://shop.mulaa.co/settings/confirm",
            plan:level
            }
            console.log(subData)
            const options = {
            headers: {'Authorization': 'Bearer '+this.skk}
            }
            axios.post(`https://api.paystack.co/transaction/initialize`,
            subData, options
            ).then(resp => {
            //console.log(resp.data)
            if(resp.data.status == true){
            /*
            this.$http.post('/subscription',
            {
            title: resp.data.data.reference,
            fields : {
            trans_ref: resp.data.data.reference,
            user: this.userDetails.email
            },
            status: "publish"
            }
            ).then(response => {
            console.log('sub post: '+response.data)
            this.loading = false
            })
            */
            this.subOverlay = false
            //console.log('response: ' + JSON.stringify(resp.data.data))
            window.location = resp.data.data.authorization_url
            }

            }).catch(err => {
            console.log(err)   
            })

       },
        onFileChanged (event) {
    this.userProfile.profileImg = event.target.files[0]
    this.overlay = true
    this.onUpload()
  },
  onUpload() {
    // upload file
    const formData = new FormData()
    formData.append('avatar', this.userProfile.profileImg, this.userProfile.profileImg.name)
    formData.append('username', this.user);
    

const headers2 = {
  'Content-Type': 'multipart/form-data'
}
    //axios.post(`//dev.mulaa.co/imgapi/upload.php`, formData, {
       axios.post(`https://shop.mulaa.co/imgapi/upload.php`, formData, {
    headers: headers2,
    onUploadProgress: progressEvent => {
       this.progressValue = Math.round(progressEvent.loaded / progressEvent.total *100)
      console.log(Math.round(progressEvent.loaded / progressEvent.total *100) + '%')
    }
  })
    .then(resp => {
           //console.log(resp.data.url)
           this.userProfile.profileImg = resp.data.url
            this.overlay = false
            this.infoBar = true
            this.infoMsg = 'profile image uploaded'
            //resolve(resp)
          })
          .catch(err => {
              console.log(err)
              this.overlay = false
              //this.infoBar = true
              //this.infoMsg = 'profile image failed, try again'
            //reject(err)
          })
  },
fetchUserData(){
  //this.$store.dispatch('loadUserDetails', this.name)
  console.log('fetch user')
        this.$store.dispatch('loadUserDetails', this.user).then(resp => {
          this.subOverlay = false
          const response = resp.data[0]
          //console.log(response)
          //console.log('userDetail: '+response.acf.referal)
        this.chkref()
        }
        )
    },/*
    confirmSub(tranx){
      const config = {
            headers: {'Authorization': 'Bearer '+this.skk}
            }
            axios.get('https://api.paystack.co/customer/'+tranx, config)
        .then(resp => { 
            const trxData = resp.data.data.subscriptions
            //console.log(trxData[0])
            if(trxData[0].status == 'active'){
              this.paid = true
              this.nextPlanDate = trxData[0].next_payment_date//.toDateString()

              //console.log('date: '+ this.nextPlanDate)
            }else{
               this.paid = false
              return
            }
            //console.log(trxData)
        }).catch(err => {
            //const linkData = 0
            console.log(err)
            //reject(err)
          })
    },*/
    chkref : function () {
       
        //return Object.keys(this.myproducts).length;
//console.log('chk rf')
        if(this.userDetails.referal !=''){
           this.referred = true
           this.disabled = true
          // console.log('ref: '+this.userDetails.referal)
         }
         return
    }
     },
     watch: {
       userDetails(val){
         //this.paid = true
         //console.log(this.userDetails.email)
         //console.log(this.userDetails.last_payment_date)
         if(this.userDetails.subscription_status == 'active'){
           //this.paid = true
           //console.log(this.userDetails.customer_code)
           //this.confirmSub(this.userDetails.customer_code)
           //this.confirmSub()
              this.paid = true
              //this.nextPlanDate = trxData[0].next_payment_date//.toDateString()
         }else{
               this.paid = false
              //return
            }
         /*if(this.userDetails.referal !=''){
           this.referred = true
         }*/
         this.subName = this.userDetails.subscription
       },
       referred(){
         return
       }
     },
  
}
</script>
<style>
.v-list .v-divider--inset:not(.v-divider--vertical){
  max-width: 100% !important;
  margin-left:0;
}
</style>