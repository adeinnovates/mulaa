<template>
    <div class="dashboard fill-height teal lighten-5 pa-1 page">
         <v-container fluid fill-height teal lighten-5>
             <v-layout row wrap equal>
                <v-flex xs12 sm8 md7 pa-5>
                   <!-- <div class="text-center pt-5 mt-3 mb-1">
                        <v-sheet v-if="counted == 1" color="caption red lighten-4 pa-2 rounded my-3" style="color:#000028" elevation="0">
{{userAcctStatus}}
</v-sheet>
<v-sheet v-else color="caption orange lighten-4 pa-2 rounded" style="color:#000028" elevation="0">
your link: {{userURL}}
</v-sheet>
</div>
-->

<v-layout row wrap pt-10>
                       
                           <v-flex xs6 sm6 md3 lg3>
                                <v-chip
                                class="ma-2 teal lighten-4 caption"
                                color=""
                                pill
                                >
                                <!--
                               <v-avatar left>
                                <v-icon class="grey--text text--darken-4" small>
                                    mdi-link
                                    </v-icon>  
                                </v-avatar>-->
                                    Total Clicks 
                                    
                                    <v-avatar right
                                    class="teal darken-1 white--text"
                                    >
                                    {{linkStat.clicks}}
                                     </v-avatar>
                                </v-chip>
                               
                           </v-flex>
                           <v-flex xs6 sm6 md3 lg3>
                                <v-chip
                                class="ma-2 teal lighten-4 caption"
                                color=""
                                pill
                                >
                                
                                    Unique Clicks 
                                    <v-avatar right
                                    class="teal darken-1 white--text"
                                    >
                                    {{linkStat.uniqueClicks}}
                                     </v-avatar>
                                </v-chip>
                           </v-flex>

                          
                    </v-layout>
                    <v-layout row wrap pt-2>
                       
                           <v-flex xs6 sm6 md4 lg4>
                                <v-card
                                color="#000028"
                                dark
                                class=ma-2
                                >
                                <v-card-text class="">
                                <div class="title mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-3 mr-2">
                                    mdi-cart
                                    </v-icon>  
                                    Total Products
                                    </div>
                                <p class="font-weight-bold display-2 white--text">
                                    {{counted}}
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                           <v-flex xs6 sm6 md4 lg4>
                                <v-card
                                color="#000028"
                                dark
                                class=ma-2
                                >
                                <v-card-text class="white--text">
                                <div class="title mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-3 mr-2">
                                    mdi-basket
                                    </v-icon>               
                                    Total Sales
                                </div>
                                <p class="font-weight-bold display-2 white--text">
                                    {{salesCount}}
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                           <v-flex xs6 sm6 md4 lg4 d-none d-sm-none d-md-flex>
                                <v-card
                                color="grey"
                                dark
                                class=ma-2
                                >
                                <v-card-text class="white--text">
                                <div class="title mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-1 mr-2">
                                    mdi-account-check-outline
                                    </v-icon>  
                                    Total Leads
                                </div>
                                <p class="font-weight-bold display-1 white--text">
                                    coming soon
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                    </v-layout>

                   <EmptyState v-if="counted < 1"></EmptyState>
                   <div v-else>
                       <!-- <div class="text-center mt-5 pt-4">
                            <v-sheet color="transparent">Add a new product</v-sheet>
                            <v-spacer></v-spacer>
                            <v-btn class="mx-2 mt-2" fab dark color="teal lighten-3 teal--text">
                                <v-icon dark>mdi-plus</v-icon>
                            </v-btn>
                        </div>-->
                        <AddProduct></AddProduct>

 <p class="overline mb-0">Your Links</p>
                          <div id="links" 
                          class="mb-4 mt-2 pa-3"
                          style="border:3px dotted rgba(178, 223, 219, 0.7);background-color:rgba(178, 223, 219, 0.5);
                          border-radius:4px;"
                          >
                          <v-progress-linear
                            :active=loadinglist
                            indeterminate
                            color="green"
                            ></v-progress-linear>
                          <v-card
                          color="#000028"
                          dark
                          class="mb-2"
                          
                          v-for="link in userLinks.slice(0, 4)" :key="link.linkID"
                          >
                          <v-card-title
                          class="mt-0 subtitle-2 py-3"
                          
                          >

                          {{link.link_title}}
                          <v-spacer></v-spacer>
                         
                          </v-card-title>
                          <v-divider></v-divider>
                         
                            <v-row>
        <v-col
        cols="3"
        class="pa-0 pl-5 pt-1"
        >

                         <!-- <v-chip 
                          :active=chip
                          outlined
                          color="teal"
                          small
                          class=""
                          >
                          10
                          </v-chip>--><!-- 
                            @click="getLinkStat(link.short_link, link.linkID)"
                            -->
                        
                           <v-btn text icon 
                         @click="getLinkStat(link.short_link, link.linkID)"
                          >
                          
 <v-icon right small
                          >
                          mdi-finance
                          </v-icon>
                           </v-btn>
                       
                           

        </v-col>
        <v-spacer></v-spacer>
        <v-col
        cols=""
         class="pa-0"
        >
                          <v-btn text icon
                          @click="editItem(link)"
                          >
                          <v-icon right small
                          >
                          mdi-pencil-outline
                          </v-icon>
                          </v-btn>
                          <v-btn text icon 
                          @click="deleteItem(link)"
                          >
                          <v-icon small right

                          >
                          mdi-delete-forever-outline
                          </v-icon>
                          </v-btn>
        </v-col>
                            </v-row>
                       


