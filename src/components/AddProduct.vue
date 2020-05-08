<template>
    <v-dialog v-model="dialog" max-width="700px" class="extra-round extra" transition="slide-x-reverse-transition">
        <template v-slot:activator="{ on }">
            <v-responsive style="margin-top:-30px;">

                <div class="text-center my-5 pt-4 mb-3">
                                <v-sheet color="transparent" class="caption">Add a new product</v-sheet>
                                <v-spacer></v-spacer>
                                <v-btn class="mx-2 mt-2" 
                                fab 
                                dark 
                                color="white--text" 
                                v-on="on"
                                style="background-color:#000028"
                                >
                                    <v-icon dark>mdi-plus</v-icon>
                                </v-btn>
                </div>

            </v-responsive>
        </template>

 <v-card 
     class="mx-auto teal lighten-5 mb-0"
            >
             <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#000028">{{infoMsg}}</span>
</v-snackbar>

 <v-card-title>
     <div class="headline font-weight-light headlineText">
         Create a <span v-if="!addlink">product</span><span v-else>Link</span>
         </div>
  </v-card-title>
   <div class="d-block px-7">
           <v-switch 
        v-model="addlink" 
        label="Make a link" 
        class="mt-0"
        color="#23d2aa"
        inset
        >
        </v-switch>
        </div>
         <p class="teal--text mb-5 px-7 caption">
                    Tap the image uploader to select a photo from your phone, enter the product name below
          </p>
<v-container class="white lighten-5 mb-0">

<div id="prodform" v-if="!addlink">
  <v-form
      ref="uploadForm"
    >
    <v-row>
        <v-col cols="12" md="12" sm="12">
             <v-card-text class="pt-0">
             <p class="mb-3 mt-2 overline">upload product image</p>
             <!--
  <img-inputer accept="image/*" 
            v-model="imageFile"
            icon="img"
            upload-key="product" 
            auto-upload 
            theme="light"
            no-mask
            :capture=false
            action="https://shop.mulaa.co/imgapi/prod.php" 
            :on-error="onErr"
            :on-success="onSuc"
            placeholder = "Drop image here or tap to add one"
            bottom-text="Drop image here or tap to add one"
            @reset = "reset"
            ref="imgUploader"
            
            />
            -->
             
<!--
             <v-file-input small-chips multiple label="File input"
             prepend-icon="mdi-camera"
             v-model="imgslides"
             ref="file"
             ></v-file-input>-->
<v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear>       
<vue-upload-multiple-image
@upload-success="uploadImageSuccess"
@before-remove="beforeRemove"
@edit-image="editImage"
:data-images="images"
@data-change="dataChange"
dragText="your product images"
browseText="tap to upload"
primaryText="product"
popupText="-"
markIsPrimaryText="0"
class="imgBox"
ref="imgBox"
>
</vue-upload-multiple-image>

