<template>
    <div class="mt-5 pa-3 page">
       <!-- <v-alert type="info" dark class="mx-5 teal lighten-4 teal--text">
      Complete your busienss details below to activate your store and begin selling
    </v-alert>-->
 <v-layout row wrap align-center="align-center" justify-center="justify-center" class="pa-4 mt-5">
    <v-sheet 
        class="pa-5"
        v-show="!banked"
        color="blue lighten-5"
        style="border:3px dotted rgba(178, 223, 219, 0.3);
                          border-radius:4px;"
        >
     
      <div class="blue--text">
        Your onboarding is complete, please go to settings to edit your mulaa details or choose a subscription.
        <p class="mt-2">To update Banking info, please reachout to team@mulaa.co
          </p>
      </div>
       
        </v-sheet>
   
    <v-form 
      ref="oform"
      v-model="valid"
      color=transparent
      v-show="banked"
      >
<v-img :src="require('../assets/winner.svg')"
width="350"
></v-img>

<v-stepper v-model="e1" style="max-width:454px" class="mx-3">
    <v-stepper-header>
      <v-stepper-step :complete="e1 > 1" step="1" color="#000028">Business Info</v-stepper-step>

      <v-divider></v-divider>

      <v-stepper-step :complete="e1 > 2" step="2" color="#000028">Conversion Info</v-stepper-step>

       <v-divider></v-divider>

      <v-stepper-step :complete="e1 > 3" step="3" color="#000028">Brand</v-stepper-step>

    </v-stepper-header>
<v-stepper-items>
 <v-stepper-content step="1" class="pa-0">
        <v-card
        max-width="454"
        class="mx-auto"
        outlined
        
        >
        <v-list-item two-line>
        <v-list-item-content>
        <v-list-item-title class="headline mb-2 teal--text">Business Details</v-list-item-title>
        <v-list-item-subtitle>Update your basic business details.</v-list-item-subtitle>
        </v-list-item-content>
        </v-list-item>
        <v-divider class="mx-4"></v-divider>

        <v-card-text>
          {{userDetail}}
        <v-container>

<v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
        > 
        <v-text-field
        filled
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="referral"
    
        placeholder="Who referred you"
        prepend-inner-icon="mdi-account-outline"
        class="teal--text form-field mb-0"
        ></v-text-field>
        </v-col>
        </v-row>

        <v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
        > 
        <v-text-field
        filled
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="businessName"
    :rules="[nurules.required]"
        placeholder="Your Business Name"
        prepend-inner-icon="mdi-account-card-details-outline"
        class="teal--text form-field mb-0"
        ></v-text-field>
        </v-col>
        </v-row>
         <v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
        > 
        <v-text-field
        filled
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="businessDesc"
    :rules="[nurules.required]"
        placeholder="Business Description"
        prepend-inner-icon="mdi-domain"
        class="teal--text form-field mb-0"
        ></v-text-field>
        </v-col>
        </v-row>

        <v-row class="mb-0 pb-0">
        <v-col
        cols="6"
        sm="6"
        class="mb-0 pb-0"
        > 
        <v-text-field
       filled
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="Instagram"
        
        placeholder="handle"
        class="teal--text form-field"
        prepend-inner-icon="mdi-instagram"
        ></v-text-field>
        </v-col>

        <v-col
        cols="6"
        sm="6"
        class="mb-0 pb-0"
        > 
        <v-text-field
        filled
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="phoneNumber"
        :rules="[nurules.required, nurules.min]"
        type="number"
        class="teal--text form-field"
        placeholder="080 000 00000"
        prepend-inner-icon="mdi-cellphone"
        ></v-text-field>
        </v-col>

        </v-row>

        </v-container>
        </v-card-text>

        <v-card-actions>
       <v-btn
          @click="e1 = 2"
          rounded 
      large 
      class="px-5 mb-5 ml-5 text teal--text" 
      color="#23d2aa" 
      :disabled= "disabled"
        >
          Continue
        </v-btn>
        </v-card-actions>
        </v-card>
 </v-stepper-content>

<v-stepper-content step="2" class="pa-0">
        <v-card
        max-width="454"
        class="mx-auto"
        outlined
        :loading="loading"
        >
        <v-list-item two-line>
        <v-list-item-content>
        <v-list-item-title class="headline mb-2 teal--text">Sales Details</v-list-item-title>
        <v-list-item-subtitle>Please enter a few personal details</v-list-item-subtitle>
        </v-list-item-content>
        </v-list-item>
        <v-divider class="mx-4"></v-divider>

        <v-card-text>
        <v-container>
