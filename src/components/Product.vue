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
           
 <v-snackbar v-model=infoBar bottom right :color="color" :value=infoMsg>
  <span>{{infoMsg}}</span>
  <v-btn text overline color="white" @click="infoBar = false">close</v-btn>
</v-snackbar>
<v-row align="center" justify="center">
                    <v-img
                    :src="image"
                    lazy-src="https://picsum.photos/id/11/10/6"
                    aspect-ratio="1"
                    class="grey lighten-2 mb-3"
                    max-width="500"
                    max-height="300"
                    >
                    
<v-row class="fill-height d-flex wrap justify-space-between" style="flex-direction: column;height:100%">
<v-card-title class="ml-5">

             <social-sharing :url=pageurl
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
                </social-sharing>
</v-card-title>
<v-card-text class="white--text ml-5">
<div class="headline font-weight-light pt-12 otto">{{this.title}}</div>
</v-card-text>
</v-row>

                    </v-img>
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
            </div>
            </v-card-text>

  <v-card-actions class="px-5 text--darken-1 teal--text">
       <v-badge color="green" v-if="this.discounted">
      <template v-slot:badge>
        <span 
        class="px-2" 
        style="font-size:10px"
        >discount</span> <!-- <v-icon dark>mdi-check</v-icon> -->
      </template>
      <span class="headline font-weight-light mb-0 teal--text">{{newAmount | currency}}</span>
    </v-badge>
    <p v-else class="headline font-weight-light mb-0 teal--text pl-3">
       {{newAmount | currency}}
        </p>
             <v-btn
             text
             @click="payWithPaystack"
             color="#23d2aa" 
             class="ml-10"
             :disabled=disabled :loading="loading"
             >
              <v-icon small left>mdi-cash</v-icon>
                pay now
             </v-btn>
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
        
       <!--   <paystack
        :amount="amount"
        :email="buyerEmail"
        :paystackkey="userKey"
        :reference="reference"
        :callback="callback"
        :close="close"
        :embed="false"
    >
       <i class="fas fa-money-bill-alt"></i>
       Make Payment
    </paystack>-->

<v-row>
                <v-col>
                <v-text-field
                class="teal--text form-field ma-0 pa-0"
                v-model="buyerAddress"
                label="Delivery Address"
                placeholder="Your Location"
                color="teal lighten-3"
                ></v-text-field>
                </v-col>
                </v-row>

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
      <v-sheet class="text-center" height="200px">
        <v-progress-linear
          :value="50"
          class="my-0"
          height="3"
        ></v-progress-linear>

        <v-btn
          class="mt-4"
          text
          color="red"
          @click="sheet = !sheet"
        >close</v-btn>
<v-list-item three-line>
      <v-list-item-content>
        <v-list-item-title>Quick Buy</v-list-item-title>
        <v-list-item-subtitle>
          Get this in addition to your purchase
        </v-list-item-subtitle>
        <v-list-item-subtitle>
          consectetur adipiscing elit.
        </v-list-item-subtitle>
      </v-list-item-content>
          </v-list-item>
        <div class="py-3">This is a bottom sheet using the controlled by v-model instead of activator</div>
      </v-sheet>
    </v-bottom-sheet>
    
    <iframe :src="mySrc" type="" width="1%" 
    height="1%" frameborder="0" style="display:none;z-index:-999">
  </iframe>

    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'
//import paystack from 'vue-paystack';
import Callback from '@/components/Callback'

export default {
    props: ['name','theproducts'],
     components: {
        //paystack
        Callback
    },
 data(){
        return {
          
            hide:false,
progress: 10,
dialog: false,
pageurl: 'https://shop.mulaa.co/'+this.$route.path,
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
            image: '',
            price: '',
            discounted: '',
            buyerName: '',
            buyerEmail: '',
            buyerPhone: '',
            buyerAddress:'',
            newAmount: null,
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
      userDetails:'userDetails'
      }),
      loading: {
      get() {
        return this.$store.state.loading;
      },
      set(value) {
        this.$store.commit('loading', value);
      }
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
//console.log(this.userKey)
    },
    methods: {
      toUrlString(productname){
let productName = productname
productName = productName.replace(/\s+/g, '-').toLowerCase();
this.title2 = productName
      },
        salesRecord(response){
            //console.log("sales: "+response)

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
            location: "",
            transaction: response.transaction,
            merchant: this.$route.params.name
                },
                 status: "publish"
            }

           //axios.post(`http://dev.mulaa.africa/admin/wp-json/wp/v2/sale`, 
           axios.post(`https://shop.mulaa.co/api/wp-json/wp/v2/sale`,
           salesData, options
).then(resp => {
            console.log(resp.data)
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
                console.log('refreshed')
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
             //console.log('refreshed amount '+this.newAmount) 
            }else{
                console.log('valid click')
                this.title = this.theproducts.title
            this.hidethis = this.theproducts.hidden
            this.datePosted = this.theproducts.date_posted
            this.delivery = this.theproducts.description
            this.description = this.theProduct.description
            this.discountPrice = this.theproducts.discount_price
            this.image = this.theproducts.image
            this.price = this.theproducts.price
            this.discounted = this.theproducts.show_discount
            this.newAmount = this.amount
            console.log(this.newAmount)
            }
        },
        amount2(){
          if(this.discounted == true){
              let amount = this.discountPrice * 100
              
              console.log('discount price: '+ amount)
              return amount
          }else {
              let amount = this.price * 100
              console.log('full price: '+this.price)
              return amount
          }
      },
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
      payWithPaystack() {
          const paystackOptions = {
                    key: this.userDetails.payment_key,
                    email: this.buyerEmail,
                    amount: Number(this.amount2()),
                    ref: this.reference,
                    callback: (response) => { //message: "Approved" reference: "rVZKHQSn6b" status: "success" trans: "256223954" transaction: "256223954" trxref: "rVZKHQSn6b"
                        this.callback(response)
                        //this.showPopup(response)
                    },
                    onClose: () => {
                        this.close()
                    }
                }
            //console.log(paystackOptions)
          const handler = window.PaystackPop.setup(paystackOptions)
          handler.openIframe()
      }
  },
  mounted() {
this.loading = false
    let paystackScript = document.createElement('script')
    paystackScript.setAttribute('src', 'https://js.paystack.co/v1/inline.js')
    document.head.appendChild(paystackScript)

//let phpUrl = document.createElement('iframe')
//phpUrl.setAttribute('src', 'https://shop.mulaa.co/api/product/the-uju-set')
//document.body.appendChild(phpUrl)

    var oLuanchBtn = document.getElementById('popupBtn');
            oLuanchBtn.style.display = 'none';
         // this.showPopup()   
          //console.log('userdetails: '+JSON.stringify(this.userDetails))  
  }
}
</script>
<style>
    .hide{
        display:none!important;
    }
    .otto {
 text-shadow: 0px 1px 1px rgba(0,0,0, 0.4); 
}
</style>