</v-card-text>
             
        </v-col>
    </v-row>
    <v-row class="px-8">
        
        <v-col cols="12" lg="6" md="6" sm="12">
            
           <v-text-field
           class="teal--text form-field mt-3"
            v-model="title"
            label="title"
            placeholder="product name"
            outlined
            color="teal lighten-3"
            :rules="[nurules.required]"
            :hide-details=true
          ></v-text-field>
          <v-textarea
          class="teal--text form-field my-2 mb-4"
          v-model="description"
          outlined
          label="Description"
        :hide-details=true
          color="teal lighten-3"
        ></v-textarea>
        <!--<v-text-field
           class="teal--text form-field mt-3"
            v-model="deliveryLocations"
            label="delivery Locations"
            placeholder="Seperate each location with a comma"
            outlined
            color="teal lighten-3"
            hint="If you deliver everywhere, enter 'ALL' or seperate each location with a comma"
            persistent-hint
            :rules="[nurules.required]"
          ></v-text-field> -->

          <v-combobox multiple
                    v-model="selectLocation" 
                    label="Delivery Locations" 
                    color="teal lighten-3"
                    append-icon
                    chips
                    deletable-chips
                    class="tag-input mt-4"
                    hint="If you deliver everywhere, enter 'ALL' or enter each location seperately"
            persistent-hint
                    :search-input.sync="search" 
                    @keyup.tab="updateTags"
                    @paste="updateTags">
          </v-combobox>
           
        </v-col>

    <v-col cols="12" lg="6" md="6" sm="12">
       
            <v-row>
                  <v-col>
              <v-text-field
                        class="teal--text form-field ma-0"
                          v-model="price"
                          label="price"
                          placeholder="base price"
                          type="number"
                          prepend-inner-icon="mdi-currency-ngn"
                          outlined
                          color="teal lighten-3"
                          :rules="[nurules.required]"
                          :hide-details=true
                        ></v-text-field>
                  </v-col>
                <v-col>
        <v-text-field
                class="teal--text form-field ma-0"
                v-model="discount"
                label="discount"
                type="number"
                placeholder="discount price"
                prepend-inner-icon="mdi-currency-ngn"
                outlined
                color="teal lighten-3"
                :hide-details=true
              ></v-text-field>
                </v-col>

            </v-row>
            <v-row >
            <v-col class="pt-n4">
            <v-text-field
              class="teal--text form-field ma-0"
              v-model="stock"
              label="in Stock"
              placeholder="Total Stock"
              type="number"
              prepend-inner-icon="mdi-counter"
              outlined
              color="teal"
              :disabled=disableStock
              
            ></v-text-field>
            </v-col>
            </v-row>

            <v-expansion-panels class="mt-n5 mb-5"
            :hover=true
            >
            <v-expansion-panel>
            <v-expansion-panel-header class="caption teal--text">Is this a digital product?</v-expansion-panel-header>
            <v-expansion-panel-content>
    <v-switch 
            v-model="eproduct" 
            label="Yes, e-product" 
            class="mt-n1"
            color="#23d2aa"
            inset
            :disabled=false
            >
            </v-switch>
            <v-sheet v-if="this.eproduct != ''" class="caption orange lighten-5 pa-2 rounded mb-2" style="color:#000028" elevation="0">
Select & attach a file from your list of files or go to <router-link to="digital" class="caption">Digital Assets</router-link> to upload a digital file to attach here
</v-sheet>

<v-select
         v-model="eproductFile"
          :items="userFiles"
          item-text="title"
          item-value="id"
          filled
          label="Digital assets"
          background-color="#f4f8f7"
          color="teal"
         return-object
         single-line
         v-if="this.eproduct != ''"
        ></v-select>

<!--
<v-file-input
small-chips
label="Upload Digital Product"
accept=".pdf,.doc,.docx,.xls"
show-size
color="teal lighten-3"
counter
prepend-icon="mdi-file-upload"
solo
@change="onFileChanged"
v-model="eproductFile"
:rules="fileRule"
v-if="this.eproduct != ''"
>
</v-file-input>-->

<v-overlay
:value="overlay"
dark
:z-index="9999">
<v-progress-circular :value="this.progressValue"></v-progress-circular>
</v-overlay>
              
              <!--upload digital media-->
            </v-expansion-panel-content>
            </v-expansion-panel>
            </v-expansion-panels>

        </v-col>   
    </v-row>
 
    <!-- lower segment-->
    <v-row 
    class="teal lighten-5 mb-n2"
    >
        <v-col 
        class="pa-5 border-right"
        col="6"
        sm="6"
        xs="12"
        >
          <p class="body-1 teal--text">Product Options</p>
         
