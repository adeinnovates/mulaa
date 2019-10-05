<template>
    <v-dialog v-model="dialog" max-width="454" class="extra-round extra">
        <template v-slot:activator="{ on }">
   <v-btn color="#23d2aa" value="addimage" v-on="on" elevation="0">
     <span class="caption">edit </span> <v-icon small right>mdi-square-edit-outline</v-icon>
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
            <v-card-title><span class="caption teal--text">Edit your profile</span></v-card-title>
            <v-card-text>
               
          
          <v-text-field
           class="teal--text form-field mt-3"
            v-model="businessName"
            label="Business"
            placeholder="Business name"
            outlined
            color="teal lighten-3"
          ></v-text-field>
           
<v-text-field
           class="teal--text form-field ma-0"
            v-model="businessDesc"
            label="Business Desc"
            placeholder="Description"
            outlined
            color="teal lighten-3"
          ></v-text-field>

       
<v-text-field
           class="teal--text form-field ma-0"
            v-model="phoneNumber"
            label="Phone"
            placeholder="Phone"
            outlined
            color="teal lighten-3"
          ></v-text-field>
           
                <v-text-field
           class="teal--text form-field mt-3"
            v-model="Instagram"
            label="Instagram"
            placeholder="Instagram"
            outlined
            color="teal lighten-3"
          ></v-text-field>
       
  
        
<v-text-field
           class="teal--text form-field ma-0"
            v-model="BusinessAddress"
            label="Business Address"
            placeholder="Address/Location"
            outlined
            color="teal lighten-3"
          ></v-text-field>
        
<v-text-field
           class="teal--text form-field ma-0"
            v-model="paystackKey"
            label="Payment"
            placeholder="Paystack Key"
            outlined
            color="teal lighten-3"
          ></v-text-field>
       
       
<v-text-field
           class="teal--text form-field ma-0"
            v-model="facebookPixel"
            label="Facebook"
            placeholder="Facebook Pixel"
            outlined
            color="teal lighten-3"
          ></v-text-field>
   
            </v-card-text>
           
            </v-form>
             <v-card-actions style=background-color:#000028>
            <v-btn text color="green" @click="updateUser" :loading="loading">
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
     props: ['theuser','user','userImg'],
 data(){
        return{
            businessName : this.user,
        Instagram: this.theuser.instagram,
        phoneNumber: this.theuser.phone_number,
        BusinessAddress: this.theuser.business_address,
        stateResidence: this.theuser.state,
        Country: this.theuser.country,
        paystackKey: this.theuser.payment_key,
        facebookPixel: this.theuser.facebook_pixel,
        businessDesc: this.theuser.business_description,
        infoMsg: '', 
        infoBar: false,
        dialog: false,
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
    updateUser () {
                this.loading = true;
                //const interestsJson = this.interests
                //console.log(JSON.stringify({ interestsJson }))
                this.$http.post('/users/'+this.userId, {
                title: '',
                content: '',
                fields : {
                /*date_joined: dateFunction,*/
                business_name: this.businessName,
                instagram: this.Instagram,
                email: this.userEmail,
                phone_number: this.phoneNumber,
                business_address: this.BusinessAddress,
                state:this.stateResidence,
                country:this.Country,
                facebook_pixel: this.facebookPixel,
                brand_image: this.userImg,
                business_description: this.businessDesc,
               // last_login: ''//dateFunction() //JSON.stringify({ user })
                },
                 status: "publish"
            }).then((response) => {
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                console.log(response)
                this.$router.push({name: 'settings', params: { infoBar: true, infoMsg: 'Successfully updated' }})
                //console.log(response.data.id)
                //this.profileId = response.data.id
            })
            .catch((e) => {
                this.loading = false;
                console.error(e)
                this.infoBar = true
              this.infoMsg = 'profile update failed, try again later'
            })
  }
  },
  computed: {
      ...mapState({
      userDetails: 'userDetails',
      loading:'loading',
      //user: 'user',
      registerMsg:'registerMsg',
      userId:'userId'
      }),
      loading: {
      get() {
        return this.$store.state.loading;
      },
      set(value) {
        this.$store.commit('loading', value);
      }
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