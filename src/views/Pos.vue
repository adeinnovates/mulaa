<template>
    <div class="pos fill-height teal lighten-5">
        <v-container mt-10 pt-10>
             <v-row>
                 <v-col cols="12" md=8>
                      <v-card 
                    class="mx-auto"
                    elevation="0"
                    >
                     <v-card-title>
                         <v-container>
                              <v-row>
                 <v-col cols="12" md=7>
 <div class="headline font-weight-light headlineText my-10">
    <v-icon class="grey--text text--darken-4" small left>
                                    mdi-google-analytics
                                    </v-icon>  
                   POS Sales Records
                    </div>
                 </v-col>
                 <v-col cols="12" md=5>
                        <v-text-field
                        v-model="search"
                        :clearable=true
                        color="teal lighten-3 teal--text"
                        label="Search"
                        placeholder="Search Product Name, Customer Name or Price"
                        prepend-inner-icon="mdi-magnify"
                        >
                        </v-text-field>
                 </v-col>
                    </v-row>
                         </v-container>
                    
                    </v-card-title>
                      </v-card>


                    <v-simple-table fixed-header height="300px" class="pa-0 mt-5" elevation="3">
    <thead>
      <tr>
          <th class="text-left">Mulaa Code</th>
           <th class="text-left">Date</th>
            <th class="text-left">Amount</th>
             <th class="text-left"><strong>Status</strong></th>
         <th class="text-left">POS No.</th>
         <th class="text-left">Sold to</th>
        <th class="text-left">Fullname</th>
        
         <th class="text-left">Ref Id</th>
       <th class="text-left">Message</th>
         <th class="text-left">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in filteredSales" :key="item.refid" :class="`pa-2 ${item.acf.status}`">
           <td :class="`caption ${item.acf.status}`">{{ item.slug }}</td>
           <td class="caption">{{ item.date }}</td>
            <td class="caption">{{ item.acf.amount | currency }}</td>
             <td class="caption"><strong :class="`${item.acf.status}-text`">{{ item.acf.status }}</strong></td>
       
        <td class="caption">{{ item.acf.pos_no}}</td>
        <td class="caption">{{ item.acf.customer_phone}}</td>
        <td class="caption">{{ item.acf.fullname }}</td>
       
        <td :class="`caption ${item.acf.status}`">{{ item.refID }}</td>
        <td class="caption">{{ item.acf.message }}</td>
         
        
          <td class="caption">{{ item.acf.others }}</td>
      </tr>
    </tbody>
  </v-simple-table>
                 </v-col>

                 <v-col cols="12" md="4">
                     
                     <div class="white fill-height pa-5">
                         <v-offline
  online-class="online"
  offline-class="offline"
  @detected-condition="amIOnline"
  class="mt-n5 mr-n5 ml-n5"
  >
  <template v-slot:[onlineSlot] :slot-name="onlineSlot">
    <p class="pa-1 overline"> System Online : <strong>{{onLine}} </strong></p> 
  </template>
  <template v-slot:[offlineSlot] :slot-name="offlineSlot">
   <span class="pa-5 overline">
        System Offline
        </span>
  </template>
</v-offline>

                    
<div class="headline font-weight-light headlineText my-10">
    <v-icon class="grey--text text--darken-4" small left>
                                    mdi-cash-register
                                    </v-icon>  
                   Generate Payment Code
                    </div>

                     <v-expand-transition>
      <div v-show="show">
        <v-sheet color="caption blue lighten-5 pa-4 rounded ma-5 text-center" style="color:#000028" elevation="0">
                     <v-progress-linear
                            :active=true
                            indeterminate
                            color="green"
                            ></v-progress-linear>
                            Make transfer of {{amount}} to {{mulaaCode}}
                        </v-sheet>
      </div>
    </v-expand-transition>
                    <v-form>
                       <v-container>
                           <v-card
    class="mx-auto"
    flat
  >

  <v-card-text>

<v-row>
                                <v-col cols="12" sm="12" md="12" class="my-1 py-0">
                                    <v-text-field
                                    label="Customer"
                                     outlined
            color="teal lighten-3"
            placeholder="Customer Phone Number"
            class="my-1"
            :rules="[nurules.required, nurules.min, nurules.numbs]"
            :error-messages="errors"
                                    prepend-inner-icon="mdi-cellphone-iphone"
                                    v-model="customerPhone"
                                    ></v-text-field>
                                </v-col>
                            
                           </v-row>
                           <v-row>
                               <v-col cols="12" sm="12" md="12" class="my-1 py-0">
                                <v-text-field
                                    label="Amount"
                                     outlined
                                     placeholder="Total Amount"
                                     class="my-2"
                                     v-model="amount"
                                     :rules="[nurules.required, nurules.numbs]"
            color="teal lighten-3"
                                    prepend-inner-icon="mdi-cash"
                                    ></v-text-field>
                           </v-col>
                           </v-row>

<v-row>
                               <v-col cols="12" sm="12" md="12" class="my-1 py-0">
                                <v-text-field
                                    label="POS Number"
                                    outlined
                                    class="my-1"
                                    placeholder="Transaction ID"
                                    color="teal lighten-3"
                                    v-model="posnumber"
                                    :rules="[nurules.required, nurules.numbs]"
                                    prepend-inner-icon="mdi-counter"
                                    ></v-text-field>
                           </v-col>
                           </v-row>
  </v-card-text>

