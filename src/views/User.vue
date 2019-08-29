<template>
    <div class="userpage products fill-height teal lighten-5">
        <v-container>
        <h2>{{$route.params.name}}</h2>
        <v-layout row wrap pt-2 mt-1>
                            <v-progress-linear
                            :active=loading
                            indeterminate
                            color="green"
                            ></v-progress-linear> 
                           <v-flex xs6 sm6 md4 lg4 v-for="product in filteredProducts" :key="product.id">
            <v-card flat hover class="text-xs-center ma-2">
              <v-responsive class="pt-0">
                <v-img
          :src="product.image"
          aspect-ratio="1.15"
         ></v-img>
              </v-responsive>
              <!--<v-card-text>
                <div class="subheading text-truncate">
                  {{product.title.rendered}}
                </div>
                <div class="grey--text text-truncate"> {{product.acf.description}}</div>
              </v-card-text>-->
              <v-card-actions>
               <v-btn text color="#23d2aa" 
               class="caption"
                >
                  <v-icon small left>mdi-cart</v-icon>
                  Buy
                </v-btn>
               
                <v-spacer></v-spacer>
                <div class="grey--text"> ₦{{product.acf.price}}</div>
              </v-card-actions>
              </v-card>
        </v-flex>
                       </v-layout>
        </v-container>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
export default {
     data(){
        return{
            search:'',
            userdata: this.$route.params.name,
            dialog: false,
            rules: [v => v.length <= 50 || 'Max 50 characters'],
            uploadMsg: '',
            infoBar: false,
            infoMsg: '', 
            products: '',
        }
    },
    computed: {
        ...mapGetters([
             'renderUser'
           ]),
      ...mapState([
      'registerMsg',
      'color',
      'show',
      'loading',
      'user',
      'allProducts',
      'myproducts',
      'Discounted',
      'userUrl'
    ]),
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
    filteredProducts: function(){
      return this.myproducts.filter((myproduct) => {
        return myproduct.title.rendered.match(this.search) || myproduct.acf.price.match(this.search)
      })
    }
    },
     created() {
        this.fetchData()
        console.log(this.$route)
    },
    methods: {
    fetchData(){
        this.$store.dispatch('loadUserProducts', this.userdata)
       // this.$store.dispatch('getUser', this.user)
    }
    
  }
    
}
</script>