<v-dialog
v-model="editLink" overlay-color="teal"  class="extra-round extra" transition="slide-x-reverse-transition"
max-width="390"

>
<v-card>
<v-card-title class="subtitle-1 font-weight-light headlineText teal lighten-5" text-truncate>
  <v-icon left small>
    mdi-dots-vertical
  </v-icon>
  Edit</v-card-title>

<v-card-text>
             
        <v-row>
        <v-col>
      
            <p class="mb-3 mt-2 overline">Update link title</p>

            <v-text-field
            class="teal--text form-field ma-0"
            v-model="editlinkCont.link_title"
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
            x-small
            id=""
            @click="updateLink"
            :loading="loading"
            >
            <span class="caption">
              <v-icon left small>mdi-check-circle-outline</v-icon>
              Save</span>
            </v-btn>

        </v-col>
        </v-row>
</v-card-text>

</v-card>
</v-dialog>
                          </v-card>
                         
<v-overlay 
:value="deleteLink"
:opacity="0.8"
color="red darken-2"
transition="slide-x-reverse-transition"
>
<v-layout row wrap mx-10>
  <v-flex xs10 sm9 md9 lg9>
<div class="caption font-weight-light">Confirm delete</div>
  </v-flex>
 <v-flex xs2 sm3 md3 lg3 text-right>
    <v-btn
    class="mt-n10"
icon
@click="deleteLink = false"
>
<v-icon right>mdi-close</v-icon>
</v-btn>
  </v-flex>
</v-layout>
<div
class="mx-10"
>
<p class="title">{{deletelinkCont.link_title}}</p>

<v-btn color="#000028" 
               class="caption"
               @click="confirmDelete(deletelinkCont)"
               small
                >
                  <v-icon small left>mdi-delete-empty</v-icon>
                  Delete
                </v-btn>
</div>

</v-overlay>

<v-overlay 
:value="showStat"
:opacity="0.8"
color="teal darken-2"
transition="scroll-y-reverse-transition"
>
<v-layout row wrap mx-10>
<v-flex xs10 sm9 md9 lg9>
<div class="caption font-weight-light">Click Count</div>
</v-flex>
<v-flex xs2 sm3 md3 lg3 text-right>
<v-btn
class="mt-n10"
icon
@click="showStat = false; showCount = 0"
>
<v-icon right>mdi-close</v-icon>
</v-btn>
</v-flex>
</v-layout>
<div
class="mx-10"
>
<p class="display-2">{{clickCount}}</p>

</div>

