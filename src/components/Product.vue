<template>
    <div class="single-product page">
        <v-card
            max-width="454"
            class="mx-auto"
            >
           <v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> 
<v-form
      ref="buyForm"
      class="pa-0"
    >
           
 <v-snackbar v-model=infoBar top right :color="color" :value=infoMsg>
  <span>{{infoMsg}}</span>
  <v-btn text overline color="white" @click="infoBar = false">close</v-btn>
</v-snackbar>
<v-row align="center" justify="center">
                    <v-img
                    :src="image"
                    lazy-src="https://picsum.photos/id/11/10/6"
                    aspect-ratio="1"
                    class="grey lighten-2 mb-3 cursor"
                    max-width="500"
                    max-height="300"
                    @click="overlay = !overlay"
                    >

<v-row class="fill-height d-flex wrap justify-space-between" style="flex-direction: column;height:100%">
<v-card-title class="ml-5">

            <!-- <social-sharing :url=pageurl
                :title=title
                :description=description
                :quote=description
                hashtags="mulaa,buy,shop,share,deal"
                inline-template>
                 <div class="caption grey--text text--darken-2 grey lighten-5 px-3" elevation=5 style="border-radius:10px">
              
                    <network network="facebook" class="px-3">
                    <i class="fa fa-facebook"></i> 
                    </network>
                    <network network="sms" class="px-3">
                    <i class="fa fa-commenting-o"></i>
                    </network>
                    <network network="twitter" class="px-3">
                    <i class="fa fa-twitter"></i>
                    </network>
                    <network network="whatsapp" class="px-3">
                    <i class="fa fa-whatsapp"></i>
                    </network>
                  
                     </div>
                </social-sharing>-->
</v-card-title>
<v-card-text class="white--text ml-5">
<div class="headline font-weight-light pt-12 otto">{{this.title}}</div>
</v-card-text>
</v-row>

                    </v-img>

<v-overlay 
:value="overlay"
:opacity="0.9"
>
<div 
style="width:85%;margin-left:5%"
>
<v-layout row wrap mx-auto>
  
  <v-flex xs10 sm9 md9 lg9>
<div class="headline font-weight-light">{{this.title}}</div>
  </v-flex>
 <v-flex xs2 sm3 md3 lg3 text-right>
    <v-btn
icon
@click="overlay = false"
>
<v-icon right>mdi-close</v-icon>
</v-btn>
  </v-flex>
</v-layout>
</div>

<v-layout row wrap mx-auto>
  
<v-flex xs10 sm9 md9 lg9>
<div class="mx-auto" style="width:390px;" v-if="pslides.length > 0">
    <vue-glide ref="slider" type='carousel' :perView=1 :gap=5 :autoplay=3000 :hoverpause=true
    :animationDuration=400
    :peek="30"
    >
          <vue-glide-slide v-for="slide in pslides" :key="slide.id">
          <v-card
          max-width="400"
          class="mx-auto mb-3 pa-0"
          outlined
          :flat=true
          >
          <v-img
          class="white--text elevation-5 grey lighten-2"
          height="320px"
          max-width="400"
          lazy-src="https://picsum.photos/id/1002/10/6" 
          :src="slide.source_url"
          @click="overlay = !overlay"
          >
          <template v-slot:placeholder>
          <v-layout
          fill-height
          align-center
          justify-center
          ma-0
          >
          <v-progress-circular indeterminate color="#1A227E lighten-5"></v-progress-circular>
          </v-layout>
          </template>

          
          </v-img>

          </v-card>
          </vue-glide-slide>
    </vue-glide>
</div>

<div class="mx-auto" style="width:390px;" v-else>
<v-img
:src="image"
lazy-src="https://picsum.photos/id/11/10/6"
height='300'
width="300"
class="grey lighten-2 mb-3"
style="border-radius:10px;"
@click="overlay = !overlay"
>
<div v-show="this.stock == 0" class="outofstock">
              <v-chip
              class="ma-2 point text-uppercase font-weight-black"
              color="red"
              label
              small
              text-color="white"
              >
              <v-icon small left>mdi-cart-off</v-icon>
              sold out
              </v-chip>
              </div><!-- hidden / out of stock-->
</v-img>

  </div>


  </v-flex>
