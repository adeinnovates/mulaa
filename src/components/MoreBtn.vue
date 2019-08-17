<template>
  <v-card
    flat
    class="transparent"
  >
    <v-card-text>
      <v-row
        align="center"
        justify="center"
      >
        <v-btn-toggle
         
         class="teal lighten-3"
          rounded
        
        >
          <v-btn>
            <v-icon class="mr-2 teal--text">mdi-basket</v-icon>
            <span class="caption pa-2 teal--text">all sales</span>
          </v-btn>
          <v-btn>
            <v-icon class="mr-2 teal--text">mdi-cart</v-icon>
            <span class="caption pa-2 teal--text">all products</span>
          </v-btn>
        </v-btn-toggle>
      </v-row>
    </v-card-text>
  </v-card>
</template>