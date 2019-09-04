<template>
    <v-dialog transition="slide-x-transition" fullscreen hide-overlay v-model="dialog" max-width="454" class="extra-round extra">
        <template v-slot:activator="{ on }">
            <v-btn text color="#23d2aa"  
               class="caption"
               v-on="on"
                >
                  <v-icon small left>mdi-cart</v-icon>
                  Buy
                </v-btn>
        </template>

            <v-card
            max-width="454"
            class="mx-auto"
            >
          
<v-form
      ref="editForm"
      class="pa-0"
    >
           
 <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#1A227E">{{infoMsg}}</span>
  <!--<v-btn flat color="white" @click="snackbar = false">close</v-btn>-->
</v-snackbar>
<v-row align="center" justify="center">
                    <v-img
                    :src="image"
                    lazy-src="https://picsum.photos/id/11/10/6"
                    aspect-ratio="1"
                    class="grey lighten-2 mb-1"
                    max-width="500"
                    max-height="300"
                    ></v-img>
</v-row>
            <v-card-title>
                <span class="headline dark-body-text font-weight-light mb-2">
                {{this.title}}
                </span></v-card-title>
            <v-card-text>
            
          
<div class="px-4">
        <v-row>
        <v-col
        class=col-7
        >
        <p class="caption dark-body-text font-weight-light mb-0">
        <span class="font-weight-bold">
        Description
        </span> <br>
        {{description}}
        </p>
        </v-col>
        <v-col
        class=col-5
        >
        <p class="headline font-weight-light mb-0">
        ₦{{price}}
        </p>

        </v-col>
        </v-row>  
<v-divider class="mt-1 mb-0"></v-divider>
    <v-row
      class="my-1"
      align="center"
    >
      <strong class="mx-3 font-weight-light teal--text">
        Complete your order
      </strong>

      <v-divider vertical></v-divider>

      <div class="flex-grow-1"></div>

      <v-progress-circular
        :value="progress"
        class="mr-2"
      ></v-progress-circular>
    </v-row>

    <v-divider class="mb-1"></v-divider>

       
                <v-row>
                <v-col>
                <v-text-field
                class="teal--text form-field ma-0 pa-0"
                v-model="buyerName"

                placeholder="Full Name"
                color="teal lighten-3"
                ></v-text-field>
                </v-col>
                <v-col>
                <v-text-field
                class="teal--text form-field ma-0 pa-0"
                v-model="buyerPhone"

                placeholder="Mobile"
                color="teal lighten-3"
                ></v-text-field>
                </v-col>
                </v-row>
                <v-row>
                <v-col>
                <v-text-field
                class="teal--text form-field ma-0 pa-0"
                v-model="buyerEmail"

                placeholder="Your Email"
                color="teal lighten-3"
                ></v-text-field>
                </v-col>
                </v-row>
        

          <paystack
        :amount="amount"
        :email="buyerEmail"
        :paystackkey="userKey"
        :reference="reference"
        :callback="callback"
        :close="close"
        :embed="false"
    >
       <i class="fas fa-money-bill-alt"></i>
       Make Payment
    </paystack>

    </div>
         <!--
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
            v-model="discounted"
            label="discount"
            placeholder="discount price"
            outlined
            color="teal lighten-3"
          ></v-text-field>
            </v-col>

        </v-row>
        -->
         
            </v-card-text>
           
            </v-form>
             <v-card-actions class="grad-bg">
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
import paystack from 'vue-paystack';
export default {
     props: ['theproducts'],
     components: {
        paystack
    },
 data(){
        return{
progress: 10,
           title: this.theproducts.title.rendered,
           dialog: false,
            infoBar: false,
            hidethis: this.theproducts.acf.hidden, 
            datePosted: this.theproducts.acf.date_posted,
            delivery:this.theproducts.acf.delivery_locations,
            description:this.theproducts.acf.description,
            discountPrice:this.theproducts.acf.discount_price,
            image: this.theproducts.acf.image,
            price: this.theproducts.acf.price,
            discounted: this.theproducts.acf.show_discount,
            buyerName: '',
            buyerEmail: '',
            buyerPhone: '',
        infoMsg: '', 
        color: '',
       emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ]
        }
    },
    computed: {
      ...mapState({
      registerMsg:'registerMsg',
      loading:'loading',
      userKey:'userKey'
      }),
     disabled() {
       if (this.imageFile.length < 1 || this.brand == ''){
         return true
       }
       return false
        //return this.imageFile.length < 1; // or === 0   
    },
    reference(){
        let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
 
        for( let i=0; i < 10; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));
 
        return text;
      },
      amount(){
          if(this.discounted != true){
              let amount = this.price * 100
              console.log('amount: '+ amount)
              return amount
          }else {
              let sale = this.discountPrice * 100
              return sale
          }
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
              this.infoMsg = '🤗 Boom Successfully updated'
            
            })
            .catch((e) => {
                this.loading = false;
                console.error(e)
                this.color = 'red darken-1'
                this.infoBar = true
              this.infoMsg = 'Error updating your boom, try again'
                //this.infoBar = true
              //this.infoMsg = 'profile update failed, try again later'
            })
  },
  callback: function(response){
        console.log(response)
      },
      close: function(){
          console.log("Payment closed")
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
.dark-body-text{
    color:#000028
}
.grad-bg{
    background: #23d2aa;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #000028, #23d2aa);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #000028, #23d2aa); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}

.grad-bg2{
    background: #00FFA1;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #00FFA1 , #00FFFF);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #00FFA1, #00FFFF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
</style>