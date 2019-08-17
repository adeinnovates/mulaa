<template>
    <v-dialog v-model="dialog" max-width="700px" class="extra-round extra">
        <template v-slot:activator="{ on }">
            <v-responsive style="margin-top:-30px;">

                <div class="text-center my-5 pt-4">
                                <v-sheet color="transparent" class="caption">Add a new product</v-sheet>
                                <v-spacer></v-spacer>
                                <v-btn class="mx-2 mt-2" 
                                fab 
                                dark 
                                color="teal lighten-3 teal--text" 
                                v-on="on"
                                >
                                    <v-icon dark>mdi-plus</v-icon>
                                </v-btn>
                </div>

            </v-responsive>
        </template>

 <v-card
            
            class="mx-auto"
            >
             <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#1A227E">{{infoMsg}}</span>
</v-snackbar>
<v-container class="grey lighten-5">

    <v-row>
        <v-col>
          
<v-form
      ref="uploadForm"
    >
            <v-card-title><span class="display-1 font-weight-light headlineText">Create a product</span></v-card-title>
            <v-card-text>
                <p class="teal--text mb-5">
                    Tap the icon above to upload a photo from your phone, enter the product name below
                </p>
           <v-text-field
           class="teal--text form-field mt-3"
            v-model="title"
            label="title"
            placeholder="product name"
            outlined
            color="teal lighten-3"
          ></v-text-field>
          <v-textarea
          class="teal--text form-field mt-0"
          outlined
          v-model="description"
          label="Description"
          value="Aditional product details and benefits"
          color="teal lighten-3"
        ></v-textarea>

        <v-row>
            <v-col>
<v-text-field
           class="teal--text form-field ma-0"
            v-model="price"
            label="price"
            placeholder="base price"
            outlined
            color="teal lighten-3"
          ></v-text-field>
            </v-col>
            <v-col>
<v-text-field
           class="teal--text form-field ma-0"
            v-model="discount"
            label="discount"
            placeholder="discount price"
            outlined
            color="teal lighten-3"
          ></v-text-field>
            </v-col>

        </v-row>

        <v-switch v-model="discountEnable" label="Enable Discount?" class="mt-0"></v-switch>
            </v-card-text>
            </v-form>
        </v-col>
         <v-col>
             <p class="mb-3 mt-5 overline">upload product image</p>
  <img-inputer accept="image/*" 
            v-model="imageFile"
            icon="img"
            upload-key="product" 
            auto-upload 
            theme="light"
            no-mask
            :capture=true
            action="//dev.mulaa.co/imgapi/products.php" 
            :on-error="onErr"
            :on-success="onSuc"
            bottom-text="Drop file here or tap to add one"
            @reset = "reset"
            />
        </v-col>
    </v-row>
</v-container>
<v-card-actions>
    <v-tooltip top>
        <template v-slot:activator="{ on }">
            <v-btn text color="green" @click="postProduct" :disabled=disabled :loading="loading" v-on="on">
              <v-icon right-3 color="green" class="mr-2">mdi-check</v-icon>
             Save
              </v-btn>
               </template>
      <span>Save this product</span>
    </v-tooltip>
               <v-btn text color="red lighten-3" @click="dialog = false">
              <v-icon right-3 color="red lighten-3" class="mr-2">mdi-cancel</v-icon>
             Cancel
              </v-btn>
            </v-card-actions>
 </v-card>
       
    </v-dialog>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
export default {
    data(){
        return{
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
            imgUrl: '',
            uploadMsg: '',
            infoBar: false,
        infoMsg: '', 
        color: ''
        }
    },
    methods: {
      resetForm () {
        this.$refs.uploadForm.reset()
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
    postProduct:  function() {
                this.loading = true;
                this.$http.post('/product', {
                title: this.user +'-'+ this.title,
                content: this.user,
                fields : {
                image: this.imgUrl,
                brand_name:this.title,
                post_url: ''
                },
                 status: "publish"
            }).then((response) => {
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                console.log(response)
                this.$store.dispatch('loadAllProducts', 'top')
                this.color = 'green lighten-1'
                this.infoBar = true
              this.infoMsg = 'Product Successfully saved'
            this.resetForm()
            })
            .catch((e) => {
                this.loading = false;
                console.error(e)
                this.color = 'red darken-1'
                this.infoBar = true
              this.infoMsg = 'Error saving your product'
                //this.infoBar = true
              //this.infoMsg = 'profile update failed, try again later'
            })
  }
  },
  computed: {
      ...mapState([
      'registerMsg',
      'user'
    ]),
     disabled() {
       if (this.imageFile.length < 1 || this.title == ' '){
         return true
       }
       return false
        //return this.imageFile.length < 1; // or === 0   
    }
    } 
}
</script>
<style>
    .headlineText{
        color: #000028;
    }
     .img-inputer.img-inputer--light, .img-inputer.img-inputer--{
        width:300px;
        height:310px;
        border: 1px solid #B2DFDB;
    }
</style>