</v-layout>


<v-layout row wrap mx-auto style="width:85%;margin-left:5%;">
  <v-flex xs3 sm3 md4 lg4>
        <v-btn text color="#23d2aa" 
        class="caption"
        @click="overlay = false"
        v-show="this.stock > 0"
        >
        <v-icon small left>mdi-cart</v-icon>
        Buy Now
        </v-btn>
  </v-flex>
 <v-flex xs9 sm9 md8 lg8 text-right>
          <social-sharing :url=pageurl
          :title=title
          :description=description
          :quote=description
          hashtags="mulaa,buy,shop,share,deal"
          inline-template>
          <div class="caption grey--text text--darken-2 px-3 mt-1">

          <network network="facebook" class="px-3 blue--text text--darken-2">
          <i class="fa fa-facebook fa-lg"></i> 
          </network>
          <network network="sms" class="px-3 blue--text">
          <i class="fa fa-commenting-o fa-lg"></i>
          </network>
          <network network="twitter" class="px-3 blue--text text--lighten-2">
          <i class="fa fa-twitter fa-lg"></i>
          </network>
          <network network="whatsapp" class="px-3 green--text">
          <i class="fa fa-whatsapp fa-lg"></i>
          </network>

          </div>
          </social-sharing>
  </v-flex>
</v-layout>

</v-overlay>
</v-row>

               <!-- <v-card-title>-->
                    <!--<span class="headline grey--text text--darken-2 mb-1 px-4 font-weight-light pl-8">
                    {{this.title}}
                    </span>-->
               
              <!--  </v-card-title>-->
            

            <v-card-text class="py-0"> 
            <div class="px-4">
            <v-row>
            <v-col
            class=col-12
            >
            <p class="caption grey--text text--darken-2 mb-0">
            <span class="font-weight-bold">
            Product Details
<br />
            </span>
            {{description}}
            </p>
           
            </v-col>
            </v-row>  
            <v-row v-if="delivery_locations_obj">
         <v-col v-if="this.eproduct == false || this.eproduct == 0">
           <p class="caption grey--text text--darken-2 mb-0">
            <span class="font-weight-bold">
              Delivery Location(s): 
              </span>
              </p>
 <v-chip v-for="tag in delivery_locations_obj" x-small class="mb-2 mr-1 red lighten-5" :key="tag">
                    {{tag}}
                     </v-chip> 
         </v-col>
         <v-col v-else> 
           <v-chip small class="mb-2 mr-1 blue lighten-5">
Digital Product
           </v-chip>
           <v-sheet v-if="this.eproduct == true || this.eproduct == 1" class="caption blue lighten-5 pa-2 rounded mb-2" style="color:#000028" elevation="0">
This is a digital product, upon confirmation of payment an email will be sent to you to access <strong>{{this.title}}</strong>
</v-sheet>
         </v-col>
         </v-row>
            </div>
            </v-card-text>

  <v-card-actions class="px-5 text--darken-1 teal--text">
       <v-badge color="green" v-if="this.discounted">
      <template v-slot:badge>
        <span 
        class="px-2" 
        style="font-size:10px"
        >discount</span> <!-- <v-icon dark>mdi-check</v-icon> payWithPaystack -->
      </template>
      <span class="headline font-weight-light mb-0 teal--text">{{newAmount | currency}}</span>
    </v-badge>
    <p v-else class="headline font-weight-light mb-0 teal--text pl-3">
       {{newAmount | currency}}
        </p>
             <v-btn
             text
             @click.stop="sheet = true"
             color="#23d2aa" 
             class="ml-10"
             :disabled=disabled :loading="loading"
             v-show="this.stock > 0"
             >
              <v-icon small left>mdi-cash</v-icon>
                CheckOut
             </v-btn>
             <v-chip outlined 
             color='red'
             class="ml-10"
             v-show="this.stock == 0"
             >
                  Sold Out
              </v-chip>
             <!--
               <v-btn text color="grey" 
               class="caption grey--text"
               :to="{
                   name: 'merchant',
                   params: {
                       name: this.name
                   }
               }"
                >
                  <v-icon small left>mdi-undo</v-icon>
                  Back
                </v-btn> 
                -->

            </v-card-actions>

 <v-card-text class="">
     <div class="px-4">
  <v-row>
                <v-col>
                <v-text-field
                class="teal--text form-field ma-0 pa-0"
                v-model="buyerName"
                label="Full Name"
                placeholder="Full Name"
                color="teal lighten-3"
                ></v-text-field>
                </v-col>
                <v-col>
                <v-text-field
                class="teal--text form-field ma-0 pa-0"
                label="Phone"
                v-model="buyerPhone"
