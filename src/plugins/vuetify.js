import Vue from 'vue';
import Vuetify from 'vuetify/lib';

export default new Vuetify({
  icons: {
    iconfont: 'mdi',
    theme: {
      themes: {
        light: {
      primary: '#000028',
      success: '#BEE890',
      info: '#FFFBFB',
      error: '#FF5252',
      secondary: '#23d2aa',
      text: '#c1c1ff'
        },
      },
    },
  },
});

Vue.use(Vuetify);