<v-switch 
        v-model="discountEnable" 
        label="Show Discount?" 
        class="mt-n1"
        color="#23d2aa"
        inset
        >
        </v-switch>

        <v-switch 
                v-model="madetoorder" 
                label="custom made / made to order ?" 
                class="mt-1"
                color="#23d2aa"
                inset
                >
                </v-switch>

        </v-col>
        <v-col
         class="pa-5"
         col="6"
        sm="6"
        xs="12"
        >
           <p class="body-1 teal--text">Product Variations</p>

  <v-expansion-panels popout>
      <v-expansion-panel>
        <v-expansion-panel-header class="caption grey--text">Product Variations</v-expansion-panel-header>
        <v-expansion-panel-content>
          
<p class="caption grey--text lighten-1">Add options if this product comes in multiple variations, like different sizes or colors.</p>
<v-card
    class="pa-1"
    outlined
  >
    <v-card-title class="overline teal--text">Options ({{options.length}})</v-card-title>
    <v-card-text>
      <v-row>
      <v-col class="pa-0">
          <div class="form-group" v-for="(option,k) in options" :key="k">
          <v-row class="teal lighten-5 mb-1">
            <v-col
            cols="6"
        sm="6"
            >
                <v-text-field
                class="teal--text form-field ma-0"
                v-model="option.name"
                label="label"
                type="text"
                placeholder="item option"
                color="teal lighten-3"
                ></v-text-field>
            </v-col>
            <v-col
            cols="4"
        sm="4"
            >
                <v-text-field
                class="teal--text form-field ma-0"
                v-model="option.price"
                label="price"
                type="number"
                placeholder="price"
                prefix="₦"
                color="teal lighten-3"
                ></v-text-field>
            </v-col>
              <v-col
            cols="2"
        sm="2"
            >
<span>
            <v-icon class="teal--text text--darken-1" @click="remove(k)" v-show="k || ( !k && options.length > 1)">
                                    mdi-minus-circle-outline
                                    </v-icon> 
                                    <v-icon class="teal--text text--darken-1" @click="add(k)" v-show="k == options.length-1">
                                    mdi-plus-circle
                                    </v-icon> 
          </span>
              </v-col>
          </v-row>
          
          </div>
      </v-col>
    </v-row>
      </v-card-text>
  </v-card>

        </v-expansion-panel-content>
      </v-expansion-panel>
  </v-expansion-panels>


        </v-col>
    </v-row>

  <!---  
 <v-card
    class="mx-auto mb-5"
    max-width="90%"
    outlined
  >
     <v-card-title class="overline">Delivery [+] charges</v-card-title>
<v-card-text>

</v-card-text>
  </v-card>
  -->

   </v-form>
</div>
<div id="linkform" v-else>
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
        Url
        <v-icon
        class="teal--text"
        small
        >mdi-link</v-icon>
      </v-tab>

      <v-tab 
      href="#tab-2"
      class="font-weight-light"
      >
        Video
        <v-icon
        class="teal--text"
        small
        >mdi-video</v-icon>
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
             <p class="mb-3 mt-2 overline">Create a content short link</p>

<v-text-field
           class="teal--text form-field ma-0"
            v-model="linkurl"
            label="content link"
            placeholder="Type or paste a link (URL)"
            type="text"
            outlined
            color="teal lighten-3"
            :rules="[nurules.required, nurules.url]"
          ></v-text-field>
          <v-text-field
           class="teal--text form-field ma-0"
            v-model="linkdesc"
            label="Link Title"
            placeholder="Enter title for your link"
            type="text"
            outlined
            color="teal lighten-3"
            :rules="[nurules.required]"
          ></v-text-field>

<v-btn 
             large ripple
             class="px-5 mb-5 text teal--text" 
      color="#23d2aa" 
            id=""
           @click="postLink"
          :loading="loading">
          <span class="caption px-5">Save</span>
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
             <p class="mb-5 mt-2 ml-3 overline">
            At the moment you can only add one video to your profile
            </p>
            <v-row class="mx-5">
            <v-col
            cols="7"
        sm="7"
         class="black lighten-5"
            >
