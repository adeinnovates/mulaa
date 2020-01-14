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
  <span style="color:#fff">{{infoMsg}}</span>
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
        <v-col>
             <v-card-text class="pt-0">
             <p class="mb-3 mt-2 overline">upload product image</p>
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
             </v-card-text>
        </v-col>
        
        <v-col class="pt-0">
          

            <v-card-text class="py-0">
                
           <v-text-field
           class="teal--text form-field mt-3"
            v-model="title"
            label="title"
            placeholder="product name"
            outlined
            color="teal lighten-3"
            :rules="[nurules.required]"
          ></v-text-field>
          <v-textarea
          class="teal--text form-field my-0"
          v-model="description"
          outlined
          label="Description"
        
          color="teal lighten-3"
        ></v-textarea>

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
          ></v-text-field>
            </v-col>

        </v-row>
         <v-row>
            <v-col>
<v-text-field
           class="teal--text form-field ma-0"
            v-model="stock"
            label="Available in Stock"
            placeholder="Total Stock"
            type="number"
            prepend-inner-icon="mdi-counter"
            outlined
            color="teal lighten-3"
            :disabled=disableStock
            
          ></v-text-field>
            </v-col>
            <v-col>
                <v-switch 
                v-model="madetoorder" 
                label="custom-made ?" 
                class="mt-5"
                color="#23d2aa"
                inset
                >
                </v-switch>
            </v-col>

        </v-row>

        <v-switch 
        v-model="discountEnable" 
        label="Show Discount?" 
        class="mt-0"
        color="#23d2aa"
        inset
        >
        </v-switch>
            </v-card-text>
           
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
            Youtube video embed link, coming soon.
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
       
    </v-dialog>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'
//import EmojiPicker from 'vue-emoji-picker'

export default {
    data(){
        return{
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
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            nurules: {
          required: value => !!value || 'Required.',
          min: v => v.length >= 6 || 'Min 6 characters',
          price: v => v.length >= 4 || 'Min 1000',
          url: v => /^[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)+$/.test(v)|| 'Valid URL required'
        },
            imgUrl: '',
            uploadMsg: '',
            infoBar: false,
        infoMsg: '', 
        color: '',
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
    methods: {
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
          this.$store.dispatch('loadDashboardProducts', this.user)
          this.$store.dispatch('loadAllProducts', 'top')
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
                this.$http.post('/product', {
                title: this.title, // + '-' + this.user,
                content: this.description,
                fields : {
                  title: this.title,
                description: this.description,
                price: this.price,
                discount_price: this.discount,
                show_discount: this.discountEnable,
                delivery_locations: this.deliveryLocations,
                image: this.imgUrl,
                owner : this.owner,
                date_posted: this.date,
                product_options: JSON.stringify(this.options),
                stock: this.stock,
                madetoorder: this.madetoorder
                },
                 status: "publish"
                }).then((response) => {
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                //console.log(response)
                //this.$store.dispatch('loadAllProducts', 'top')
                this.$store.dispatch('loadDashboardProducts', this.user)
                this.color = 'green lighten-1'
                this.infoBar = true
              this.infoMsg = 'Product Successfully saved'
              this.fetchData()
            this.resetForm()
           // dialog = false
            //return
            })
            .catch((e) => {
                this.loading = false;
                console.error(e)
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
                
  }
  },
  computed: {
      ...mapState({
      registerMsg:'registerMsg',
      user:'user'
      }),
     disabled() {
       if (this.imageFile.length < 1 || this.title == ' '){
         return true
       }
       return false
        //return this.imageFile.length < 1; // or === 0   
    },
    /*dateFunction() {
   
            var currentDate = new Date();
            console.log(currentDate);
            var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
            console.log(currentDateWithFormat);
            return currentDateWithFormat
     
    }*/
    },
     watch: {
       madetoorder(val){
         if(val == true){
           this.stock = 0
           this.disableStock = !this.disableStock
         }
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
</style>