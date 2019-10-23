<template>
    <div class="dashboard fill-height teal lighten-5 page pa-3 mt-10">

<div
class="headline lighten-4 pa-4 font-weight-light teal--text mb-n6"
>
Hello, <br> {{user}}
</div>
 <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#000028">{{infoMsg}}</span>
  <!--<v-btn flat color="white" @click="snackbar = false">close</v-btn>-->
</v-snackbar>
 <v-container fluid fill-height teal lighten-5>
             <v-layout row wrap equal>
                <v-flex xs12 sm8 md7 pa-5>

<v-list two-line subheader class="pa-3" style="border-top-left-radius:15px;border-top-right-radius:15px;">
      <v-subheader>Profile Settings  
        <div class="flex-grow-1"></div>
        <EditSettings :theuser="userDetails" :user="user" :userImg="this.userProfile.profileImg"></EditSettings>
        </v-subheader>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="grey--text caption text--darken-2">
            <v-icon small color="grey">mdi-account-card-details-outline</v-icon>
            Business Name</v-list-item-title>
          <v-list-item-subtitle class="caption">{{userDetails.business_name}}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action>
          
        </v-list-item-action>
      </v-list-item>
<v-divider inset></v-divider>
      <v-list-item three-line>
        <v-list-item-content>
          <v-list-item-title class="grey--text caption text--darken-2">
            <v-icon small color="grey">
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
          <v-list-item-title class="grey--text caption text--darken-2">
             <v-icon small color="grey">
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

    

    <v-divider></v-divider>


    <v-list two-line subheader class="pa-5">

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="grey--text caption text--darken-2">
            <v-icon small color="grey">
              mdi-cash
              </v-icon>
            Payment Key</v-list-item-title>
          <v-list-item-subtitle class="caption grey lighten-4 pa-3 mt-2">{{userDetails.payment_key}}</v-list-item-subtitle>
        </v-list-item-content>
        
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="grey--text caption text--darken-2">Facebook Pixel</v-list-item-title>
          <v-list-item-subtitle class="caption grey lighten-4 pa-3 mt-2">{{userDetails.facebook_pixel}}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>


      <v-list-item>
        <v-list-item-content>
          <v-list-item-title
          class="grey--text caption text--darken-2"
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

    </v-list>
                </v-flex>
             </v-layout>
 </v-container>
    </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import Avatar from 'vue-avatar'
import EditSettings from '@/components/EditSettings'
import axios from 'axios'

export default {
  components: {
    Avatar,
     EditSettings,
  },
    data() {
      return {
         infoMsg: '', 
        infoBar: false,
 valid:'',
  overlay: false,
   progressValue:'',
  userProfile: 
            {
                city:'',
                phone:'',
                validid: [],
                profileImg: this.myProfileImg
            },
      }
    },
     created() {
        return this.fetchUserData()
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
fetchUserData(){
        this.$store.dispatch('loadUserDetails', this.user)
        //console.log(userDetails)
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
    }
}
</script>
<style>
.v-list .v-divider--inset:not(.v-divider--vertical){
  max-width: 100% !important;
  margin-left:0;
}
</style>