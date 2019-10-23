<template>
    <div>


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
@change="onKycFile"
ref="kycinput"
>
<p class="text-left">Complete this step to be able to accept payment from your mulaa account. Upload a government issued ID (Drivers License/International Passport/)</p>
<v-file-input :rules="rules" persistent-hint show-size accept="image/*" label="File input" prepend-icon="mdi-paperclip" filled background-color="#f4f8f7" placeholder="Upload your documents"></v-file-input>
<v-overlay 
:value="overlay"
dark
:z-index="9999">
<v-progress-circular :value="progressValue"></v-progress-circular>
</v-overlay>

<div class="text-center mb-5">
<v-avatar color="#23d2aa" @click="$refs.kycinput.click()" width="100" height="100">
<img v-if="legalID !=null || undefined" :src="legalID" alt="legal">
<v-icon v-else dark>mdi-camera</v-icon>
</v-avatar>
<span class="d-block overline mt-3">Govt. Issued ID</span>
</div>
</v-col>
</v-row>
        
    </div>
</template>

<script>
import store from '@/store' 
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'

const PaystackOptions = {
  headers: {'Authorization': 'Bearer sk_test_0fe01ff01cdb2bd222084d4270c69ec2c98f8544'}
}

export default {
    data() {
      return {
        fname:'',
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
                profileImg: null,
            },
          getid: this.userId,
          userDetail: this.userDetails,
          bankList: null,
          legalID: null,
           rules: [
        value => !value || value.size < 3000000 || 'File size should be less than 3 MB!',
      ],
      }
    },
    methods: {
      listOfBanks(){
 this.$http.get('https://api.paystack.co/bank',PaystackOptions)
                .then(resp => {
           //console.log(resp.data.data)
          const results = resp.data.data
           const banklist = results.map(({code,name}) => (name));
           this.bankList = banklist
           //console.log('the list : '+banklist)
            //resolve(resp)
          }).catch(err => {
              console.log(err)
              
              //this.infoBar = true
              //this.infoMsg = 'profile image failed, try again'
            //reject(err)
          })
      },
      onKycFile (event) {
    this.legalID = event.target.files[0]
    this.overlay = true
    this.sendKyc()
  },
  sendKyc(){
    // upload file
    const formData = new FormData()
    formData.append('legal', this.legalID, this.legalID.name)
    formData.append('username', this.user);

const headers2 = {
  'Content-Type': 'multipart/form-data'
}
    //axios.post(`//dev.mulaa.co/imgapi/upload.php`, formData, {
       axios.post(`https://shop.mulaa.co/imgapi/kyc.php`, formData, {
    headers: headers2,
    onUploadProgress: progressEvent => {
       this.progressValue = Math.round(progressEvent.loaded / progressEvent.total *100)
      console.log(Math.round(progressEvent.loaded / progressEvent.total *100) + '%')
    }
  })
    .then(resp => {
           console.log(resp.data.url)
           this.legalID = resp.data.url
            this.overlay = false
            this.infoBar = true
            this.infoMsg = 'KYC uploaded successfully'
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
    }
}
</script>