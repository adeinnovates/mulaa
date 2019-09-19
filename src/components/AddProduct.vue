<template>
    <v-dialog v-model="dialog" max-width="700px" class="extra-round extra">
        <template v-slot:activator="{ on }">
            <v-responsive style="margin-top:-30px;">

                <div class="text-center my-5 pt-4 mb-3">
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
     class="mx-auto teal lighten-5"
            >
             <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#1A227E">{{infoMsg}}</span>
</v-snackbar>

 <v-card-title>
     <span class="headline font-weight-light headlineText">
         Create a product
         </span>
         </v-card-title>
         <p class="teal--text mb-5 px-7 caption">
                    Tap the image uploader to select a photo from your phone, enter the product name below
                </p>
<v-container class="white lighten-5">

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
            />
             </v-card-text>
        </v-col>
        
        <v-col class="pt-0">
          
<v-form
      ref="uploadForm"
    >
            <v-card-text class="pt-0">
                
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
          v-model="description"
          outlined
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
            type="number"
            outlined
            color="teal lighten-3"
          ></v-text-field>
            </v-col>
            <v-col>
<v-text-field
           class="teal--text form-field ma-0"
            v-model="discount"
            label="discount"
            type="number"
            placeholder="discount price"
            outlined
            color="teal lighten-3"
          ></v-text-field>
            </v-col>

        </v-row>

        <v-switch 
        v-model="discountEnable" 
        label="Show Discount?" 
        class="mt-0"
        color="#23d2aa"
        >
        </v-switch>
            </v-card-text>
            </v-form>
        </v-col>
         
    </v-row>
</v-container>
<v-card-actions style=background-color:#000028>
    <v-tooltip top>
        <template v-slot:activator="{ on }">
            <v-btn text color="white" @click="postProduct" :disabled=disabled :loading="loading" v-on="on">
              <v-icon right-3 color="teal lighten-3" class="mr-2">mdi-check</v-icon>
             Save
              </v-btn>
               </template>
      <span>Save this product</span>
    </v-tooltip>
               <v-btn text color="teal lighten-3" @click="dialog = false" v-if="infoBar = false">
              <v-icon right-3 color="teal lighten-3" class="mr-2">mdi-close-circle</v-icon>
             Cancel
              </v-btn>
              <v-btn text color="teal lighten-3" @click="dialog = false" v-else>
              <v-icon right-3 color="teal lighten-3" class="mr-2">mdi-close-circle</v-icon>
             Close
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
        color: '',
        date: this.dateFunction(),
        owner: this.$store.state.userId
        }
    },
    methods: {
      dateFunction() {
   
            var currentDate = new Date();
            console.log(currentDate);
            var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
            console.log(currentDateWithFormat);
            return currentDateWithFormat
     
        },
        fetchData(){
          this.$store.dispatch('loadUserProducts', this.user)
          this.$store.dispatch('loadAllProducts', 'top')
       // this.$store.dispatch('getUser', this.user)
    },
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
                date_posted: this.date
                },
                 status: "publish"
            }).then((response) => {
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                console.log(response)
                //this.$store.dispatch('loadAllProducts', 'top')
                this.$store.dispatch('loadUserProducts', this.user)
                this.color = 'green lighten-1'
                this.infoBar = true
              this.infoMsg = 'Product Successfully saved'
              this.fetchData()
            this.resetForm()
            return
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