<youtube :video-id="videoId" ref="youtube" :width="290" :height="210" :fitParent="true" ></youtube>
            </v-col>

             <v-col
            cols="5"
        sm="5"
            >
 <v-text-field
           class="teal--text form-field ma-2"
            v-model="youtubeurl"
            label="Youtube Link"
            placeholder="Type or paste a link (URL)"
            type="text"
            outlined
            color="teal lighten-3"
            :rules="[nurules.required, nurules.url]"
          ></v-text-field>
           
          <v-textarea
          class="teal--text form-field my-2 mb-4"
          v-model="youtubetitle"
          outlined
          label="Video Title"
          placeholder="Type your video title here"
        :hide-details=true
          color="teal lighten-3"
        ></v-textarea>
            </v-col>
            </v-row>
          <v-btn 
             large ripple
             class="px-5 mb-5 text teal--text ml-5 mt-5" 
      color="#23d2aa" 
            id=""
           @click="postVideo"
          :loading="loading">
          <span class="caption px-5">Save Video to Profile</span>
          </v-btn>

          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
</v-form>
</div>
</v-container>
<v-card-actions v-if="!addlink" style=background-color:#000028>
    <v-tooltip top>
        <template v-slot:activator="{ on }">
            <v-btn text color="white" @click="postProduct" :disabled=disabled :loading="loading" v-on="on">
              <v-icon right-3 color="teal lighten-3" class="mr-2">mdi-check</v-icon>
             Save
              </v-btn>
               </template>
      <span>Save this product</span>
    </v-tooltip>
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
       
<v-overlay
:value="shareOverlay"
color="green lighten-1"
:opacity="0.8"
:z-index="9999"
light
>
        <div 
        style="width:100%;"
        >
          <v-layout row wrap mx-auto>
            
            <v-flex xs10 sm9 md9 lg9>
          <div class="headline font-weight-bold white--text">Congrats!!! 
            <p class="font-weight-light">
            Share on social media</p>
            </div>
            </v-flex>
          <v-flex xs2 sm3 md3 lg3 text-right>
              <v-btn
          icon
          @click="shareOverlay = false; resetForm(); dialog = false;"
          >
          <v-icon right>mdi-close</v-icon>
          </v-btn>
            </v-flex>
          </v-layout>
        </div>

<v-layout row wrap mx-auto>
  
<v-flex xs10 sm9 md9 lg9>

        <div class="mx-auto" style="max-width:490px;">
        <v-img
        :src="this.imgUrl"
        lazy-src="https://picsum.photos/id/11/10/6"
        width="400"
        class="grey mb-3"
        :contain="true"
        >
        </v-img>

          </div>

  </v-flex>
</v-layout>


<v-layout row wrap mx-auto style="width:100%;">
  <v-flex xs3 sm3 md4 lg4>
<p class="py-3">₦{{this.price}}</p>
  </v-flex>
 <v-flex xs9 sm9 md8 lg8>
          <social-sharing :url=pageurl
          :title=title
          :description=description
          :quote=description
          hashtags="mulaa,buy,shop,share,deal"
          inline-template>
          <div class="grey--text text--darken-2 px-3 mt-1 social-btn">

          <network network="facebook" class="caption pl-2 pr-3 mr-3 blue--text text--darken-2">
          <i class="fa fa-facebook fa-lg"></i> 
          </network>
          <network network="sms" class="caption pl-2 pr-3 mr-3 blue--text">
          <i class="fa fa-commenting-o fa-lg"></i>
          </network>
          <network network="twitter" class="caption pl-2 pr-3 mr-3 blue--text text--lighten-2">
          <i class="fa fa-twitter fa-lg"></i>
          </network>
          <network network="whatsapp" class="caption pl-2 pr-3 mr-3 green--text">
          <i class="fa fa-whatsapp fa-lg"></i>
          </network>

          </div>
          </social-sharing>
  </v-flex>
</v-layout>
  

</v-overlay>

    </v-dialog>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'
import VueUploadMultipleImage from 'vue-upload-multiple-image'
//import EmojiPicker from 'vue-emoji-picker'

