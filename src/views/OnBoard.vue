<template>
    <div class="mt-5 pa-3 page">
       <!-- <v-alert type="info" dark class="mx-5 teal lighten-4 teal--text">
      Complete your busienss details below to activate your store and begin selling
    </v-alert>-->
 <v-layout row wrap align-center="align-center" justify-center="justify-center" class="pa-4 mt-5">
    <v-form 
      ref="oform"
      v-model="valid"
      color=transparent
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
        v-model="businessName"
    
        placeholder="Business Name"
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
        
        type="number"
        class="teal--text form-field"
        placeholder="080 000 00000"
        prepend-inner-icon="mdi-cellphone"
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
        v-model="BusinessAddress"
        placeholder="Business Address"
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
        <v-text-field
        filled
                    full-width
                    single-line
                    background-color="#f4f8f7"
        color="teal lighten-3"
        v-model="stateResidence"
        prepend-inner-icon="mdi-crosshairs-gps"
        
        placeholder="State"
        class="teal--text form-field"
       
        ></v-text-field>
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
          @click="e1 = 2"
          rounded 
      large 
      class="px-5 mb-5 text teal--text" 
      color="#23d2aa" 
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
        
        >
        <v-list-item two-line>
        <v-list-item-content>
        <v-list-item-title class="headline mb-2 teal--text">Sales Details</v-list-item-title>
        <v-list-item-subtitle>Select your preferred payment provider</v-list-item-subtitle>
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
          @click="e1 = 1"
          rounded 
      large 
      class="px-5 mb-5 text teal--text" 
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

       <v-btn
          @click="updateUser()"
          rounded 
      large 
      class="px-5 mb-5 text teal--text mr-3" 
      color="#23d2aa" 
      
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
export default {
    created(){
      this.fetchUserData()
      if(this.$store.getters.isLoggedIn=== true){
       // this.$router.push('/') //this.$store.getters.isLoggedIn
      }
    },
    computed: {
      ...mapState({
      registerMsg:'registerMsg',
      color:'color',
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
    dateFunction() {
   
            var currentDate = new Date();
            console.log(currentDate);
  
            var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
            console.log(currentDateWithFormat);
            return currentDateWithFormat
     
        }
    },
    data() {
      return {
          valid:'',
          e1: 0,
            slides: 3,
    active: 1,
        businessName : '',
        Instagram: '',
        phoneNumber: '',
        BusinessAddress: '',
        stateResidence: '',
        Country: ['Nigeria', 'Ghana', 'Togo'],
        paystackKey: '',
        facebookPixel: '',
        businessDesc: '',
         progressValue:'',
        overlay: false,
        userProfile:
            {
                city:'',
                phone:'',
                validid: [],
                profileImg: null
            },
          getid: this.userId,
          userDetail: this.userDetails

      }
    },
     methods: {
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
                this.loading = true;
                //const interestsJson = this.interests
                //console.log(JSON.stringify({ interestsJson }))
                this.$http.post('/users/'+this.userId, {
                title: '',
                content: '',
                fields : {
                /*date_joined: dateFunction,*/
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
                last_login: ''//dateFunction() //JSON.stringify({ user })
                },
                 status: "publish"
            }).then((response) => {
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                console.log(response)
                this.$router.push({name: 'dashboard', params: { sheet: false }})
                //console.log(response.data.id)
                //this.profileId = response.data.id
            })
            .catch((e) => {
                this.loading = false;
                console.error(e)
                this.infoBar = true
              this.infoMsg = 'profile update failed, try again later'
            })
  },
  fetchUserData(){
        this.$store.dispatch('loadUserDetails', this.user)
        //console.log(userDetails)
    }
  },
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