</v-overlay>
</div>
                        <p class="overline mb-0">Your products</p>
                       <v-layout row wrap pt-2 mt-1>
                            <!--<v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> -->
                           <v-flex xs6 sm6 md4 lg4 v-for="product in myproducts.slice(0, 4)" :key="product.productID">
            <v-card flat hover class="text-xs-center ma-2">
              <div v-if="product.hidden == 1" class="hiddenProd">
            <v-chip
            class="ma-2 point"
            color="red"
            label
            x-small
            text-color="white"
            >
            <v-icon x-small left>mdi-close</v-icon>
            hidden
            </v-chip>
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="1.75"
         ></v-img>
              </v-responsive>
              <v-card-text class="pb-0">
                <div class="subheading text-truncate">
           
 {{product.title}}
                </div>
                <div class="grey--text text-truncate small"> {{product.description}}</div>
              </v-card-text>
              <v-card-actions>
               <!-- <v-btn text color="#23d2aa" :to="{name:'product',params: {
                    id: product.id
                  }}">
                  <v-icon small left>mdi-square-edit-outline</v-icon>
                  
                </v-btn>-->
                <Editor :theproducts="product"></Editor>
                <v-spacer></v-spacer>
                <div class="grey--text small"> ₦{{product.price}}</div>
              </v-card-actions>
              </div>
              
               <div v-else class="visibleProd">
                  <v-chip
                  class="ml-5 mt-4 point"
                  color="white"
                  text-color="grey darken-1"
                  small
                  >
                  <v-avatar
                  left
                  class="ml-n4 grey lighten-4"
                  small
                  >
                  {{product.pageView}}
                  </v-avatar>
                  <v-icon small color="grey lighten-2">mdi-eye</v-icon>
                  </v-chip>
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="1.75"
         ></v-img>
              </v-responsive>
              <v-card-text class="pb-0">
                <div class="subheading text-truncate">
                  {{product.title}}
                </div>
                <div class="grey--text text-truncate small"> {{product.description}}</div>
              </v-card-text>
              <v-card-actions>
               <!-- <v-btn text color="#23d2aa" :to="{name:'product',params: {
                    id: product.id
                  }}">
                  <v-icon small left>mdi-square-edit-outline</v-icon>
                  
                </v-btn>-->
                <Editor :theproducts="product"></Editor>
                <v-spacer></v-spacer>
                <div class="grey--text small mr-2"> ₦{{product.price}}</div>
              </v-card-actions>
              </div>

              </v-card>
        </v-flex>
                       </v-layout>
                       <MoreBtn></MoreBtn>
                   </div>
                </v-flex>
                <!--
                <v-flex sm1>
                    <v-divider
      class="mx-0"
      vertical
    ></v-divider>
                </v-flex>
                -->
                 <v-flex pa-5 d-none d-sm-none d-md-flex class="border-left">
                  
                     <div class="pt-5 mt-5 pl-10">
                       <p class="caption small">
                         My store link preview: 
                         <v-chip
      class="ma-1 teal lighten-4"
    >
      {{userURL}}
    </v-chip>
              

                       </p>
                        <vue-friendly-iframe :src="previewUrl"></vue-friendly-iframe>
                     </div>
                    
                </v-flex>
             </v-layout>
         </v-container>

      <v-bottom-sheet v-model="sheet" class="teal--text text--lighten-3">
      <v-sheet class="text-center" height="270px" style="background-color:#000028 !important;border-top-left-radius:25px;border-top-right-radius:25px;">
      <!--<v-progress-linear
      :value="50"
      class="my-0"
      height="3"
      ></v-progress-linear>
      -->

      <!--<v-btn
      class="mt-2"
      text
      color="red"
      @click="sheet = !sheet"
      >X</v-btn>-->
 <div class="pa-3">
   <p class="text-center teal--text text--lighten-3 pt-2">
      Congrats {{this.user}},
        <br>
        You just uploaded a product for sale, well done! <br>
        Before this becomes open for customers to buy, complete your profile to sell better with mulaa  
        <v-btn
        ripple
        small
      class="my-2"
      color="teal"
      to="/onboard"
      >Update Profile</v-btn>
<v-img :src="require('../assets/winner.svg')"></v-img>
      </p>
   </div>
      
      </v-sheet>
      </v-bottom-sheet>

    </div>
</template>

<script>
import EmptyState from '@/components/EmptyProducts'
import MoreBtn from '@/components/MoreBtn'
import AddProduct from '@/components/AddProduct'
import Editor from '@/components/Editor'
import anime from 'animejs';
import axios from 'axios'

import { mapState, mapGetters } from 'vuex'

