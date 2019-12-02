<template>
    <div class="dashboard fill-height teal lighten-5 page pa-10 mt-10">

<v-card
style="border-top-left-radius:15px;border-top-right-radius:15px;"
class="my-5"
outlined
>
<v-card-title>
      <span class="grey--text overline">
          Transaction <strong>{{infoMsg}}</strong>
      </span>
    </v-card-title>
<v-card-text>
    <v-sheet 
    v-show="paySuccess"
    class="pa-5"
    color="orange lighten-5"
    style="border:3px dotted rgba(178, 223, 219, 0.3);
    border-radius:4px;"
    >
    <p class="headline">Payment Successful</p>
    <p class="title grey--text">
    Mulaa Subscription to <span class="blue--text">{{planName}}</span>, is now active. 
    </p>

    <div class="text--primary">
    Return to settings page
    </div>

    </v-sheet>
     <v-sheet 
    v-show="payError"
    class="pa-5"
    color="red lighten-5"
    style="border:3px dotted rgba(178, 223, 219, 0.3);
    border-radius:4px;"
    >
    <p class="headline">Payment Unsuccessful</p>
    <p class="title red--text">
        Transaction Response: {{ErrorMsg}}
    </p>

    <div class="text--primary">
    Return to settings page
    </div>

    </v-sheet>
</v-card-text>
<div class="my-2">
            <v-btn x-large block color="success" dark @click="goToSettings()" class="my-3">
                Return to settings
                </v-btn>
          </div>
</v-card>
        <v-overlay :value="subOverlay">
            <p class="overline">confiming...</p>
      <v-progress-circular indeterminate size="84"></v-progress-circular>
    </v-overlay>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'

import axios from 'axios'
export default {
     data() {
    return {
        subOverlay:false,
        infoMsg: '', 
        infoBar: false,
        checkStatus:false,
        checkURL: false,
        planName:'',
        paySuccess:false,
        payError:false,
        ErrorMsg:'',
        skk: process.env.VUE_APP_SECRET_KEY,

    }
     },
     created() {
        return this.chkUrlData()
    },
     methods: {
         goToSettings(){
             this.$router.push('/settings')
         },
chkUrlData(){
    if(this.$route.query.trxref != undefined){
        //console.log(this.$route.query.trxref)
        this.subOverlay = true
        let tranx = this.$route.query.trxref
        this.infoMsg = this.$route.query.trxref
        //let skey = 'sk_live_01952d79b3b14815af91d560256959358299e123'
        const config = {
        headers: {'Authorization': 'Bearer '+this.skk}
        }
        axios.get('https://api.paystack.co/transaction/verify/'+tranx, config)
        .then(resp => { 
            const trxData = resp.data.data
           // const socialData = resp.data.socialCount
            //console.log(resp.data.data)
            if(trxData.status == 'success'){
                this.paySuccess = true
            let amount = trxData.plan_object.amount/100
            let plan = trxData.plan_object.name
            this.planName = trxData.plan_object.name
            /*let plan_interval = tranx.plan_object.interval*/
            let paidDate = trxData.paid_at
            let cust_email = trxData.customer.email
            let authorization = trxData.authorization.authorization_code
            //console.log('data: '+amount+' / '+plan+' / '+cust_email+' / '+this.user)
            let ts = new Date();
            let nts = ts.toDateString()
//console.log(ts.toDateString());
                    this.$http.post('/subscription',
                    {
                    title: this.user, //+'_'+trxData.reference,
                    fields : {
                        date_created: nts,
                    trans_ref: resp.data.data.reference,
                    amount: amount,
                    /*duration: plan_interval,*/
                    plan_name: plan,
                    authorization_code: authorization,
                    user: this.user,
                    },
                    status: "publish"
                    }
                    ).then(response => {
                        return this.$http.post('/users/'+this.userId, {
                title: '',
                content: '',
                fields : {
                    subscription: plan,
                    subscription_package: plan,
                    payment_date: nts,
                    username: this.user,
                    payment_ref: trxData.reference,
                    paid_user: true
                },
                 status: "publish"
            }).then(response2 => {
                    this.subOverlay = false
            })
                    /*console.log('sub post: '+JSON.stringify(response.data))
                    this.subOverlay = false
                    */
                    })
                    
           // console.log('this trnx was successful')
            }else{
                this.payError = true
                this.ErrorMsg = trxData.status
                this.subOverlay = false
                //console.log(this.skk)
                //console.log('trnx abandonned')
            }
           
            
          })
          .catch(err => {
            //const linkData = 0
            console.log(err)
            //reject(err)
          })
            
    //return this.confirmPayment()
    }else{
        console.log('empty string')
    }
    
},
confirmPayment(id){
//axios.get('http://localhost:8000/api/v1/f/', config)
}
     },
     watch: {
      planName () {
          //console.log(this.planName)
          return this.planName
      },
      ErrorMsg (){
          return this.ErrorMsg
      }
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
      userId:'userId',
      allProducts: 'allProducts',
      myproducts:'myproducts',
      userPhone: 'userPhone',
       userDetails: 'userDetails',
       userAcctStatus: 'userAcctStatus'
      }),
    snackbar: {
      get() {
        return this.$store.state.snackbar;
      },
      set(value) {
        this.$store.commit('snackbar', value);
      }
    }
     }
}
</script>