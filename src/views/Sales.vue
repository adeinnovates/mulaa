<template>
    <div class="sales fill-height teal lighten-5">
        <v-container class="my-1">
      <v-layout row wrap>
         <v-flex xs12 sm8 md8 lg8 mt-5 pa-5>
<div class="headline font-weight-light my-5">
 <span class="teal--text">Sales Records</span>
</div>
  <v-row>
                       <v-col>
                         <v-text-field
                         v-model="search"
                         :clearable=true
                         color="teal lighten-3 teal--text"
            label="Search"
            placeholder="Search Product Name, Customer Name or Price"
          ></v-text-field>
                       </v-col>
                     </v-row>
  <div>

    <v-card
   color="#000028"
    class="mx-auto"
  >
    <v-card-title class="caption font-weight-light teal--text">sales trend</v-card-title>
    <v-card-text>
      
      <v-sparkline
    :value="value"
    :gradient="gradient"
    :smooth="radius || false"
    :padding="padding"
    :line-width="width"
    :stroke-linecap="lineCap"
    :gradient-direction="gradientDirection"
    :fill="fill"
    :type="type"
    :auto-line-width="autoLineWidth"
    :label-size=3
    auto-draw
  ></v-sparkline>
      
      </v-card-text>
  </v-card>
    
    </div>      

   <v-simple-table fixed-header height="300px" class="pa-4" elevation="3">
    <thead>
      <tr>
        <th class="text-left">Ref Id</th>
        <th class="text-left">Amount</th>
         <th class="text-left">Product Purchased</th>
        <th class="text-left">Fullname</th>
        <th class="text-left">Phone</th>
        <th class="text-left">Email</th>
        <th class="text-left">Status</th>
        <th class="text-left">Message</th>
        <th class="text-left">Date</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in filteredSales" :key="item.refid">
        <td class="caption">{{ item.refID }}</td>
        <td class="caption">{{ item.acf.amount }}</td>
        <td class="caption">{{ item.acf.product}}</td>
        <td class="caption">{{ item.acf.fullname }}</td>
        <td class="caption">{{ item.acf.customer_email }}</td>
        <td class="caption">{{ item.acf.customer_phone}}</td>
        <td class="caption">{{ item.acf.status }}</td>
        <td class="caption">{{ item.acf.message }}</td>
         <td class="caption">{{ item.date }}</td>
      </tr>
    </tbody>
  </v-simple-table>
         </v-flex>
      </v-layout>
        </v-container>
        
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
const gradients = [
    ['#222'],
    ['#42b3f4'],
    ['red', 'orange', 'yellow'],
    ['purple', 'violet'],
    ['#00c6ff', '#F0F', '#FF0'],
    ['#f72047', '#ffd200', '#1feaea'],
  ]
export default {
    data () {
      return {
        width: 2,
      radius: 10,
      padding: 8,
      lineCap: 'round',
      gradient: gradients[5],
      value: [0, 2, 5, 9, 5, 10, 3, 5, 0, 0, 1, 8, 2, 9, 0],
      gradientDirection: 'top',
      gradients,
      fill: false,
      type: 'trend',
      autoLineWidth: false,
      showLabels: true,
        search: '',
        headers: [
          {
            text: 'Product Name',
            align: 'left',
            sortable: false,
            value: 'name',
          },
          ],
         items: [
          {refid:'0234', amount:'55,000',paymentMode:'web',fullName:'Dami Banke', status:'pending',message:'this was a good transaction',date:'04/12/19'},
          {refid:'0235', amount:'55,000',paymentMode:'web',fullName:'Dami Banke', status:'pending',message:'this was a good transaction',date:'04/12/19'},
          {refid:'0236', amount:'55,000',paymentMode:'web',fullName:'Dami Banke', status:'pending',message:'this was a good transaction',date:'04/12/19'},
          {refid:'0237', amount:'55,000',paymentMode:'web',fullName:'Dami Banke', status:'pending',message:'this was a good transaction',date:'04/12/19'},
          {refid:'0238', amount:'55,000',paymentMode:'web',fullName:'Dami Banke', status:'pending',message:'this was a good transaction',date:'04/12/19'},
        ]
      }
},
    computed: {
      ...mapState({
      registerMsg:'registerMsg',
      loading:'loading',
      userKey:'userKey',
      theProduct:'theProduct',
      user: 'user'
      }),
      loading: {
      get() {
        return this.$store.state.loading;
      },
      set(value) {
        this.$store.commit('loading', value);
      }
    },
    userSales: {
      get() {
        return this.$store.state.userSales;
      },
      set(value) {
        this.$store.commit('user_sales', value);
      }
    },
    filteredSales: function(){
      return this.userSales.filter((mysale) => {
        return mysale.acf.product.match(this.search) || mysale.acf.fullname.match(this.search) || mysale.acf.amount.match(this.search) || mysale.acf.ref_id.match(this.search)
      })
    }
    },
     created() {
        this.fetchData()
        //console.log('user: '+ this.name)
    },
methods: {
  fetchData(){
        this.$store.dispatch('loadUserSales', this.user)
        //console.log(this.user)
       // this.$store.dispatch('loadUserDetails', this.name)
        //console.log("product id: "+this.$route.params.id)
    },
    dateFunction() {
   
            var currentDate = new Date();
            console.log(currentDate);
            var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
            console.log(currentDateWithFormat);
            return currentDateWithFormat
     
        }
}
}
</script>
<style>
    
</style>