type="number"
                placeholder="Mobile"
                color="teal lighten-3"
                ></v-text-field>
                </v-col>
                </v-row>
                <v-row>
                <v-col>
                <v-text-field
                class="teal--text form-field ma-0 pa-0"
                v-model="buyerEmail"
                :rules="emailRules"
                label="Email"
                placeholder="Your Email"
                color="teal lighten-3"
                ></v-text-field>
                </v-col>
                </v-row>

<v-row v-if="this.eproduct == false || this.eproduct == 0">
                <v-col>
                <v-text-field
                class="teal--text form-field ma-0 pa-0 mb-5"
                v-model="buyerAddress"
                label="Enter Delivery Address"
                placeholder="Your Location"
                hint="Enter your delivery address in full with closest landmark"
            persistent-hint
                color="teal lighten-3"
                ></v-text-field>
                </v-col>
                </v-row>

                <v-card
    class="mx-auto"
    outlined
  >
  <v-card-title class="overline">Add [+] options</v-card-title>
<v-card-text>
            <div class="form-group d-inline-block" v-for="(option,k) in kOptions" :key="k">
               <div v-if="checkOption != false">
                      <v-btn class="my-2 mr-2 lighten-1 white--text caption" 
                      small 
                      :color="optionColor" 
                    :loading="btnloading"
                      rounded
                      :disabled="clicked.includes(k)"
                      @click="addOption(k,option.name,option.price)"
                      >
                        <v-icon small>mdi-plus</v-icon>
                        {{option.name}}
                        <span class="ml-2 pa-2 white--text" :class="priceOption">
₦ {{option.price}}
                        </span>
                      </v-btn>
               </div>
               <div v-else>no options</div>
            </div>
            </v-card-text>
                </v-card>
              

    </div>
         <!-- <p class="caption grey--text text--darken-2 font-weight-light mb-0">
            <span class="font-weight-bold">
            Delivery Details
            </span> 
            </p>-->

            </v-card-text>
           
            </v-form>
           <Callback :paymentStatus="paymentStatus" :dialog2="dialog"></Callback>
            </v-card>
            <v-row justify="center"> 
           <p class="caption text--grey my-5" style="margin: 0 auto">
powered by <img :src="require('../assets/mulaalogo.png')" alt="" style="max-width:70px;margin-left:5px">
           </p>
        
       </v-row>

       <v-bottom-sheet v-model="sheet">
      <v-sheet class="" height="300px" style="border-radius: 20px 20px 0 0" :elevation=5>
 <div class="pa-5 grey--text text--darken-3 font-weight-bold">REVIEW/CONFIRM YOUR ORDER</div>
       <!-- <v-btn
          class="mt-4"
          text
          color="red"
          @click="sheet = !sheet"
        >close</v-btn>-->
<v-list-item three-line>
      <v-list-item-content>
       
        <v-list-item-title class="title mb-0 teal--text text--darken-4">
          <div style="font-size:10px">{{buyerEmail}} // {{buyerPhone}}</div>
          <div class="py-2" style="border-bottom:1px dotted #ccc;line-height:1px;">
          <p class="my-0 " style="font-size:10px"><span class="overline my-0 py-0">Sub-total:</span> {{newAmount | currency}} </p>
          <p class="my-0" style="font-size:10px"><span class="overline my-0 py-0">Delivery:</span> {{this.userDetails.delivery_fee | currency}} </p>
          </div>
          <span class="overline">Total:</span><br> {{this.amount2()/100  | currency}}</v-list-item-title> <!-- newAmount -->
        <v-list-item-subtitle>{{this.title}}
<div v-for="(option,i) in Options" :key="i" class="mt-1">
<v-chip
small
class="my-0 d-inline green lighten-5 font-weight-light ml-n2"
>{{option.name}}
  </v-chip>
