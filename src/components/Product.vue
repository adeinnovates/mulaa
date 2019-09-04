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
  <v-btn text overline color="white" @click="infobar = false">close</v-btn>
</v-snackbar>
<v-row align="center" justify="center">
                    <v-img
                    :src="image"
                    lazy-src="https://picsum.photos/id/11/10/6"
                    aspect-ratio="1"
                    class="grey lighten-2 mb-3"
                    max-width="500"
                    max-height="300"
                    ></v-img>
</v-row>

               <!-- <v-card-title>-->
                    <span class="headline grey--text text--darken-2 mb-1 px-4 font-weight-light pl-8">
                    {{this.title}}
                    </span>
              <!--  </v-card-title>-->
            

            <v-card-text class="py-0"> 
            <div class="px-4">
            <v-row>
            <v-col
            class=col-12
            >
            <p class="caption grey--text text--darken-2 font-weight-light mb-0">
            <span class="font-weight-bold">
            Product Details
            </span> <br>
            {{description}}
            </p>
            </v-col>
            </v-row>  

            <!--
            <v-divider class="mt-1 mb-0"></v-divider>
            <v-row
            class="my-1"
            align="center"
            >
            <strong class="mx-3 font-weight-light teal--text">
            Complete your order
            </strong>

            <v-divider vertical></v-divider>

            <div class="flex-grow-1"></div>

            <v-progress-circular
            :value="progress"
            class="mr-2"
            ></v-progress-circular>
            </v-row>

            <v-divider class="mb-1"></v-divider>
            -->
            </div>
            </v-card-text>

  <v-card-actions class="px-5 text--darken-1 teal--text">
       <v-badge color="green" v-if="this.discounted">
      <template v-slot:badge>
        <span 
        class="caption" 
        >discount</span> <!-- <v-icon dark>mdi-check</v-icon> -->
      </template>
      <span class="headline font-weight-light mb-0 teal--text pl-3">₦{{newAmount}}</span>
    </v-badge>
    <p v-else class="headline font-weight-light mb-0 teal--text pl-3">
       ₦{{newAmount}}
        </p>
             <v-btn
             text
             @click="payWithPaystack"
             color="#23d2aa" 
             class=""
             :disabled=disabled :loading="loading"
             >
              <v-icon small left>mdi-cash</v-icon>
                pay now
             </v-btn>
             
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

    </div>
          <p class="caption grey--text text--darken-2 font-weight-light mb-0">
            <span class="font-weight-bold">
            Delivery Details
            </span> 
            </p>

            </v-card-text>
           
            </v-form>
           <Callback :paymentStatus="paymentStatus" :dialog2="dialog"></Callback>
            </v-card>
            <v-row justify="center"> 
           <p class="caption text--grey my-5" style="margin: 0 auto">
powered by <img :src="require('../assets/mulaalogo.png')" alt="" style="max-width:70px;margin-left:5px">
           </p>
        
       </v-row>
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
            title:'',
            delivery:'',
            description:'',
            discountPrice:'',
            image: '',
            price: '',
            discounted: '',
            buyerName: '',
            buyerEmail: '',
            buyerPhone: '',
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
      theProduct:'theProduct'
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
          if(this.discounted == false){
              let amount = this.price
              console.log(this.discounted)
              console.log('amount: '+ amount)

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
    },
     created() {
        this.fetchData()
        console.log('user: '+ this.name)
    },
    methods: {
        salesRecord(response){
            //console.log("sales: "+response)

axios.post(`//dev.mulaa.africa/admin/wp-json/jwt-auth/v1/token`, {
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

           axios.post(`http://dev.mulaa.africa/admin/wp-json/wp/v2/sale`, 
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
            }else{
                console.log('valid click')
                this.title = this.theproducts.title.rendered
            this.hidethis = this.theproducts.acf.hidden
            this.datePosted = this.theproducts.acf.date_posted
            this.delivery = this.theproducts.acf.description
            this.description = this.theProduct.description
            this.discountPrice = this.theproducts.acf.discount_price
            this.image = this.theproducts.acf.image
            this.price = this.theproducts.acf.price
            this.discounted = this.theproducts.acf.show_discount
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
                    key: this.userKey,
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
    this.updateData()

    var oLuanchBtn = document.getElementById('popupBtn');
            oLuanchBtn.style.display = 'none';
         // this.showPopup()     
  }
}
</script>
<style>
    .hide{
        display:none!important;
    }
</style>