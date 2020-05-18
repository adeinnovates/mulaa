<template>
    <div class="digital fill-height teal lighten-5">
       
       <v-content>
  <v-container fluid pa-1>
    <v-layout row wrap align-center="align-center" justify-center="justify-center" pa-5>
      <v-flex xs12 sm4 id="sign-in-text-wrapper" text-xs-center px-5>
        <v-card
    max-width="454"
    class="mx-auto extra-round pa-4"
    elevation=10
    light="light"
    :loading="loading" 
  >
<v-list-item three-line>
      <v-list-item-content>
        <div class="overline mb-4">{{downloadLink.date}}</div>
        <v-list-item-title class="headline mb-1">{{downloadLink.product}}</v-list-item-title>
        <v-list-item-subtitle v-if="isLoaded"></v-list-item-subtitle>
      </v-list-item-content>
</v-list-item>
<v-card-text v-if="isLoaded">
  <p>
    Please click the button below to download the product. <span class="red--text">This download is available within the next {{downloadLink.days}} days. Once clicked, the link expires</span>
  </p>
  <!--<v-sheet color="caption blue lighten-5 pa-4 rounded ma-5" style="color:#000028" elevation="0">
                            Welcome {{downloadLink.id}} 
                        </v-sheet> -->
<v-btn large block color="success" dark @click="onClick()">
  <v-icon right dark class="mr-4">mdi-cloud-download</v-icon>
  Click to Download
  </v-btn>


<v-progress-linear
            color="green accent-3"
            indeterminate
            :active=gettingFile
            rounded
            height="6"
            class="mt-5"
          ></v-progress-linear>

</v-card-text>
<v-card-text v-else>
<p class="text-left red--text font-weight-bold">Link already used <br> or file not found</p>
</v-card-text>
        </v-card>
        <v-row justify="center" class="mb-10"> 
           <p class="caption text--grey my-5" style="margin: 0 auto">
             
powered by <a href="https://mulaa.co/?utm_source=footer&utm_medium=download-page" target="_blank"><img :src="require('../assets/mulaalogo.png')" alt="" style="max-width:70px;margin-left:5px">
         </a>  </p>
        
       </v-row>
      </v-flex>
    </v-layout>
  </v-container>
       </v-content>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'
//import Downloader from 'js-file-downloader';
//import fileDownload from 'js-file-download'


export default {
    data(){
        return{
          isLoaded: false,
            loading: null,
            customer: null,
            downloadingPercentage:0,
            gettingFile: false,
        }
    },
    computed: {
      ...mapState({
      userKey:'userKey',
      theProduct:'theProduct',
      downloadLink: 'downloadLink'
      }),
    },
     watch: {
    downloadLink(val){
      if(val.status){
            this.isLoaded = true
            console.log('val ', val)
          }else{
            this.isLoaded = false
          }
          console.log('val ', val)
    },
     },
    methods: {
        fetchData(){
        this.$store.dispatch('loadDownload', this.$route.query.key).then(() => {
          
          
                console.log('done ', this.downloadLink)
                //return
                })
        //this.$store.dispatch('loadUserDetails', this.nname)
        //console.log("download key: "+this.$route.query.key) // this.$route.query.key
    },
    onClick() {
        this.gettingFile = true
              axios({
                    url: 'https://file.io/'+this.downloadLink.id,
                    method: 'GET',
                    responseType: 'blob',
                }).then((response) => {
                     var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                     var fileLink = document.createElement('a');

                     fileLink.href = fileURL;
                     fileLink.setAttribute('download', 'file.pdf');
                     document.body.appendChild(fileLink);

                     fileLink.click();
                     this.gettingFile = false
                }).catch(err => {
              console.log(err)
              this.isLoaded = false;
              //this.infoBar = true
              //this.infoMsg = 'profile image failed, try again'
            //reject(err)
          });
                
               /*
                function process (event) {
  if (!event.lengthComputable) return; // guard
  this.downloadingPercentage = Math.floor(event.loaded / event.total * 100);
  // what to do ...
 
};
               const fileUrl = 'https://file.io/'+this.downloadLink.id;
               new Downloader({ 
    url: fileUrl,
    process: process
  })
  .then(function () {
    // Called when download ended
  })
  .catch(function (error) {
    // Called when an error occurred
  });
  */

          }
    },
    created() {
this.fetchData()
    }
}
</script>