</div>
        </v-list-item-subtitle>
       <!-- <v-list-item-subtitle>
          <v-btn
             @click="payWithPaystack"
             color="#23d2aa" 
             class="mt-3"
             :disabled=disabled :loading="loading"
             >
              <v-icon small left>mdi-cash</v-icon>
                Checkout
             </v-btn>
          </v-list-item-subtitle>-->
      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="150"
        color="transparent"
      >
      <!--<v-icon dark>mdi-cart</v-icon> payWithPaystack-->
          
            <v-btn
            @click.stop="payWithMulaa"
            color="green" 
            class="mt-3 white--text"
            tile
            :disabled=disabled :loading="loading"
            >
            <v-icon x-small left>mdi-cash</v-icon>
            Pay Now
            </v-btn>
        
          <!--<MulaaPay></MulaaPay>-->
      </v-list-item-avatar>
    </v-list-item>

      </v-sheet>
    </v-bottom-sheet>
    
    <iframe :src="mySrc" type="" width="1%" 
    height="1%" frameborder="0" style="display:none;z-index:-999">
  </iframe>

<v-dialog
      v-model="mulaapaydialog"
      transition="slide-x-transition" 
      dark 
      persistent 
      max-width="454" 
      class="extra-round extra white--text"
    >
<v-card
        max-width="454"
        class="mx-auto"
            >
            <v-card-title class="teal lighten-2">
                <span class="headline text-center font-weight-light">
                    <!--Pay with Bank  Transfer-->
                    Payment Options
                </span>
            </v-card-title>
            <v-card-text class="pa-5 text-center">
               <!--<p class="headline text-center"> Pay with Paystack </p>-->
              <div style="display:block"
               v-show="!show2"
              > 
                <v-chip
      class="ma-2 text-center"
      x-small
    >
      1. Card Payment
    </v-chip>
    </div>

                
                  <v-btn
             @click="payWithPaystack"
             color="green" 
             class="mt-3 headline mb-5"
             :disabled=disabled :loading="loading"
             v-show="!show2"
             >
Paystack
                   </v-btn>
            </v-card-text>

            <v-divider></v-divider>
 
            <v-card-text class="pa-5 text-center">
              <p class="title">Or</p>
<div style="display:block;" class="mt-2"> 
<v-chip
class="ma-2 text-center"
x-small
>
2. Bank Transfer
</v-chip>
</div>
       <span class="subtitle-2 text-center font-weight-light">
         From your Banking App
       </span>
              <p class="title">
                Payment of <strong>{{totalPrice| currency}}</strong>
                </p>
                <div v-show="!show2">
            <span class="subtitle-2 text-center font-weight-light">
            Select your bank below
            </span>
            <v-select
         v-model="bank"
          :items="bankList"
          item-text="text"
          item-value="value"
          class="px-10"
          filled
          label="Select your bank"
          background-color="#19193d"
         return-object
         single-line
         small
         v-on:change="showAcct"
        ></v-select>
                 <v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> 
                            </div>
                  <div v-show="show2">
                    <p class="subtitle-2">Make an Internet Transfer as payment for your transaction.</p>
                    <h4 class="title green">Account Number: {{craaccount}} <br> Bank Name: Rubies MFB</h4>
                    <p class="text--teal caption mt-1">transaction expires in 12hrs</p>
                    </div>
            </v-card-text>
           
         
             <v-card-actions class="pr-7">
               <v-btn text color="teal lighten-3 overline" @click="mulaapaydialog = false; show2 = false">
              <v-icon right-3 color="teal lighten-3" class="mr-2">mdi-cancel</v-icon>
                Cancel
              </v-btn>

              <v-row
          class="ml-n5"
          justify="end"
        >
          <v-icon small class="mr-1">mdi-lock</v-icon>
          <span class="overline">mulaa.co</span>
        </v-row>
            </v-card-actions>
            </v-card>
</v-dialog>

    </div>
</template>
<script>
//import MulaaPay from '@/components/MulaaPay'
import banks from '@/data/banks.json'

import { Glide, GlideSlide } from 'vue-glide-js'

import { mapState, mapGetters } from 'vuex'
import axios from 'axios'

