<template>
    <div class="sales fill-height teal lighten-5">
        <v-container class="my-1">
      <v-layout row wrap>
         <v-flex xs12 sm8 md8 lg8 mt-5 pa-5>
<div class="headline font-weight-light my-5">
 <span class="teal--text">Sales</span>
</div>

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

   <v-simple-table fixed-header height="300px" class="pa-4">
    <thead>
      <tr>
        <th class="text-left">Ref Id</th>
        <th class="text-left">Amount</th>
        <th class="text-left">Payment mode</th>
        <th class="text-left">Fullname</th>
        <th class="text-left">Status</th>
        <th class="text-left">Message</th>
        <th class="text-left">Date</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.refid">
        <td class="caption">{{ item.refid }}</td>
        <td class="caption">{{ item.amount }}</td>
        <td class="caption">{{ item.paymentMode }}</td>
        <td class="caption">{{ item.fullName }}</td>
        <td class="caption">{{ item.status }}</td>
        <td class="caption">{{ item.message }}</td>
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
}
}
</script>
<style>
    
</style>