<div v-if="!show2 ">

        <v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
        > 
        <span class="overline mb-2">
          Got Paystack?
        </span>
        <p class="mb-2">
  Let us know where to send your customer payments, all details must be valid to allow your customers pay you. 
</p>
        
        
        <v-text-field
        filled
        hint="copy public key from your Paystack dashboard"
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="paystackKey"
    
        placeholder="Paystack Public Key"
        prepend-inner-icon="mdi-cash"
        class="teal--text form-field mb-0"
        ></v-text-field>
      <p class="caption red--text text-capitalize">
   No Paystack Key?
   <span @click="show2 = true" style="cursor: pointer;text-decoration:underline">click here to enter bank details</span>
   </p>
        </v-col>
        </v-row>
        
 <v-divider class="my-4"></v-divider>
 
 </div>

 <div v-else>
   <!--
    <p class="caption red--text text-capitalize">
   Already have a Paystack account? 
   <span @click="show2 = false" style="cursor: pointer;text-decoration:underline">click here to use Paystack key</span>
   </p>
   -->
  <span class="overline teal--text">
          Setup Bank Details
        </span>
        <p>Kindly provide banking details for settlement purposes and connect your mulaa account to a payment gateway</p>
        <v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
        > 
        <v-select
         v-model="bank"
          :items="bankList"
          item-text="text"
          item-value="value"
          filled
          label="Select your bank"
          background-color="#f4f8f7"
         return-object
         single-line
        ></v-select>

        </v-col>
        </v-row>

        <v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
        > 
       <v-text-field
        filled
        hint="Bank account number"
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="bankaccountNumb"
    :rules="[nurules.required, nurules.min, nurules.numbs]"
    :error-messages="errors"
        placeholder="Enter your bank account number"
        prepend-inner-icon="mdi-cash"
        class="teal--text form-field mb-0"
        type="number"
        :disabled="disabledField"
        ></v-text-field>

        </v-col>
        </v-row>

  <v-row class="mb-0 pb-0">
        <v-col
        
        class="mb-0 pb-0"
        > 
       <v-text-field
        filled
        hint="Full name"
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="fname"
    :disabled="true"
        placeholder="Full Name"
        prepend-inner-icon="mdi-user-outline"
        class="teal--text form-field mb-0"
        ></v-text-field>
</v-col>
        </v-row>
</div>
        <v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
        > 
        <v-text-field
        filled
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="BusinessAddress"
        placeholder="Registered Business Address"
        prepend-inner-icon="mdi-map-marker"
        class="teal--text form-field mb-0"
        ></v-text-field>
        </v-col>
        </v-row>


        <v-row class="mb-0 pb-0">
        <v-col
        cols="6"
        sm="6"
        class="mb-0 pb-0"
        > 
        
        <v-select
        prepend-inner-icon="mdi-crosshairs-gps"
          :items="statelist"
          filled
          label="State"
          v-model="stateResidence"
          background-color="#f4f8f7"
        color="teal lighten-3"
        ></v-select>
        </v-col>

        <v-col
        cols="6"
        sm="6"
        class="mb-0 pb-0"
        > 
        <v-select
          :items="Country"
          filled
          label="Country"
          background-color="#f4f8f7"
        color="teal lighten-3"
        ></v-select>
        </v-col>

        </v-row>


        </v-container>
        </v-card-text>

        <v-card-actions>
            <v-btn
          @click="e1 = 1"
          rounded 
      large 
      class="px-5 mb-5 ml-5 text teal--text" 
      color="#000028" 
        >
          Back
        </v-btn>

       <v-btn
          @click="e1 = 3"
          rounded 
      large 
      class="px-5 mb-5 text teal--text mr-3" 
      color="#23d2aa" 
      :loading="loading"
      :disabled="disabledbtn"
        >
          Continue
        </v-btn>
        
        </v-card-actions>
        </v-card>
 </v-stepper-content>

 <v-stepper-content step="3" class="pa-0">
        <v-card
        max-width="454"
        class="mx-auto"
        outlined
        
        >
        <v-list-item two-line>
        <v-list-item-content>
        <v-list-item-title class="headline mb-2 teal--text">Brand Details</v-list-item-title>
        <v-list-item-subtitle>Upload your profile photo or business logo</v-list-item-subtitle>
        </v-list-item-content>
        </v-list-item>
        <v-divider class="mx-4"></v-divider>


        <v-card-text>
        <v-container>

        <v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
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
    <v-avatar color="#23d2aa" @click="$refs.imageinput.click()" width="100" height="100">
      <img v-if="userProfile.profileImg !=null || undefined" :src="userProfile.profileImg" alt="avatar">
      <v-icon v-else dark>mdi-camera</v-icon>
    </v-avatar>
   <span class="d-block overline mt-3">Profile Image/Logo</span>
  </div>
        </v-col>
        </v-row>
 <v-divider class="my-4"></v-divider>
          <v-row class="mb-0 pb-0">
        <v-col
        cols="12"
        sm="12"
        class="mb-0 pb-0"
        > 
        <span class="overline">
          add conversion pixel
        </span>
        <p>
          With your Facebook Pixel build targeted audiences for future ads, and remarket to people who have already visited and not ordered
        </p>
        <v-text-field
        filled
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="facebookPixel"
        placeholder="Facebook Pixel"
        prepend-inner-icon="mdi-facebook"
        class="teal--text form-field mb-0"
        :disabled="true"
        hint="coming soon"
        ></v-text-field>
        </v-col>
        </v-row>

        </v-container>
        </v-card-text>

        <v-card-actions>
            <v-btn
          @click="e1 = 2"
          rounded 
      large 
      class="px-5 mb-5 text teal--text" 
      color="#000028" 
        >
          Back
        </v-btn>
