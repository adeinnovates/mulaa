<template>
    <v-dialog v-model="dialog" max-width="454" class="extra-round extra">
        <template v-slot:activator="{ on }">
   <v-btn text color="#23d2aa" value="addimage" v-on="on">
     <span class="caption small">edit</span> <v-icon small left>mdi-square-edit-outline</v-icon>
    </v-btn>
        </template>

            <v-card
            max-width="454"
            class="mx-auto"
            >
          
<v-form
      ref="editForm"
      class="pa-4"
    >
           
              <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#000028">{{infoMsg}}</span>
  <!--<v-btn flat color="white" @click="snackbar = false">close</v-btn>-->
</v-snackbar>
            <v-card-title><span class="caption teal--text">Update: {{this.title}}</span></v-card-title>
            <v-card-text>
                <p>
                Edit details about your product // {{this.hidethis}}
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
        <v-row>
          <v-col>
<v-switch 
        v-model="discountEnable" 
        label="Enable Discount?" 
        class="mt-0"
        color="#23d2aa"
        >
        </v-switch>
          </v-col>
          <v-col>
<v-switch 
        v-model="hidethis" 
        label="hide?" 
        class="mt-0"
        color="#23d2aa"
        >
        </v-switch>
          </v-col>
        </v-row>
         
            </v-card-text>
           
            </v-form>
             <v-card-actions style=background-color:#000028>
            <v-btn text color="green" @click="editProduct" :loading="loading">
              <v-icon right-3 color="green" class="mr-2">mdi-check</v-icon>
             Save
              </v-btn>
               <v-btn text color="teal lighten-3" @click="dialog = false">
              <v-icon right-3 color="teal lighten-3" class="mr-2">mdi-cancel</v-icon>
             Cancel
              </v-btn>
            </v-card-actions>
            </v-card>
            
    </v-dialog>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
export default {
     props: ['theproducts'],
 data(){
        return{
            description: this.theproducts.description,
            title: this.theproducts.title,
            dialog: false,
            loading: false,
            infoBar: false,
            thepost: this.theproducts.productID,
            price: this.theproducts.price,
            discount: this.theproducts.discount_price,
            discountEnable:this.theproducts.show_discount,
            deliveryLocations: '',
            hidethis: this.theproducts.hidden,
        infoMsg: '', 
        color: '',
        urlRules: [
        v => /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/.test(v) || 'Url must be valid'
      ]
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
    editProduct:  function() {
                this.loading = true;
                
                this.$http.put('/product/'+this.thepost, {
                title: this.user +'-'+ this.title,
                content: this.description,
                fields : {
                description: this.description,
                price: this.price,
                discount_price: this.discount,
                show_discount: this.discountEnable,
                delivery_locations: this.deliveryLocations,
                image: this.imgUrl,
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
              this.infoMsg = '🤗 Product Successfully updated'
            
            })
            .catch((e) => {
                this.loading = false;
                console.error(e)
                this.color = 'red darken-1'
                this.infoBar = true
              this.infoMsg = 'Error updating your product, try again'
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
       if (this.imageFile.length < 1 || this.brand == ''){
         return true
       }
       return false
        //return this.imageFile.length < 1; // or === 0   
    }
    }  
}
</script>

<style>
    .img-inputer.img-inputer--light, .img-inputer.img-inputer--{
        width:300px;
        height:310px;
        border: 1px solid #F1E4E4;
    }
    .extra-round{
    border-radius: 10px
}
.extra-round.extra{
    border-radius: 25px;
}
</style>