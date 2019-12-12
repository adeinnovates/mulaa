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
        Facebook Store Feed
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
           @click.stop.prevent="copyEmbedCode('embed-code')"
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
            <!--<p>
                As a mulaa user, you can invite your friends to use mulaa and earn a commision and rewards for every friend that subscribes to use mulaa
            </p>-->
            <p>
              Mulaa makes your products ready for Facebook product advertising or Instagram shop tag. Easily generate a Facebook product catalog feed here
              <v-btn text color="#23d2aa" 
class="caption"
@click="processJson()"
:loading="loading"
>
<v-icon small left>mdi-download</v-icon>
Generate feed
<!--Buy-->
</v-btn>
            </p>
            <div
            v-show="showfeedurl"
            class="pa-4"
            >
           
             <v-textarea
          filled
          name="input-7-4"
          :readonly=true
          color="teal"
          label="Copy the feed URL below"
          id="feedcode"
          class="small teal lighten-5"
          :value="feedurl"
        ></v-textarea>
               <v-btn 
             large ripple
             class="px-5 mb-5 text teal--text" 
      color="#23d2aa" 
            id=""
           @click.stop.prevent="copyEmbedCode('feedcode')"
          :loading="loading">
          <span class="caption px-5">Copy Feed</span>
          </v-btn>
<br>
          <small>
            keep in mind that Instagram will only allow you to tag real, physical products in your posts.
          </small>
          </div>

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
import { log } from 'util';
import axios from 'axios'


export default {
     props: ['thisUser'],
    data(){
        return{
          showfeedurl: false,
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
        shopfeed:'',
        feedurl:''
        }
    },
    methods: {

  processJson(){
    const itemsFormatted = [];
this.loading = true
    const headers = {
    id: 'id'.replace(/,/g, ''), // remove commas to avoid errors
    title: "Title",
    description: "Description",
    availability: "Availability",
    condition: "Condition",
    price: "Price".replace(/,/g, ''),
     image_link: "Image_link",
    brand: "brand",
    link: "Link"
   
};

// format the data
//console.log(this.currentUserProd)

this.currentUserProd.forEach((item) => {
    itemsFormatted.push({
    id: item.productID,
    title: item.title.replace(/,/g, ''),
    description: item.description.replace(/,/g, ''),
    availability: 'in stock',
    condition: 'New',
    price: 'NGN '+item.price.replace(/,/g, ''),
    image_link: item.image,
    brand: this.$store.state.user,
    link: "https://"+this.$store.state.user+".mulaa.store/"+item.productID
    
    });
});
//console.log(itemsFormatted)
const fileTitle = this.owner+'-mulaa-feed-'+this.$store.state.user // or 'my-unique-title'

return this.exportCSVFile(headers, itemsFormatted, fileTitle);

  },
  convertToCSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';

    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','

            line += array[i][index];
        }

        str += line + '\r\n';
    }

    return str;
},
  exportCSVFile(headers, items, fileTitle) {
    if (headers) {
        items.unshift(headers);
    }

    // Convert Object to JSON
    var jsonObject = JSON.stringify(items);

    var csv = this.convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + '.csv' || 'mulaa-export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            /*document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            */
           this.shopfeed = blob
           this.onUpload(exportedFilenmae, blob) 
           //this.loading = false
        }
    }
},
onUpload(thefilename,url) {
    // upload file
    const formData = new FormData()
    formData.append('shopfeeds', url, thefilename)
    //formData.append('username', this.user);
//console.log(formData)
/*
for (var key of formData.entries()) {
			console.log(key[0] + ', ' + key[1])
}*/
const headers2 = {
  'Content-Type': 'multipart/form-data'
}
   
       axios.post(`https://shop.mulaa.co/imgapi/feed.php`, formData, {
    headers: headers2,
    onUploadProgress: progressEvent => {
       this.progressValue = Math.round(progressEvent.loaded / progressEvent.total *100)
      console.log(Math.round(progressEvent.loaded / progressEvent.total *100) + '%')
    }
  })
    .then(resp => {
           //console.log(resp.data.url)
           if(resp.data.status == "success"){
             this.showfeedurl = true
              this.feedurl = resp.data.url
           }else{
             this.feedurl = "error geenrating data, please email team@mulaa.co for support assistance"
           }
           
           //console.log(resp.data)

           this.loading = false
            //resolve(resp)
          })
          .catch(err => {
              console.log(err)
              //this.overlay = false
              //this.infoBar = true
              //this.infoMsg = 'profile image failed, try again'
            //reject(err)
          })
  },
     copyEmbedCode (val) {
       console.log(val)
          let testingCodeToCopy = document.querySelector('#'+val)
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
     currentUserProd: {
      get() {
        //let theUserProducts = this.$store.state.userProducts;
        let theUserProducts = this.$store.state.myproducts;
        if (theUserProducts.length > 0){
          return theUserProducts
        }else{
console.log('No products yet')
return null
        }
      },
      set(value) {
        this.$store.commit('loadUserProducts', value);
      }
    }
    },
    watch: {
       /*feedurl(){
         
       }*/
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