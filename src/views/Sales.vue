<template>
    <div class="sales fill-height teal lighten-5">
        <v-container class="my-1">
      <v-layout row wrap>
         <v-flex xs12 sm8 md8 lg8 mt-5 pa-5>
<div class="headline font-weight-light my-5">
 <span class="teal--text">Sales Records</span>
</div>

 <v-layout row wrap px-1 py-0 mt-n3>
                       
                           <v-flex xs6 sm6 md4 lg4>
                                <v-card
                                color="#000028"
                                dark
                                class=ma-2
                                >
                                <v-card-text class="">
                                <div class="title mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon small class="teal--text text--lighten-3 mr-2 d-block">
                                    mdi-cart
                                    </v-icon>  
                                    Total Sales Value
                                    </div>
                                <p class="font-weight-bold title white--text">
                                    {{totalValue | currency}}
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
                                    <v-icon small class="teal--text text--lighten-3 mr-2 d-block">
                                    mdi-basket
                                    </v-icon>               
                                    Total Items Sold
                                </div>
                                <p class="font-weight-bold title white--text">
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
                                <div class="headline mb-2 teal--text text--lighten-3 font-weight-light">
                                    <v-icon class="teal--text text--lighten-1 mr-2">
                                    mdi-account-check-outline
                                    </v-icon>  
                                    Total Leads
                                </div>
                                <p class="font-weight-bold headline white--text">
                                    coming soon
                                </p>
                                </v-card-text>
                                </v-card>
                           </v-flex>
                    </v-layout>
  <v-row>
                       <v-col>
                         <div class="pa-5 teal lighten-4 mb-2" style="border-radius:10px">
                         <v-text-field
                         v-model="search"
                         :clearable=true
                         color="teal lighten-3 teal--text"
            label="Search"
            placeholder="Search Product Name, Customer Name or Price"
            prepend-inner-icon="mdi-magnify"
          >
          </v-text-field>
                         </div>
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

<v-btn text color="#23d2aa" 
class="caption"
@click="processJson()"
>
<v-icon small left>mdi-download</v-icon>
Download
<!--Buy-->
</v-btn>

   <v-simple-table fixed-header height="300px" class="pa-4" elevation="3">
    <thead>
      <tr>
        <th class="text-left">Ref Id</th>
        <th class="text-left">Amount</th>
         <th class="text-left">SKU</th>
         <th class="text-left">Product Purchased</th>
        <th class="text-left">Fullname</th>
        <th class="text-left">Phone</th>
        <th class="text-left">Email</th>
        <th class="text-left">Status</th>
        <th class="text-left">Message</th>
        <th class="text-left">Delivery</th>
        <th class="text-left">Date</th>
        
         <th class="text-left">Others</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in filteredSales" :key="item.refid">
        <td class="caption">{{ item.refID }}</td>
        <td class="caption">{{ item.acf.amount | currency }}</td>
        <td class="caption">{{ item.acf.product_id }}</td>
        <td class="caption">{{ item.acf.product}}</td>
        <td class="caption">{{ item.acf.fullname }}</td>
        <td class="caption">{{ item.acf.customer_phone}}</td>
        <td class="caption">{{ item.acf.customer_email }}</td>
        <td class="caption">{{ item.acf.status }}</td>
        <td class="caption">{{ item.acf.message }}</td>
         <td class="caption">{{ item.acf.location }}</td>
         <td class="caption">{{ item.date }}</td>
          <td class="caption">{{ item.acf.others }}</td>
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
        return mysale.acf.product.match(this.search) || mysale.acf.fullname.match(this.search) || mysale.acf.amount.match(this.search) || mysale.acf.ref_id.match(this.search) || mysale.acf.product_id.match(this.search)
      })
    },
    totalValue: function(){

  let total = [];

  Object.entries(this.userSales).forEach(([key, val]) => {
      total.push(val.acf.amount) // the value of the current key.
  });

  return total.reduce(function(totall, num){ 
    //console.log(typeof num)
    return totall + Number(num)
    }, 0);

},
 salesCount: function(){
      return Object.keys(this.userSales).length;
    }
    },
     created() {
        this.fetchData()
        //console.log('user: '+ this.name)
    },
methods: {
  processJson(){
    const itemsFormatted = [];

    const headers = {
    id: 'id'.replace(/,/g, ''), // remove commas to avoid errors
    title: "Title",
    description: "Description",
    availability: "Availability",
    condition: "Condition",
    price: "Price".replace(/,/g, ''),
};

// format the data

this.userSales.forEach((item) => {
    itemsFormatted.push({
    id: item.id,
    title: item.acf.transaction,
    description: item.acf.product,
    availability: item.acf.customer_phone,
    condition: item.acf.fullname,
    price: item.acf.amount.replace(/,/g, ''),
        
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