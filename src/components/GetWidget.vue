<template>
    <v-dialog v-model="dialog" max-width="700px" class="extra-round extra" transition="slide-x-reverse-transition">
        <template v-slot:activator="{ on }">
            <v-responsive>

                <span
                v-on="on"
                > <v-icon small color="teal"
                 
                 >
              mdi-settings
              </v-icon>
              Get Widget </span><br>
<span class="small text-lowercase teal--text">display your mulaa store anywhere</span>
            </v-responsive>
        </template>

 <v-card 
     class="mx-auto teal lighten-5 mb-0"
            >
             <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#fff">{{infoMsg}}</span>
</v-snackbar>

 <v-card-title>
    <div class="headline font-weight-light headlineText">
         Mulaa Merchant Widgets
    </div>
  </v-card-title>
  
<v-container class="white lighten-5 mb-0">
<div id="linkform">
<v-form
      ref="linkForm"
    >

<v-tabs
      v-model="tab"
     background-color="transparent"
     
  color="teal lighten-2"
  class="mt-n3"
      icons-and-text
    >
      

      <v-tab 
      href="#tab-1"
      class="font-weight-light"
      >
        Embeddable Store
        <v-icon
        class="teal--text"
        small
        >mdi-cart</v-icon>
      </v-tab>

      <v-tab 
      href="#tab-2"
      class="font-weight-light"
      >
        referral Link
        <v-icon
        class="teal--text"
        small
        >mdi-link</v-icon>
      </v-tab>
    </v-tabs>
 <v-tabs-slider></v-tabs-slider>
    <v-tabs-items v-model="tab">
      <v-tab-item id="tab-1"
      >
        <v-card flat>
          <v-card-text>
            
<v-row>
        <v-col>
             <v-card-text class="pt-0">
             <p class="mb-3 mt-2">Add your mulaa store to any website/wordpress by simply pasting this mulaa widget code into any page on the website</p>

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

<v-btn 
             large ripple
             class="px-5 mb-5 text teal--text" 
      color="#23d2aa" 
            id=""
           @click.stop.prevent="copyEmbedCode"
          :loading="loading">
          <span class="caption px-5">Copy Code</span>
          </v-btn>

             </v-card-text>
        </v-col>
</v-row>
            </v-card-text>
        </v-card>
      </v-tab-item>
       <v-tab-item id="tab-2"
      >
        <v-card flat>
          <v-card-text>
            <p>
                As a mulaa user, you can invite your friends to use mulaa and earn a commision and rewards for every friend that subscribes to use mulaa
            </p>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
</v-form>
</div>
</v-container>
<v-card-actions style=background-color:#000028>
   
               <v-btn text color="teal lighten-3" @click="dialog = false" v-if="infoBar = false" class="caption"> 
              <v-icon right-3 color="teal lighten-3" small class="mr-2">mdi-close-circle</v-icon>
             Cancel
              </v-btn>
              <v-btn text color="teal lighten-3" @click="dialog = false" class="caption" v-else>
              <v-icon right-3 small color="teal lighten-3" class="mr-2">mdi-close-circle</v-icon>
             Close
              </v-btn>
            </v-card-actions>
 </v-card>
       
    </v-dialog>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
//import axios from 'axios'


export default {
     props: ['thisUser'],
    data(){
        return{
            embedcode: `<div class="mulaa_embed" data-src="https://mulaa.me/u/`+ this.$store.state.user +`" style="height:400px;width:680px;margin: 10px auto;position:relative" data-responsive="true" data-img="https://shop.mulaa.co/shop_cover.png" data-css="background:url('//shop.mulaa.co/loading.gif') white center center no-repeat;border:0px;float:middle;" data-Id="mulaa-sdk" data-Class="mulaa-sdk" data-name="mulaa.co"></div>
        `+'<script src="https://shop.mulaa.co/async-iframe.js"',
          tab: 'tab-1',
          linkdesc:'',
          linkurl:'',
          addlink: false,
          inset:'false',
            title: '',
            price: '',
            discount: '',
            discountEnable:'',
            description: '',
            deliveryLocations: '',
            headers: {'Content-Type' : 'multipart/form-data'},
            imageFile:'',
            active: 0,
            dialog: false,
            loading: false,
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            nurules: {
          required: value => !!value || 'Required.',
          min: v => v.length >= 6 || 'Min 6 characters',
          price: v => v.length >= 4 || 'Min 1000',
          url: v => /^[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)+$/.test(v)|| 'Valid URL required'
        },
            infoBar: false,
        infoMsg: '', 
        color: '',
        date: this.dateFunction(),
        owner: this.$store.state.userId,
        userURL: 'https://mulaa.me/u/'+this.$store.state.user,
        }
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
      dateFunction() {
   
            var currentDate = new Date();
            //console.log(currentDate);
            var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
            //console.log(currentDateWithFormat);
            return currentDateWithFormat
        },
        fetchData(){
          //this.$store.dispatch('loadUserProducts', this.user)
          this.$store.dispatch('loadDashboardProducts', this.user)
          this.$store.dispatch('loadAllProducts', 'top')
       // this.$store.dispatch('getUser', this.user)
    },
      resetForm () {
        this.$refs.uploadForm.reset()
       // this.$refs.linkForm.reset()
        //this.$refs.imgUploader.placeholder = ''
      },
  },
  computed: {
      ...mapState({
      registerMsg:'registerMsg',
      user:'user',
      userUrl:'userUrl',
      }),
     disabled() {
       if (this.imageFile.length < 1 || this.title == ' '){
         return true
       }
       return false
        //return this.imageFile.length < 1; // or === 0   
    },
    } 
}
</script>
<style>
    .headlineText{
        color: #000028;
    }
     .img-inputer.img-inputer--light, .img-inputer.img-inputer--{
        width:270px !important;
        height:250px;
        border: 1px solid #ffffff !important;
    }
    .img-inputer__preview-box.clear{
        display: none !important;
    }
</style>