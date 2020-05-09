<template>
     <div class="digital fill-height teal lighten-5 pa-1 page">
         <v-container mt-10 pt-10>
             <v-row>
                 <v-col cols="12" md=8>
                    <v-card 
                    class="mx-auto teal lighten-4 mb-0"
                    elevation="0"
                    >
                    <v-card-title>
                    <div class="headline font-weight-light headlineText text-center">
                    Upload a digital file (pdf) for download
                    </div>
                    </v-card-title>
<v-container class="white lighten-5 mb-0">
                    <v-card-text class="text--primary">
                         <v-snackbar v-model=infoBar :timeout="10000" top right :color="color" :value=infoMsg>
  <span style="color:#000028">{{infoMsg}}</span>
</v-snackbar>
                    <v-sheet color="caption blue lighten-5 pa-4 rounded ma-5" style="color:#000028" elevation="0">
                            All your digital/downloadable files are stored and secured here. Your uploads ill be available in the "add product" section when you are creating a new product for your store. 
                        </v-sheet>
                    

                    <div class="mt-5">
<v-text-field
            label="Name/Title"
            placeholder="Title for this file"
            outlined
            color="teal lighten-3"
            prepend-icon="mdi-card-text"
            v-model="download_title"
          ></v-text-field>
<v-file-input
small-chips
label="Select and upload file from your device"
accept=".pdf"
show-size
color="teal lighten-3"
counter
prepend-icon="mdi-file-upload"
outlined
@change="onFileChanged"
v-model="eproductFile"
:rules="fileRule"
class="caption"
>
</v-file-input>
<p class="title teal--text">Below is a sample message sent to your customer after payment is made for your digital product, <strong>edit or write a new message below</strong></p>
<vue-editor v-model="content" :editorToolbar="customToolbar"></vue-editor>
<v-overlay
:value="overlay"
dark
:z-index="9999">
<v-progress-circular :value="this.progressValue"></v-progress-circular>
</v-overlay>
              
              <!--upload digital media-->
              <v-btn block color="green" dark
              large class="mt-10"
              :loading="loading3"
      
      @click="saveFile"
              >Save File</v-btn>
                    </div>
                    </v-card-text>
</v-container>

                    </v-card>

                 </v-col>
                 <v-col cols="12" md="4">

<!-- table -->
<div class="headline font-weight-light headlineText my-10">
    <v-icon class="grey--text text--darken-4" small left>
                                    mdi-link
                                    </v-icon>  
                   Your Files
                    </div>
                    <v-simple-table mt-5 v-if="userFiles.length">
                    <template v-slot:default>
                    <thead>
                    <tr>
                    <th class="text-left">File Name</th>
                    <th class="text-left">Date Uploaded</th>
                    <th class="text-left">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in userFiles" :key="item.id">
                    <td class="caption">{{ item.title }}</td>
                    <td class="caption">{{ item.date }}</td>
                    <td>
                      <router-link to="products" class="caption">Use in product</router-link></td>
                    </tr>
                    </tbody>
                    </template>
                    </v-simple-table>

                     <v-simple-table mt-5 v-else>
                    <template v-slot:default>
                    
                    <tbody>
                   
                   <v-sheet color="caption blue lighten-5 pa-4 rounded ma-5 text-center" style="color:#000028" elevation="0">
                     <v-progress-linear
                            :active=true
                            indeterminate
                            color="green"
                            ></v-progress-linear>
                            You don't have any files uploaded yet or we are unable to retrieve your assets list (please check your internet connection)
                        </v-sheet>
                   
                    </tbody>
                    </template>
                    </v-simple-table>
                 </v-col>
             </v-row>
         </v-container>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'
import { VueEditor } from "vue2-editor";

export default {
  components: {
    VueEditor
  },
     data(){
        return{
          content: "<p>Thank you for your purchase.</p><p>This automatically qualifies you to access our private group/webinar. Please confirm your access by pasting the link below in your browser:</p><p>[Enter link here]</p><p><strong>Also Important:</strong> If you've paid for more than one course/product, you will be sent more than one link. Please click on all the links provided to get access to everything you paid for.</p><br><br><p>Best wishes,<br> [Your name]</p>",
      customToolbar: [["bold", "italic", "underline"], [{ list: "ordered" }, { list: "bullet" }], [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
[{ 'header': 1 }, { 'header': 2 }, { 'header': 3 }]],
            color: null,
            download_title:'',
            loading3: false,
            progressValue:'',
            overlay: false,
            infoBar:false,
            infoMsg:false,
eproduct:null,
            eproductFile:null,
          eproductFileName:null,
          eproductLink:'',
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
      
        }
},
 created() {
      this.fetchData()
 },
methods: {
     fetchData(){
        this.$store.dispatch('loadUserFiles', this.user)   
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
    //axios.post(`//dev.mulaa.co/imgapi/files.php`, formData, {
       axios.post(`//shop.mulaa.co/imgapi/files.php`, formData, {
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

  saveFile:  function() {
      //console.log(JSON.stringify(this.options))
                this.loading3 = true;
                console.log(this.user)
                //return
                this.$http.post('/file/', {
                title: this.download_title, // + '-' + this.user,
                content: '',
                fields : {
                file_path: this.eproductFileName,
                merchant: this.user, 
                email_content: this.content,
                merchant_id: this.userId
                },
                 status: "publish"
                }).then((response) => {
                this.loading3 = false;
                console.log("the file", response)
                //this.clear()
                
                this.color = 'green lighten-1'
                this.infoBar = true
              this.infoMsg = 'File Successfully Saved, proceed to add this product to your store for purchase'
              this.fetchData()
              //this.fetchData()
            //this.resetForm()
            
            //return
            })
            .catch((e) => {
                this.loading3 = false;
                console.error('Error saving your product - ', e)
                this.color = 'red darken-1'
                this.infoBar = true
              this.infoMsg = 'Error saving your product'
              return
                //this.infoBar = true
              //this.infoMsg = 'profile update failed, try again later'
            })
  },
},
computed: {
      ...mapState({
      user:'user',
      loading:'loading',
       userFiles: 'userFiles',
       userId: 'userId'
      }),
}
}
</script>
<style>
.ql-container,.ql-snow{
  border-color: rgba(178, 223, 219, 0.54) !important;
}
</style>