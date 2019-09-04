<template>
    <div>
        
    </div>
</template>
<script>
import paystack from 'vue-paystack';
export default {
    props: ['paykey'],
    components: {
        paystack
    },
    data(){
        return{
          paystackkey: "pk_test_xxxxxxxxxxxxxxxxxxxxxxx", //paystack public key
          email: "foobar@example.com", // Customer email
          amount: 1000000 // in kobo
        }
    },
    computed: {
      reference(){
        let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
 
        for( let i=0; i < 10; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));
 
        return text;
      }
    },
    methods: {
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

</style>