//import Rave from 'vue-ravepayment';
//import paystack from 'vue-paystack';
import Callback from '@/components/Callback'
const mulaa_key = 'pk_live_d2ea70959fc4383baf5844b947709e17db19b1d0'
export default {
    props: ['name','theproducts'],
     components: {
        //paystack
        Callback: Callback,
        //MulaaPay: MulaaPay,
        [Glide.name]: Glide,
    [GlideSlide.name]: GlideSlide
        // Rave
    },
 data(){
        return {
          paywithbank: null,
          eproductfile: '',
          eproduct: '',
          totalPrice:0,
          delivery_locations: [], //JSON.parse(this.theProduct.delivery_locations)
          delivery_locations_obj: null,
          craaccount: '',
          show2: false,
          bank: null,
          bankcode: null,
          bankList:banks,
          mulaapaydialog: false,
 successimg: `../assets/successful.svg`,//`@/assets/images/successful.svg`,
          productID: '',
          overlay:true,
          checkOption: false,
          optionColor: 'green',
          priceOption: 'black',
          loader: null,
        btnloading: false,
          clicked: [],
            hide:false,
progress: 10,
dialog: false,
pageurl: 'https://shop.mulaa.co'+this.$route.path,
           infoBar: false,
            /*title: this.theProduct.title,
            hidethis: this.theProduct.hidden, 
            datePosted: this.theProduct.date_posted,
            delivery:this.theProduct.delivery_locations,
            description:this.theProduct.description,
            discountPrice:this.theProduct.discount_price,
            image: this.theProduct.image,
            price: this.theProduct.price,
            discounted: this.theProduct.show_discount,*/
            sheet: false,
            title:'',
            title2: '',
            delivery:'',
            description:'',
            discountPrice:'',
            productOptions: '',
            stock:'',
            Options: [
           
            ],
            image: '',
            price: '',
            discounted: '',
            buyerName: '',
            buyerEmail: '',
            buyerPhone: '',
            buyerAddress:'',
            newAmount: null,
            delivery:'',
        infoMsg: '', 
        color: '',
        paymentStatus: [],
       emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ]
        }
    },

    computed: {
      ...mapState({
      registerMsg:'registerMsg',
      loading:'loading',
      userKey:'userKey',
      theProduct:'theProduct',
      userDetails:'userDetails',
      theProductId: 'theProductId',
      //pslides: 'pslides'
      }),
      loading: {
      get() {
        return this.$store.state.loading;
      },
      set(value) {
        this.$store.commit('loading', value);
      }
    },
    pslides: {
      get() {
        return this.$store.state.pslides;
      },
     /* set(value) {
        this.$store.commit('snackbar', value);
      }*/
    },
    reference(){
        let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
 
        for( let i=0; i < 10; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));
 
        return text;
      },
      amount(){
          if(this.discounted == false || this.discounted == undefined){
              let amount = this.price
              /*
 if(this.userDetails.delivery_fee){
               let charge = this.userDetails.delivery_fee// * 100
               let amount2 = parseInt(amount) + parseInt(charge)
               return amount2
              }
             */
              //console.log(this.discounted)
             // console.log('amount: '+ amount)

              return amount
          }else {
              //this.hide = true
              console.log(this.discounted)
              let amount = this.discountPrice
              
              return amount
          }
      },
      
       disabled() {
       if (this.buyerName.length < 1 || this.buyerEmail == ' '){
           this.infoBar = true
           this.infoMsg = 'fill in your details to complete purchase'
           this.color='red'
         return true
       }
       return false
        //return this.imageFile.length < 1; // or === 0   
    },
   kOptions: {
      get: function(){
        if(this.productOptions){
          if(JSON.parse(this.productOptions).length > 1){
            this.checkOption = true
          }
          //console.log(JSON.parse(this.productOptions).length)
          
          return JSON.parse(this.productOptions);
        }
        return  //this.productOptions//JSON.parse(this.productOptions);
      }
    },
    mySrc: {
    get: function() {
      //concat using template literal
      return `https://shop.mulaa.co/api/product/${this.title2}`
    }
  }

    },
     created() {
        this.fetchData()
        this.updateData()
        this.toUrlString(this.title)
/*
        const script = document.createElement('script')
        script.src = 'https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js'
        document.getElementsByTagName('head')[0].appendChild(script)
        */

//console.log(this.theProduct)
    },
    methods: {
      addOption(index,name,price) {
        console.log(name)
        this.loader = 'btnloading'
        //let nprice = parseInt(price)
        this.newAmount = parseInt(this.newAmount) + parseInt(price)
        this.price = parseInt(this.price) + parseInt(price)
this.clicked.push(index)
            this.Options.push({ name: name, price: price });
        },
      toUrlString(productname){
let productName = productname
productName = productName.replace(/\s+/g, '-').toLowerCase();
this.title2 = productName
      },
        salesRecord(response){
            //console.log("sales: "+response)

            const host = window.location.host;
const parts = host.split('.');
//const domain = 'mulaa'
const nname = parts[0]

//axios.post(`//dev.mulaa.africa/admin/wp-json/jwt-auth/v1/token`, {
  axios.post(`https://shop.mulaa.co/api/wp-json/jwt-auth/v1/token`, {
    username: 'system',
    password: 'letmein2020()'
  }
).then(resp => {
           //console.log(resp.data.token)
           const options = {
  headers: {'Authorization': 'Bearer '+resp.data.token}
}
const salesData = {
                title: this.title,
                content: this.theProduct.title,
                fields : {
                 ref_id: response.reference,
            amount: this.newAmount,
            payment_mode: "online",
            fullname: this.buyerName,
            status: response.status,
            message: response.message,
            date: this.date,
            product_id: this.$route.params.id,
            product: this.title,
            customer_email: this.buyerEmail,
            customer_phone: this.buyerPhone,
            location: this.buyerAddress,
            transaction: response.transaction,
            merchant: nname, //this.$route.params.name,
            delivery: this.buyerAddress,
            merchant_email: this.userDetails.email,
            others: this.Options
                },
                 status: "publish"
            }

           //axios.post(`http://dev.mulaa.africa/admin/wp-json/wp/v2/sale`, 
           axios.post(`https://shop.mulaa.co/api/wp-json/wp/v2/sale`,
           salesData, options
).then(resp => {
            //console.log(resp.data)
            this.loading = false
            })
            //resolve(resp)
          })
          .catch(err => {
              console.log(err)
              
          })
        },
        updateData(){
          //console.log(this.theProduct.price)
            if(this.theproducts === undefined){
                //console.log('refreshed')
                //console.log(this.theProduct)
                this.delivery_locations = this.theProduct.delivery_locations
                this.productID = this.theProductId
                this.title = this.theProduct.title
            this.hidethis = this.theProduct.hidden
            this.datePosted = this.theProduct.date_posted
            this.delivery = this.theProduct.delivery_locations
            this.description = this.theProduct.description
            this.discountPrice = this.theProduct.discount_price
            this.image = this.theProduct.image
            this.price = this.theProduct.price
            this.discounted = this.theProduct.show_discount
            this.newAmount = this.amount
            this.stock = this.theProduct.stock
            this.productOptions = this.theProduct.product_options
            this.eproduct = this.theProduct.eproduct
            this.eproductfile = this.theProduct.eproductfile
            //console.log(this.theProduct.productOptions)
             //console.log('refreshed amount '+this.newAmount) 
            }else{
                //console.log('valid click')
                //console.log(this.theproducts)
                //this.delivery_locations = JSON.parse(this.theproducts.delivery_locations)
                this.delivery_locations = this.theproducts.delivery_locations
                this.productID = this.theproducts.productID
                this.title = this.theproducts.title
            this.hidethis = this.theproducts.hidden
            this.datePosted = this.theproducts.date_posted
            this.delivery = this.theproducts.delivery_locations
            this.description = this.theproducts.description//this.theProduct.description
            this.discountPrice = this.theproducts.discount_price
            this.image = this.theproducts.image
            this.price = this.theproducts.price
            this.discounted = this.theproducts.show_discount
            this.productOptions = this.theproducts.productOptions
            this.newAmount = this.amount
            this.stock = this.theproducts.stock
            this.eproduct = this.theproducts.eproduct
            this.eproductfile = this.theproducts.eproductfile
            //console.log(this.newAmount)
            }
        },
        /*amount2(){
          if(this.discounted == true){
              let amount = this.discountPrice //* 100
              if(this.userDetails.delivery_fee){
               let charge = this.userDetails.delivery_fee// * 100
               let amount2 = parseInt(amount) + parseInt(charge)
               
               this.totalPrice = amount2
               console.log('full price: '+amount2+" delivery: "+charge+" total "+this.totalPrice)
               return amount2 * 100
              }
              console.log('discount price: '+ amount)
              return amount * 100
          }else {
              let amount = this.price //* 100
              if(this.userDetails.delivery_fee){
               let charge = this.userDetails.delivery_fee// * 100
               let amount2 = parseInt(amount) + parseInt(charge)
               
                this.totalPrice = amount2
                console.log('full price: '+amount2+" delivery: "+charge+" total "+this.totalPrice)
               return amount2 * 100
              }
              console.log('full price: '+this.price+" delivery: "+charge)
              return amount * 100
          } */
          amount2(){
          if(this.discounted == true){
              let amount = this.discountPrice //* 100
              if(this.userDetails.delivery_fee){
               let charge = this.userDetails.delivery_fee// * 100
               let amount2 = parseInt(amount) + parseInt(charge)
               
               this.totalPrice = amount2
              // console.log('full price: '+amount2+" delivery: "+charge+" total "+this.totalPrice)
               return amount2 * 100
              }
              //console.log('discount price: '+ amount)
              return amount * 100
          }else {
              let amount = this.price //* 100
              if(this.userDetails.delivery_fee){
               let charge = this.userDetails.delivery_fee// * 100
               let amount2 = parseInt(amount) + parseInt(charge)
               
                this.totalPrice = amount2
                //console.log('full price: '+amount2+" delivery: "+charge+" total "+this.totalPrice)
               return amount2 * 100
              }
             // console.log('full price: '+this.price+" delivery: "+charge)
              return amount * 100
          }
      },
      
     /* pushDelivery(){
        console.log(this.theProduct.delivery_locations)
        if(!this.theProduct.delivery_locations){
          return null
        }else{
return JSON.parse(this.theProduct.delivery_locations)
        }
      }, */
      resetForm () {
        this.$refs.buyForm.reset()
      },
    reset(file, name) {
      console.log("File --> ", file);
      console.log("FileName -->", name);
    },
    fileChange(file, name) {
      console.log("File --> ", file);
      console.log("FileName -->", name);
    },
    onErr(err, file) {
      console.log("​onErr -> file", file);
      console.log("​onErr -> err", err);
    },
     onSuc(res, file) {
      console.log("​onSuc -> file", file);
      console.log("​onSuc -> res", res);
      this.imgUrl = res.url
      this.uploadMsg = res.message
      
    },
    exceedHandler(file) {
      console.warn("onExceed -> file", file);
    },
    fetchData(){
        this.$store.dispatch('loadProduct', this.$route.params.id)
        this.$store.dispatch('loadUserDetails', this.name)
        //console.log("product id: "+this.$route.params.id)
    },
  callback: function(response){
       // console.log(response)
       
       this.paymentStatus = response
       this.salesRecord(response)
            var oLuanchBtn = document.getElementById('popupBtn');
            oLuanchBtn.style.visibility = 'hidden';
            oLuanchBtn.click();
            //this.resetForm()
            
            console.log('payment: '+this.paymentStatus.reference)
      },
      close: function(){
          console.log("Payment closed")
      },
      showAcct(){
        //this.show2 = true
        const payOptions = {
                    key: this.reference,
                    email: this.buyerEmail,
                    productID: this.productID,
                    phone: this.buyerPhone,
                    address: this.buyerAddress
                }

          this.loading = true
          axios.get('https://shop.mulaa.co/api/wp-json/mulaapay/v1/tranx', {
            params: payOptions
            })
            .then(response => {
              this.show2 = true
              this.loading = false
              this.craaccount = response.data
              const msg = ""
            //console.log(response);
            })
          .catch(error => {
          console.log(error);
          });
      },
      payWithMulaa(){
        //this.sheet = false
        this.loading = false
        console.log('check pay option', this.paywithbank) //this.userDetails.bank_payment_option
        if(this.paywithbank != true){
          this.payWithPaystack()
          console.log(this.userDetails.bank_payment_option)
        }else{
          this.mulaapaydialog = true
         console.log('mulaapay') 
        }
        


        //console.log(this.mulaapaydialog)
        
                
                //this.$emit('payOptions', payOptions);
/*
          axios.get('http://dev.mulaa.africa/admin/wp-json/mulaapay/v1', {
            params: payOptions
            })
            .then(function (response) {
            console.log(response);
            })
          .catch(function (error) {
          console.log(error);
          });
*/
      },
      payWithPaystack() {
        if(this.userDetails.subaccount_code !='' || this.userDetails.subaccount_code !=null)
        {
          console.log(Number(this.amount2()))
          //
          const paystackOptions = {
                    key: mulaa_key,
                    email: this.buyerEmail,
                    amount: Number(this.amount2()),
                    subaccount: this.userDetails.subaccount_code,
                    transaction_charge: 0,
                    bearer: 'subaccount',
                     metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            },
            {
                display_name: "Full Name",
                variable_name: "full_name",
                value: this.buyerName
            },
            {
                display_name: "Delivery",
                variable_name: "delivery",
                value: this.buyerAddress
            },
            {
                display_name: "Merchant",
                variable_name: "merchant",
                value: this.userDetails.business_name
            }
         ]
      },
                    ref: this.reference,
                    callback: (response) => { //message: "Approved" reference: "rVZKHQSn6b" status: "success" trans: "256223954" transaction: "256223954" trxref: "rVZKHQSn6b"
                        this.callback(response)
                        this.showPopup(response)
                    },
                    onClose: () => {
                        this.close()
                        this.$router.go(-1)
                    }
                }
            //console.log(paystackOptions)
          const handler = window.PaystackPop.setup(paystackOptions)
          handler.openIframe()
          //
        }else{
 const paystackOptions = {
                    key: this.userDetails.payment_key,
                    email: this.buyerEmail,
                    amount: Number(this.amount2()),
                    ref: this.reference,
                    callback: (response) => { //message: "Approved" reference: "rVZKHQSn6b" status: "success" trans: "256223954" transaction: "256223954" trxref: "rVZKHQSn6b"
                        this.callback(response)
                        this.showPopup(response)
                    },
                    onClose: () => {
                        this.close()
                        this.$router.go(-1)
                    }
                }
            //console.log(paystackOptions)
          const handler = window.PaystackPop.setup(paystackOptions)
          handler.openIframe()
        }
         
      }
  },
  mounted() {
     console.log('payment mode ',this.userDetails.bank_payment_option)
     this.paywithbank = this.userDetails.bank_payment_option
this.loading = false
    let paystackScript = document.createElement('script')
    paystackScript.setAttribute('src', 'https://js.paystack.co/v1/inline.js')
    document.head.appendChild(paystackScript)
    //console.log(this.pslides)
//let phpUrl = document.createElement('iframe')
//phpUrl.setAttribute('src', 'https://shop.mulaa.co/api/product/the-uju-set')
//document.body.appendChild(phpUrl)

    var oLuanchBtn = document.getElementById('popupBtn');
            oLuanchBtn.style.display = 'none';
         // this.showPopup()   
          //console.log('userdetails: '+JSON.stringify(this.userDetails))  
          //this.amount2()
  },
  watch: {
      loader () {
        const l = this.loader
        this[l] = !this[l]

        setTimeout(() => (this[l] = false), 3000)

        this.loader = null
      },
      pslides(){
        //console.log('length',this.pslides.length)
        //this.$refs.slider.glide.go(">");
      },
      delivery_locations(val){
        console.log('location value ',val)
        if(this.delivery_locations == ''){
        return
      }else{
console.log('not null', val)
        return this.delivery_locations_obj = JSON.parse(this.delivery_locations)
      }
      return
      },
     
    }
}
</script>
<style scoped>
   .theme--dark.v-card{
        background-color:#000028;
    }
    .theme--dark .card__title{

    }
    .cursor{
      cursor: move
    }
</style>
<style>
    .hide{
        display:none!important;
    }
    .otto {
 text-shadow: 0px 1px 1px rgba(0,0,0, 0.4); 
}
</style>