export default {
    data(){
        return{
          videoId: null,
          youtubeurl: null,
          youtubetitle: null,
          pageurl: null,
          progressValue:'',
          overlay: false,
          shareOverlay: false,
          disabled: true,
          selectLocation: ['add-each-location', 'then press enter', 'or tab key'],
           search: "", //sync search
           items: [],
           infoBar: true,
        infoMsg: 'Product Successfully Saved', 
        color: '',
          postid: null,
          images: [],
          imgslides: null,
          eproduct: '',
          eproductFile:null,
          eproductFileName:null,
          eproductLink:'',
          disableStock: false,
          madetoorder: false,
          stock:1,
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
            fileRule: [
      value => !value || value.size < 10000000 || 'Product size should be less than 10 MB!',
    ],
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            nurules: {
          required: value => !!value || 'Required.',
          min: v => v.length >= 6 || 'Min 6 characters',
          price: v => v.length >= 4 || 'Min 1000',
          url: v => /^[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)+$/.test(v)|| 'Valid URL required'
        },
            imgUrl: '',
            uploadMsg: '',
        date: this.dateFunction(),
        owner: this.$store.state.userId,
        options: [
          {
            name:'',
            price: ''
          }
        ]
        }
    },
    components: {
    VueUploadMultipleImage
  },
  mounted(){

  },
  created() {
      this.fetchData()
 },
    methods: {
      getId (val) {
        
        this.videoId = this.$youtube.getIdFromUrl(this.youtubeurl)
        console.log(this.videoId)
      //return this.$youtube.getIdFromUrl(this.youtubeurl.url)
    },
      formatBytes (a,b){if(0==a)return"0 Bytes";var c=1024,d=b||2,e=["Bytes","KB","MB","GB","TB","PB","EB","ZB","YB"],f=Math.floor(Math.log(a)/Math.log(c));return parseFloat((a/Math.pow(c,f)).toFixed(d))}, //+" "+e[f]},
       onFileChanged (event) {
    if(!event){
      console.log("file change initiated")
      return
    }else{
      this.eproductFile = event
    console.log("event ", event.size, 10000000)
    if(event.size < 10000000){
      this.overlay = true
      console.log("less than 10mb", this.user)
       this.onUpload()
    }else{
      return
    }
    }
  },
  onUpload() {
    // upload file
    const formData = new FormData()
    formData.append('product', this.eproductFile, this.eproductFile.name)
    formData.append('username', this.user);
    //console.log(...formData.values())
//return
const headers2 = {
  'Content-Type': 'multipart/form-data'
}
    axios.post(`//dev.mulaa.co/imgapi/files.php`, formData, {
      // axios.post(`//shop.mulaa.co/imgapi/files.php`, formData, {
    headers: headers2,
    onUploadProgress: progressEvent => {
       this.progressValue = Math.round(progressEvent.loaded / progressEvent.total *100)
     // console.log(Math.round(progressEvent.loaded / progressEvent.total *100) + '%')
    }
  })
    .then(resp => {
           console.log(resp.data)
this.overlay = false
this.eproductFileName = resp.data.url
          /* this.userProfile.profileImg = resp.data.url
            this.overlay = false
            this.infoBar = true
            this.infoMsg = 'profile image uploaded'
            */
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
      updateTags() {
      this.$nextTick(() => {
        this.selectLocation.push();//...this.search.split(",")
        //this.tester = JSON.stringify(this.selectLocation)
        //this.deliveryLocation = JSON.parse(tester)
        this.$nextTick(() => {
          this.search = "";
        });
      });
    },
      dataChange(index, done, fileList){
//console.log('the index',index)
      },
      uploadImageSuccess(formData, index, fileList) {
        //console.log("working", formData)
       // this.loading = true;

      //create draft product post first if it doesn't exist
      if(!this.postid){ // if == null
       
        //const label = this.$refs.imgBox.querySelector('.cursor-pointer')
       //console.log("No post id: ", this.postid)
        this.loading = true
        console.log("loading....", this.loading)
       
       const label = document.querySelectorAll('.imgBox label')
        //label.style.display = "none"
        label[0].style.opacity = 0.1
        label[0].style.cursor = "not-allowed"
        //console.log(label)
        
console.log(this.token)
        this.loading = true;
        this.$http.post('/product', {
                title: this.title, // + '-' + this.user,
                content: ' ',
                 status: "draft"
                }).then((response) => {
                  //console.log('label: ', label)
                    //console.log(response)
                    this.postid = response.data.id
                    this.loading = false;
                    this.processFile(formData, index, fileList)
                }).catch((e) => {
                this.loading = false;
                console.error(e)
                })
      }
      const token = localStorage.getItem('token')
const config = {
            headers: {
              'Authorization': 'Bearer '+`${token}`, //localStorage.getItem('token')
              'Content-Type': 'image/png',
              'Content-Disposition': 'form-data'
              }
            }
           if(this.postid != null) {

             //const label = document.querySelectorAll('.display-block.full-width.full-height.cursor-pointer')
             //const label = document.querySelectorAll('.image-list-container.display-flex.flex-wrap') //imgBox
             const label = document.querySelectorAll('.imgBox')
             const labelIcon = document.querySelectorAll('.image-list-item.cursor-pointer svg')
        label[0].style.cursor = "not-allowed"
        label[0].style.opacity = 0.1
        labelIcon[0].style.display = "none"
        //label[0].style.display = "none"
        //console.log(label[0])

             this.loading = true
formData.append("post", this.postid);
      //console.log("post id exist ", this.postid)
axios
  .post("https://shop.mulaa.co/api/wp-json/wp/v2/media/", formData, config) //http://dev.mulaa.africa/admin/ */
  //this.$http.post('/media/',formData, config)
  .then(response => {
/*
    this.images.push(
                    {
                        path: response.data.source_url,
                        default: index,
                        highlight: index,
                        caption: response.data.slug
                    }
                );
                */
               this.imgUrl = response.data.source_url
               //console.log('icon ', labelIcon[0])
               labelIcon[0].style.display = "block"
                this.loading = false;
                label[0].style.cursor = "pointer"
              label[0].style.opacity = 1
        
      console.log("Success!");
      //console.log({ response }); //response.data.source_url / response.data.id / response.data.slug
  })
  .catch(error => {
      console.log({ error });
      this.loading = false;
      labelIcon[0].style.display = "block"
                this.loading = false;
                label[0].style.cursor = "pointer"
              label[0].style.opacity = 1
       console.log("Error Happened");
       this.color = 'red lighten-1'
                this.infoBar = true
              this.infoMsg = 'An Error Happened, Please Refresh and Try Again'
  });
  
           }else{
             //console.log('post id not created yet')
             this.loading = false;
           }
      
    },
    beforeRemove (index, done, fileList) {
      //console.log('index', index, fileList)
      var r = confirm("remove image")
      if (r == true) {
        done()
      } else {
      }
    },
    editImage (formData, index, fileList) {
      //console.log('edit data', formData, index, fileList)
    },
      processFile(formData, index, fileList) {
        //console.log("process file upload...")
        // const label = document.querySelectorAll('.display-block.full-width.full-height.cursor-pointer') //label[0].style.opacity = 0.1
        const label = document.querySelectorAll('.imgBox')
        label[0].style.opacity = 0.1 //label[0].style.cursor = "default"
        const labelIcon = document.querySelectorAll('.image-list-item.cursor-pointer svg')
        labelIcon[0].style.display = "none"
        //console.log(label[0])
//console.log(formData)
const config = {
            headers: {
              'Authorization': 'Bearer '+localStorage.getItem('token'),
              'Content-Type': 'image/png',
              'Content-Disposition': 'form-data'
              }
            }
           if(this.postid != null) {
             this.loading = true
formData.append("post", this.postid);
            
axios
  .post("https://shop.mulaa.co/api/wp-json/wp/v2/media/", formData, config)
  .then(response => {
/*
    this.images.push(
                    {
                        path: response.data.source_url,
                        default: index,
                        highlight: index,
                        caption: response.data.slug
                    }
                );
                */
               this.imgUrl = response.data.source_url
               label[0].style.cursor = "pointer"
               labelIcon[0].style.display = "block"
        //label[0].style.display = "block"
        label[0].style.opacity = 1
                this.loading = false;
      console.log("Success!");
      //console.log({ response }); //response.data.source_url / response.data.id / response.data.slug
  })
  .catch(error => {
      console.log({ error });
      this.loading = false;
  });
  
           }else{
             console.log('post id not created yet')
             this.loading = false;
           }
        /*
    //this.imgslides = event.target.files[0]
    if (this.imgslides) {
        let formData = new FormData();

        

        // files
        
        for (let file of this.imgslides) {
            formData.append("file", file, file.name);
        }
        

        // additional data
        //formData.append("test", "foo bar");
        console.log(formData)
        const config = {
            headers: {
              'Authorization': 'Bearer '+localStorage.getItem('token'),
              'Content-Type': 'image/png',
              'Content-Disposition': 'form-data'
              }
            }
        axios
            .post("http://dev.mulaa.africa/admin/wp-json/wp/v2/media/", formData, config)
            .then(response => {
                console.log("Success!");
                console.log({ response });
            })
            .catch(error => {
                console.log({ error });
            });
    } else {
        console.log("there are no files.");
    }
    */
  },
      add(index) {
            this.options.push({ name: '' });
        },
        remove(index) {
            this.options.splice(index, 1);
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
         // this.$store.dispatch('loadDashboardProducts', this.user)
         // this.$store.dispatch('loadAllProducts', 'top')
           this.$store.dispatch('loadUserFiles', this.user) 
       // this.$store.dispatch('getUser', this.user)
    },
      resetForm () {
        this.$refs.uploadForm.reset()
       // this.$refs.linkForm.reset()
        //this.$refs.imgUploader.placeholder = ''
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
      //console.log("​onErr -> file", file);
      //console.log("​onErr -> err", err);
    },
     onSuc(res, file) {
      //console.log("​onSuc -> file", file);
      //console.log("​onSuc -> res", res);
      this.imgUrl = res.url
      this.uploadMsg = res.message
      
    },
    exceedHandler(file) {
      console.warn("onExceed -> file", file);
    },
    postProduct:  function() {
      //console.log(JSON.stringify(this.options))
                this.loading = true;
                this.$http.put('/product/'+this.postid, {
                title: this.title, // + '-' + this.user,
                content: this.description,
                fields : {
                title: this.title,
                description: this.description,
                price: this.price,
                discount_price: this.discount,
                show_discount: this.discountEnable,
                delivery_locations: JSON.stringify(this.selectLocation),
                image: this.imgUrl,
                owner : this.owner,
                date_posted: this.date,
                product_options: JSON.stringify(this.options),
                stock: this.stock,
                madetoorder: this.madetoorder,
                eproduct: this.eproduct,
                eproductlink: this.eproductLink,
                eproductfile: this.eproductFile
                },
                 status: "publish"
                }).then((response) => {
                this.loading = false;
                this.pageurl = 'https://'+this.user+'.mulaa.store/'+this.postid
                //this.clear()
                //this.loadProducts()
                //console.log(response)
                //this.dialog = false
                this.shareOverlay = true
                //this.$store.dispatch('loadAllProducts', 'top')
                //this.$store.dispatch('loadDashboardProducts', this.user)
                this.color = 'green lighten-1'
                this.infoBar = true
              this.infoMsg = 'Product Successfully Saved'
              //this.fetchData()
            //this.resetForm()
            
            //return
            })
            .catch((e) => {
                this.loading = false;
                console.error('Error saving your product - ', e)
                this.color = 'red darken-1'
                this.infoBar = true
              this.infoMsg = 'Error saving your product'
              return
                //this.infoBar = true
              //this.infoMsg = 'profile update failed, try again later'
            })
  },
  postLink:  function() {
    this.loading = true;
              axios.get('https://mulaa.me/u/api/?key=P1fjdH02F3y2&url='+this.linkurl)
                .then(resp => {
                  //console.log(resp.data)
                  //this.fname = resp.data.data.account_name
          console.log(resp.data.short)
          //this.loading = false;
          //this.$refs.linkForm.reset()
          //this.resetForm()
          
           this.$http.post('/link', {
                title: this.linkdesc, // + '-' + this.user,
                content: this.linkdesc,
                fields : {
                  link_title: this.linkdesc,
                long_link: this.linkurl,
                short_link: resp.data.short
                },
                 status: "publish"
                })
this.$refs.linkForm.reset()
        })
        .then(response => {
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                //console.log(response.data.data)
                //this.$router.push({name: 'dashboard', params: { sheet: false }})
                this.updated = !this.updated
                this.color= 'green'
                this.infoBar = true
              this.infoMsg = 'Link successfully saved'
            })
        .catch((e) => {
                console.error(e)
                this.errors = "Something went wrong, try again"
                this.loading = false;
            })
                
  },
  postVideo:  function() {
    this.loading = true;
              
           this.$http.post('/video', {
                title: this.user, // + '-' + this.user,
                content: this.youtubeurl,
                fields : {
                  youtube_link: this.videoId,
                  merchant_id: this.userId,
                  video_title: this.youtubetitle
                },
                 status: "publish"
                })
        .then(response => {
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                //console.log(response.data.data)
                //this.$router.push({name: 'dashboard', params: { sheet: false }})
                this.updated = !this.updated
                this.color= 'green'
                this.infoBar = true
              this.infoMsg = 'Video successfully saved'
            })
        .catch((e) => {
                console.error(e)
                this.errors = "Something went wrong, try again"
                this.loading = false;
            })
                
  }
  },
  computed: {
      ...mapState({
      registerMsg:'registerMsg',
      user:'user',
      userFiles: 'userFiles',
      userId: 'userId'
      }),
    /* disabled() {
       //if (this.imageFile.length < 1 || this.title == ' '){
         if (this.images == [] && this.title == ''){
         return true
       }
       return false
        
    }, */
    /*dateFunction() {
   
            var currentDate = new Date();
            console.log(currentDate);
            var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
            console.log(currentDateWithFormat);
            return currentDateWithFormat
     
    }*/
    },
     watch: {
       youtubeurl(val){
          this.getId(val);
       },
       loading(val){
         console.log("loading...", val)
         return val
       },
       madetoorder(val){
         if(val == true){
           this.stock = 0
           this.disableStock = !this.disableStock
         }
       },
       images(val){
         if(val.length > 0){
           this.disabled=false
         }
         return
       },
       title(val){
if(val != ''){
           this.disabled=false
         }
         return
       }
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
    .border-right{
      border-right:1px dotted teal;
    }
    .imgBox .image-container{
      width:100%;
      height:250px;
    }
    .imgBox .preview-image{
      height:180px;
    }
    .imgBox .image-list{
      border: 1px solid rgba(178, 223, 219, 0.54) !important;
      background-color: rgba(224, 242, 241, 0.24)!important;
    }

    .tag-input span.chip {
  background-color:teal !important;
  color: #fff;
  font-size: 1em;
}

.tag-input span.v-chip {
  background-color: teal !important;
  color: #fff;
  font-size:.8em;
  padding-left:7px;
}

.tag-input span.v-chip::before {
    content: "label";
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 20px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
}
.social-btn span{
  border-radius: 50%;
    height: 30px;
    width: 30px;
    display: inline-block;
    background-color: #fff;
    transition: all
}
.social-btn span:hover{
  transform: scale(1.1,1.1);
  cursor:pointer!important;
}
</style>