<div v-if="onLine">

<v-card-actions>
      <v-btn block color="green" dark
                                large class=""
                                :loading="loading"
                                @click="getMulaaCode"
                                >Get Mulaa Code</v-btn>

    </v-card-actions>
</div>
<div v-else>
    
<v-card-actions>
      <v-btn block color="red" dark
                                large class=""
                                disabled
                                >Get Mulaa Code (offline)</v-btn>

    </v-card-actions>
</div>
                           </v-card>
                           
                       </v-container>
                   </v-form>
                    </div>
                 </v-col>
             </v-row>

        </v-container>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'
import VOffline from 'v-offline';

export default {
  components: {
VOffline
  },
     data(){
        return{
            mulaaCode: '',
            search: '',
            errors:[],
show: false,
onLine: null,
    onlineSlot: 'online',
    offlineSlot: 'offline',
    posnumber: '',
    customerPhone: '',
    amount: '',
    posSales:[],
    nurules: {
      numbs: value => /^[0-9]+$/.test(value) || 'numbers only',
          required: value => !!value || 'Required.',
          min: v => v.length >= 10 || 'Min 10 characters',
          emailMatch: () => ('The email and password you entered don\'t match'),
        }
        }
     },
     computed: {
      ...mapState({
      user:'user',
      loading:'loading',
       userId: 'userId',
       userDetails:'userDetails',
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
        return mysale.slug.match(this.search) || mysale.acf.amount.match(this.search) || mysale.acf.customer_phone.match(this.search)|| mysale.acf.status.match(this.search)
      })
    },
},
created() {
      this.fetchData()
 },
 methods: {
     amIOnline(e) {
      this.onLine = e;
    },
     fetchData(){
        //this.$store.dispatch('loadAllProducts', 'top')
         this.$store.dispatch('loadUserSales', this.user)
         this.$store.dispatch('loadUserDetails', this.user)
         /*this.$store.dispatch('loadDashboardProducts', this.user).then(resp => {
console.log('current prod')
//return this.currentUserProd
         }
         )*/
     },
     getMulaaCode:  function() {
         this.loading = true
         let posData = {
              user: this.userId,
              posnumber: this.posnumber,
                phone: this.customerPhone,
                }

         axios.get('http://shop.mulaa.co/api/wp-json/mulaa-auth/v1/pos', { //http://dev.mulaa.africa/admin/wp-json/mulaa-auth/v1/pos
    params:posData})
                .then(resp => {
                    console.log(resp.data)
                    this.show = true
                    this.mulaaCode = resp.data
                    this.loading = false
                }).catch((e) => {
                console.error(e)
                this.loading = false
                //this.errors = "Something went wrong, try again"
                //this.loading = false;
            })
     },

  processJson(){
    const itemsFormatted = [];

    const headers = {
    //ref: 'Ref'.replace(/,/g, ''), // remove commas to avoid errors
    amount: "Amount".replace(/,/g, ''),
    sku: "Sku",
    status: "Status",
    product: "Product",
    fullname: "Full name",
    delivery: "Delivery".replace(/,/g, ''),
    date: "Date",
    email: "Email",
    phone: "Phone",

};

// format the data

this.userSales.forEach((item) => {
    itemsFormatted.push({
    //id: item.id,
    amount: item.acf.amount.replace(/,/g, ''),
    sku: item.acf.product_id,
    status: item.acf.status,
    product: item.acf.product,
    fullname: item.acf.fullname,
    delivery: item.acf.location,
    date: item.date,
    email: item.acf.customer_email,
    phone: item.acf.customer_phone
    });
});
console.log(itemsFormatted)
const fileTitle = 'orders'; // or 'my-unique-title'

return this.exportCSVFile(headers, itemsFormatted, fileTitle);
  },
  convertToCSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';

    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','

            line += array[i][index];
        }

        str += line + '\r\n';
    }

    return str;
},
  exportCSVFile(headers, items, fileTitle) {
    if (headers) {
        items.unshift(headers);
    }

    // Convert Object to JSON
    var jsonObject = JSON.stringify(items);

    var csv = this.convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
},
  csvExport(arrData) {
    console.log(arrData)
      /*
      let csvContent = "data:text/csv;charset=utf-8,";
      csvContent += [
        Object.keys(arrData[0]).join(";"),
        ...arrData.map(item => Object.values(item).join(";"))
      ]
        .join("\n")
        .replace(/(^\[)|(\]$)/gm, "");

      const data = encodeURI(csvContent);
      const link = document.createElement("a");
      link.setAttribute("href", data);
      link.setAttribute("download", "mulaa-"+this.user+"-sheet.csv");
      link.click();
      */
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
.offline {
  background-color: #fc9842;
  background-image: linear-gradient(315deg, #fc9842 0%, #fe5f75 74%);
}
.offline p strong{
    color:#fff;
}
.online {
  background-color: #00b712;
  background-image: linear-gradient(315deg, #00b712 0%, #5aff15 74%);
}
 .Pending{
      border-left:4px solid #EF5350;
    }
    .Successful{
      border-left:4px solid #81C784;
    }
    .Pending-text{
      color: #EF5350;
    }
    .Successful-text{
      color: #81C784;
    }

</style>