<!-- submit button-->
       <v-btn
          @click="createSubaccount()" 
          rounded 
      large 
      class="px-5 mb-5 text teal--text mr-3" 
      color="#23d2aa" 
       :loading="loading"
        >
          Submit
        </v-btn>
        
        </v-card-actions>
        </v-card>
 </v-stepper-content>

</v-stepper-items>

</v-stepper>
  </v-form>
 </v-layout>
 
    </div>
</template>
<script>
import store from '@/store' 
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'
import banks from '@/data/banks.json'
import liststates from '@/data/liststates.json'
import countapi from 'countapi-js';

const PaystackOptions = {
  headers: {'Authorization': 'Bearer sk_live_01952d79b3b14815af91d560256959358299e123'}
}

export default {
    created(){
      this.fetchUserData()
      //this.listOfBanks()
      if(this.$store.getters.isLoggedIn=== true){
       // this.$router.push('/') //this.$store.getters.isLoggedIn
      }
      console.log('email: '+this.user)
      
    },
    mounted() {
  this.dateFunction;
  this.confirmUpdate();
  let chatScript = document.createElement('script')
    chatScript.setAttribute('src', '//code.tidio.co/dh6fwddvbrzinw01vijt0tzc0334bi1d.js')
    chatScript.setAttribute('async', 'true')
    document.head.appendChild(chatScript)
  },
    computed: {
      ...mapState({
      registerMsg:'registerMsg',
      show:'show',
      loading:'loading',
      user:'user',
      userId:'userId',
      userEmail:'userEmail',
      userDetails:'userDetails'
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
    accountEmail:{
      get(){
        return this.$store.state.userEmail;
      },
      set(value){
        this.$store.commit('userEmail', value);
      }
    },
    dateFunction() {
   
            var currentDate = new Date();
           // console.log(currentDate);
  
            var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
            //console.log(currentDateWithFormat);
            this.entryDate = currentDateWithFormat
            return currentDateWithFormat
     
        },
         disabled() {
       if (this.businessName.length < 5 || this.phoneNumber.length < 10){
           this.infoBar = true
           this.infoMsg = 'fill in your details to activate your account'
           this.color='teal'
         return true
       }
       return false
        //return this.imageFile.length < 1; // or === 0   
    }
    },
    data() {
      return {
        banked: false,
        show1: false,
        show2: true,
        errors: [],
        infoBar:'',
        color:'',
        fname:null,
        lname:'',
        bankaccountNumb: '',
          valid:'',
          e1: 0,
            slides: 3,
    active: 1,
    referral: '',
        businessName : '',
        Instagram: '',
        phoneNumber: '',
        BusinessAddress: '',
        stateResidence: '',
        Country: ['Nigeria'],
        paystackKey: '',
        subaccount: true,
        subaccount_created:null,
        facebookPixel: '',
        businessDesc: '',
        progressValue:'',
        overlay: false,
        userProfile:
            {
                city:'',
                phone:'',
                validid: [],
                profileImg: null,
            },
          getid: this.userId,
          userDetail: this.userDetails,
          bankList:banks,
          statelist: liststates,
          bankcode: null,
          legalID: null,
          subaccount_code: '',
          is_verified: 'false',
          bank: null,
          entryDate:null,
          disabledbtn: true,
          disabledField: true,
           rules: [
             v => !!v || 'This is required',
        value => !value || value.size < 3000000 || 'File size should be less than 3 MB!',
      ],
        nameRules: [
       // (v)=> /^[a-z0-9]+$/.test(v) || 'lowercase only, no space allowed',
      (v) => !!v || 'This is required',
      (v) => v && v.length <= 20 || 'Name must be less than 20 characters'
    ],
    nurules: {
      numbs: value => /^[0-9]+$/.test(value) || 'numbers only',
          required: value => !!value || 'Required.',
          min: v => v.length >= 10 || 'Min 10 characters',
          emailMatch: () => ('The email and password you entered don\'t match'),
        }
      }
    },
     methods: {
      confirmUpdate(){
        if(!this.userDetails.customer_code){
          console.log('no customer defined')
          this.banked = true
        }else{
          console.log('user/customer defined')
          this.banked = true //false
        }
      },
      listOfBanks(){
 this.$http.get('https://api.paystack.co/bank',PaystackOptions)
                .then(resp => {
           console.log(resp.data.data)
          const results = resp.data.data
           const banklist = results.map(({name,code}) => ({text, value}));
           //const bankcodes = results.map(({code,name}) => (code));
           this.bankList = banklist
          // this.bankcode = bankcodes
           console.log('the list : '+JSON.stringify(banklist))
            //resolve(resp)
          }).catch(err => {
              console.log(err)
              
              //this.infoBar = true
              //this.infoMsg = 'profile image failed, try again'
            //reject(err)
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
           console.log(resp.data.url)
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
  updateUser () {

    const Hoptions = {
  headers: {'Authorization': 'Bearer sk_live_01952d79b3b14815af91d560256959358299e123'}
}
                this.loading = true;
                //const interestsJson = this.interests
                //console.log(JSON.stringify({ interestsJson }))
                this.$http.post('https://api.paystack.co/customer', {
                  email:this.userEmail,
                  phone:this.phoneNumber
                },Hoptions)
                .then(
                  respA => {
                
                    const cust_id = respA.data.data.id
                    const cust_code = respA.data.data.customer_code
                    
                    return this.$http.post('/users/'+this.userId, {
                title: '',
                content: '',
                fields : {
                referral: this.referral,
                business_name: this.businessName,
                instagram: this.Instagram,
                email: this.userEmail,
                phone_number: this.phoneNumber,
                business_address: this.BusinessAddress,
                state:this.stateResidence,
                country:this.Country,
                facebook_pixel: this.facebookPixel,
                brand_image: this.userProfile.profileImg,
                business_description: this.businessDesc,
                customer_code: cust_code,
                bank_acct: this.bankaccountNumb,
                bank_name: this.bank.text,
                bank_code: this.bank.value,
                customer_id: cust_id,
                first_name: this.fname,
                last_name: this.lname,
                referal: this.referral,
                legalid:this.legalID,
                subaccount: this.subaccount,
                subaccount_code: this.subaccount_code,
                is_verified: this.is_verified,
                last_login: this.entryDate //JSON.stringify({ user })
                },
                 status: "publish"
            })
                  }
   /* Promise.all([
      respA,
      this.$http.post('/users/'+this.userId, {
                title: '',
                content: '',
                fields : {
                
                business_name: this.businessName,
                instagram: this.Instagram,
                email: this.userEmail,
                phone_number: this.phoneNumber,
                business_address: this.BusinessAddress,
                state:this.stateResidence,
                country:this.Country,
                facebook_pixel: this.facebookPixel,
                brand_image: this.userProfile.profileImg,
                business_description: this.businessDesc,
                customer_code: respA.data.customer_code,
                bank_acct: this.bankaccountNumb,
                bank_name: this.bank,
                customer_id: respA.data.id,
                first_name: this.fname,
                last_name: this.lname,
                referral: this.referral,
                legalid:this.legalID,
                last_login: this.entryDate //JSON.stringify({ user })
                },
                 status: "publish"
            })
    ]) */
                )
               // .then(([respA,response]) => {
                  .then(response => {
                     const metricOps = {
        namespace: this.user+'.mulaa.store', //this.nname
        key: this.userDetails.customer_code,
        enable_reset: 1,
}
countapi.create(metricOps).then((result) => { 
  console.log(result);
 });
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                //console.log(response.data)
                this.$router.push({name: 'dashboard', params: { sheet: false }})
                //console.log(response.data.id)
                //this.profileId = response.data.id
            })
            .catch((e) => {
                this.loading = false;
                console.error(e)
                //this.infoBar = true
              //this.infoMsg = 'profile update failed, try again later'
            })
  },
  fetchUserData(){
        this.$store.dispatch('loadUserDetails', this.user)
        //console.log(this.userDetails)
       // console.log('account email: '+this.accountEmail)
        //console.log(userDetails)
        
    },
    checkAcct(evt){
      console.log(evt)
         if(this.bankaccountNumb.length < 10){
           console.log("less than 10")
           return
         }
         return
       },
       createSubaccount(){
         //if(this.fname != '' && this.businessName != '' && this.subaccount_code ==''){ //this.fname
           if(this.fname){
          
            this.loading = true

            //http://dev.mulaa.africa/admin/wp-json/mulaa-auth/v1/onboard
            let onbaordOps = {
              user: this.userDetails.id,
              nibss: this.bank.nibss,
                business_name: this.businessName,
                settlement_bank: this.bank.text,
                bank_code: this.bank.value,
                account_number: this.bankaccountNumb,
                percentage_charge: 1,
                primary_contact_email:this.userEmail,
                primary_contact_name: this.fname,
                primary_contact_phone: this.phoneNumber, //this.userProfile.phone
                referral: this.referral,
                instagram: this.Instagram,
                business_address: this.BusinessAddress,
                business_description: this.businessDesc,
                state:this.stateResidence,
                country:this.Country[0],
                facebook_pixel: this.facebookPixel,
                brand_image: this.userProfile.profileImg,
                referal: this.referral,
                legalid:this.legalID,
                subaccount: this.subaccount,
                }

            axios.get('https://shop.mulaa.co/imgapi/wp-json/mulaa-auth/v1/onboard/', { //http://dev.mulaa.africa/admin/wp-json/mulaa-auth/v1/onboard/ //https://shop.mulaa.co/imgapi/wp-json/mulaa-auth/v1/onboard/
    params:onbaordOps})
                .then(resp => {
                  //this.loading = false;
                  
                  //
                  const metricOps = {
                  namespace: this.user+'.mulaa.store', //this.nname
                  key: resp.data.user,
                  enable_reset: 1,
                  }
                  countapi.create(metricOps).then((result) => { 
                    console.log(result);
                  });
                  console.log("done: ",resp.data)
                  this.loading = false;
                  this.$router.push({name: 'dashboard', params: { sheet: false }})
                }).catch((e) => {
                console.error(e)
                this.errors = "Something went wrong, try again"
                this.loading = false;
            })
return;
            this.$http.post('https://api.paystack.co/subaccount', {
                business_name: this.businessName,
                settlement_bank: this.bank.text,
                account_number: this.bankaccountNumb,
                percentage_charge: 1,
                primary_contact_email:this.userEmail,
                primary_contact_name: this.fname,
                primary_contact_phone: this.userProfile.phone
            }, PaystackOptions)
            .then(response => {
              //console.log(response.data)
              this.subaccount = true
      this.subaccount_code = response.data.data.subaccount_code
          this.is_verified = 'false'
              this.loading = false
              this.e1 = 3
            })
             .catch((e) => {
               this.loading = false
               //console.error(e)
             })

         }else{
           console.log('empty')
           this.loading = false
           this.bank = {
             text: '',
             value: ''
           }
           return this.e1 = 2
         }
        
        
       }
  },
   watch: {
     bank(val){
       if(val!=null){
         this.disabledField = false
       }
     },
      bankaccountNumb (val) {
        this.loading = true
        //this.overlay = true
        //console.log(val + '/'+ this.bank.value)
        if(val.length == 10){
          this.overlay = true
          //console.log(PaystackOptions)
        let config = {
  headers: {'Authorization': 'Bearer sk_live_01952d79b3b14815af91d560256959358299e123'},
  params: {
                  account_number:val,
                  bank_code:this.bank.value
                },
}
        axios.get('https://api.paystack.co/bank/resolve', config)
                .then(resp => {
                  //console.log(resp.data)
                  this.fname = resp.data.data.account_name
                  this.loading = false
                  this.overlay = false
          //this.errors = valid ? [] : ['async error']
        })
        .catch((e) => {
                //console.error(e)
                this.errors = "Please enter a valid account number"
                 this.loading = false
                  this.overlay = false
            })
        }
        /*axios.get('/check?value=' + val).then(valid => {
          this.errors = valid ? [] : ['async error']
        })*/
      },
      paystackKey(val){
        if(val.lenght >= 20){
          this.subaccount = false
        }
        return
      },
      fname(val){
        if(this.fname !=''){
          //console.log(val)
          this.disabledbtn = false
        }
        return 
      },
      e1(val){
        if(val == 3){
          //this.loading = true

        }

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