export default {
    props: ['theproducts'],
    components: {
        EmptyState,
        MoreBtn,
        AddProduct,
        Editor,

  },
    data(){
        return{
          showStat: false,
          clickCount: 0,
          showCount: 0,
          loadinglist: true,
          updated: false,
          editlinkCont:{
            hidden:'',
            image: '',
            linkID: '',
            link_title: '',
            long_link: '',
            short_link: '',
            theAuthor: '',
            title: ''
          },
          deletelinkCont:{
            hidden:'',
            image: '',
            linkID: '',
            link_title: '',
            long_link: '',
            short_link: '',
            theAuthor: '',
            title: ''
          },
          //editlinkdesc: '',
          //thepost: this.editlinkCont.linkID || '',
          editLink:false,
          deleteLink:false,
          popWelcome: this.$route.params.popWelcome || false,
          sheet: this.$route.params.sheet || false,
            copySucceeded: null,
            userURL: 'https://mulaa.me/u/'+this.$store.state.user,
            previewUrl:'https://shop.mulaa.co/u/'+this.$store.state.user,
            slides: 5,
    active: 1,
            dialog: false,
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            uploadMsg: '',
            infoBar: false,
            infoMsg: '', 
            products: '',
            previewStore: this.userURL,
            nurules: {
          required: value => !!value || 'Required.',
          min: v => v.length >= 6 || 'Min 6 characters',
          price: v => v.length >= 4 || 'Min 1000',
          url: v => /^[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)+$/.test(v)|| 'Valid URL required'
        }
        }
    },
    created() {
      this.fetchUserData()

      /*
        const script = document.createElement('script')
        script.src = 'https://shop.mulaa.co/Initonesignal.js'
        document.getElementsByTagName('head')[0].appendChild(script)
        */
      //console.log('created')
        return this.fetchData()
        
    },
    /* watch: {
    // call again the method if the route changes
    '$route': 'fetchData'
     },*/
    methods: {
      getLinkStat(val, evt){
        const url = val.substring(val.lastIndexOf('/') + 1)
        const apiUrl = 'https://mulaa.me/u/api/details?key=P1fjdH02F3y2&alias='+url
        //this.showCount = 100 //url
        axios.get(`${apiUrl}`)
        .then(resp => { 
          //console.log(resp.data.data)
          this.showStat = true
          this.showCount = resp.data.data.clicks
         // return
          //resolve(resp)
        })
        .catch(err => {
          
          console.log(err)
          //reject(err)
        })
        //console.log(this.showCount);
        //this.showStat = true
        //console.log(evt)
        //this.chip = true
       // return this.link
      },
      setCount (val) {
      const obj = { n: this.clickCount }
      anime({
        targets: obj,
        n: val,
        round: 1,
        duration: 500,
        easing: 'linear',
        update: () => {
          this.clickCount = obj.n
        }
      })
    },
      updateLink(){
        //console.log(this.editlinkCont.linkID)
this.loading = true;
                
                this.$http.post('/link/'+this.editlinkCont.linkID, {
                title: this.editlinkCont.link_title,
                content: this.editlinkCont.link_title,
                fields : {
                link_title: this.editlinkCont.link_title,
                },
                 status: "publish"
            }).then(response => {
                this.loading = false;
                //this.clear()
                //this.loadProducts()
                //console.log(response.data)
                this.editLink = false
                //this.thelinks = ''
                this.updated = !this.updated
                //this.$store.dispatch('loadDashboardLinks', this.user)
                //this.color = 'green lighten-1'
               // this.infoBar = true
              //this.infoMsg = '🤗 Product Successfully updated'
            
            })
            .catch((e) => {
                this.loading = false;
                //console.error(e)
                //this.color = 'red darken-1'
               // this.infoBar = true
              //this.infoMsg = 'Error updating your product, try again'
                //this.infoBar = true
              //this.infoMsg = 'profile update failed, try again later'
            })
            
      },
       editItem(item) {
          //this.editedIndex = this.desserts.indexOf(item)
          //this.editedItem = Object.assign({}, item)
          this.editLink = true
          this.editlinkCont = item
          //console.log(item)
        },
        deleteItem(item) {
          //this.editedIndex = this.desserts.indexOf(item)
          //this.editedItem = Object.assign({}, item)
          this.deleteLink = true
          this.deletelinkCont = item
          //console.log(item)
        },
        confirmDelete(val){
            //console.log(val.linkID)
             this.$http.delete('/link/'+val.linkID).then(response => {
               this.updated = !this.updated
                this.deleteLink = false
                //console.log(response.data)
                //this.$store.dispatch('loadDashboardLinks', this.user)
                //this.color = 'green lighten-1'
               // this.infoBar = true
              //this.infoMsg = '🤗 Product Successfully updated'
            })
            .catch((e) => {
                
                console.error(e)
                //this.color = 'red darken-1'
               // this.infoBar = true
              //this.infoMsg = 'Error updating your product, try again'
                //this.infoBar = true
              //this.infoMsg = 'profile update failed, try again later'
            })
        },
      linkData(){
        if(linkStat.length>0){
          //console.log(linkStat)
return linkStat;
        }
return 0;
      },
      fetchUserData(){
        this.$store.dispatch('loadUserDetails', this.user)
        //console.log('fetch userDetails')
    },
        handleCopyStatus(status) {
      this.copySucceeded = status
    },
    move(amount) {
      let newActive
      const newIndex = this.active + amount
      if (newIndex > this.slides) newActive = 1
      if (newIndex === 0) newActive = this.slides
      this.active = newActive || newIndex
    },
    jump(index) {
      this.active = index
    },
    fetchData(){
        //this.$store.dispatch('loadAllProducts', 'top')
         this.$store.dispatch('loadUserSales', this.user)
         this.$store.dispatch('loadUserDetails', this.user)
         this.$store.dispatch('loadDashboardProducts', this.user)
          this.$store.dispatch('linkStats', this.user)
          this.$store.dispatch('loadDashboardLinks', this.user)
         
       // this.$store.dispatch('getUser', this.user)
       //this.reload()
    }
    
  },
  mounted(){
      //this.$store.dispatch('loadUserProducts', this.user)
    },
  computed: {
        ...mapGetters([
             'renderUser'
           ]),
      ...mapState({
      registerMsg:'registerMsg',
      color:'color',
      show:'show',
      loading:'loading',
      user: 'user',
      allProducts: 'allProducts',
      myproducts:'myproducts',
      Discounted:'Discounted',
      userPhone: 'userPhone',
       userDetails: 'userDetails',
       userAcctStatus: 'userAcctStatus',
       userProducts:'userProducts',
       linkStat: 'linkStat',
       userLinks: 'userLinks',
       filteredLinks:'filteredLinks'
      }),
    userSales: {
      get() {
        return this.$store.state.userSales;
      },
      set(value) {
        this.$store.commit('user_sales', value);
      }
    },
    snackbar: {
      get() {
        return this.$store.state.snackbar;
      },
      set(value) {
        this.$store.commit('snackbar', value);
      }
    },
    loading: {
      get() {
        return this.$store.state.loading;
      },
      set(value) {
        this.$store.commit('loading', value);
      }
    },
    thelinks: {
      get() {
        return this.$store.state.userLinks;
      },
      set(value) {
        this.$store.commit('userLinks', value);
      }
    },
    currentUserProd: {
      get(value) {
        //return this.$store.state.userProducts;
        return this.$store.state.myproducts;
      },
      set(value) {
        this.$store.commit('loadDashboardProducts', value);
      }
    },
     currentUserDetail: {
      get() {
        return this.$store.state.userDetails;
      },
      set(value) {
        this.$store.commit('loadUserDetails', value);
      }
    },
    counted : function () {
        //return Object.keys(this.userProducts).length;
        return Object.keys(this.myproducts).length;
    },
    countApproved: function () {
        return Object.keys(this.approved).length;
    },
    salesCount: function(){
      return Object.keys(this.userSales).length;
    },
    /*hiddenProd: function(){
      return
    }*/
    },
    watch: {
      '$route': 'fetchData',
      counted(newVal, oldVal){
          if(newVal == 1){
            return this.sheet = true
          }
      },
      updated(val){
         this.$store.dispatch('loadDashboardLinks', this.user)
      },
      userLinks(val){
          if(val != ''){
            this.loadinglist = false
          }else if(val == ''){
            setInterval(() =>{ 
              this.loadinglist = false
              console.log('link empty')
            }, 10000);
          }
            
          
      },
      dialog(){
        this.$store.dispatch('loadDashboardProducts', this.user)
      },
      showCount (val) {
      this.setCount(val)
    }
    }
}
</script>
<style>
.border-left{
  border-left:1px dashed #4DB6AC;
  background-color: #80CBC4!important;
}
.hotGrad{
  background: #f857a6;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #ff5858, #f857a6);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #ff5858, #f857a6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.hotGrad2{
  background: #e43a15;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #e65245, #e43a15);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #e65245, #e43a15); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.calmGrad{
  background: #5f2c82;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #49a09d, #5f2c82);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #49a09d, #5f2c82); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.calmGrad2{
  background: #24C6DC;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #514A9D, #24C6DC);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #514A9D, #24C6DC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
.v-application .teal.lighten-5{
  background-image: url('~@/assets/bg-wrap.png') !important;
}
.theme--light.v-text-field--outlined fieldset {
    border-color: rgba(178, 223, 219, 0.54) !important;
}
.img-inputer.img-inputer--light, .img-inputer.img-inputer--{
  border-color: rgba(178, 223, 219, 0.54) !important;
  background-color:rgba(224, 242, 241, 0.24)!important;
}
.vue-friendly-iframe{
  padding:6em 2em;
  background-color:#B2DFDB;
  max-width: 380px;
    border-radius: 25px;
}
.vue-friendly-iframe iframe{
  border:0;
  height: 530px;
  display:block;
margin: 0 auto;
}
.teal-bg{
  background-color:#B2DFDB;
}
.small{
  font-size: 11px !important;
}
.hiddenProd{
    border-bottom: 2px solid red;
    filter: alpha(opacity=80);
  /* Modern Browsers */
  opacity: 0.8;
}
.visibleProd{
opacity: 1;
}
.visibleProd .point{
position: absolute;
  z-index:2;
}
.hiddenProd .point{
  position: absolute;
  z-index:9999;
}
.hiddenProd::before {   /* Added */
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color:transparent;
  transition: 0.5s;
}
    .headlineText{
        color: #000028;
    }
    .equal{
        height: 100%;
    }
    .equal>div{
        flex:1;
        flex-direction: column;
    }


.prev,
.next {
  position: absolute;
  top: 50%;
  width: 50px;
  height: 50px;
  border: 2px solid #221e21;
  color: #221e21;
  border-radius: 50%;
  margin-top: -25px;
  margin-left: 25px;
  cursor: pointer;
  line-height: 48px;
  text-align: center;
  text-indent: -2px;
  transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.prev:hover,
.next:hover {
  background: #221e21;
  color: #fff;
  transform: scale(1.2);
}
.prev:active,
.next:active {
  transform: translate(0, 3px) scale(1.2);
}

.next {
  right: 0;
  margin-left: auto;
  margin-right: 25px;
  text-indent: 2px;
}

.dots {
  position: fixed;
  display: block;
  width: 100%;
  text-align: center;
  bottom: 20px;
}
.dots li {
  width: 6px;
  height: 6px;
  border-radius: 3px;
  background: #221e21;
  opacity: 0.2;
  display: inline-block;
  margin: 0 3px;
  cursor: pointer;
  transition: opacity 0.4s ease-in-out, width 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.dots li.active {
  width: 22px;
  opacity: 1;
}
.slides {
  display: flex;
  /*height: 100%;*/
  align-items: center;
  justify-content: center;
  font-weight: bold;
}

.slides .animated {
  transition: all 400ms;
  position: absolute;
  transform: translate(-50%, -50%);
}
.slides .slide-in {
  opacity: 0;
  transform: translate(-40%, -50%);
}
.slides .slide-in-active {
  transition-delay: 150ms;
}
.slides .slide-out {
  opacity: 1;
}
.slides .slide-out-active {
  opacity: 0;
  transform: translate(-60%, -50%);
}

.v-input--selection-controls.v-input .v-label,
.v-textarea.v-text-field--enclosed.v-text-field--outlined .v-label,
.theme--light.v-input:not(.v-input--is-disabled) input
{
  font-size:12px;
}
</style>