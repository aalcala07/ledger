/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap')
 const axios = require('axios').default
 // const moment = require('moment-timezone').default
 
 
 window.Vue = require('vue').default
 
 
 Vue.component('dashboard-card', require('./components/DashboardCard.vue').default)
 Vue.component('options-dropdown', require('./components/OptionsDropdown.vue').default)
 
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 const url = document.querySelector('meta[name=url]').getAttribute('content')
 const path = document.querySelector('meta[name=path]').getAttribute('content')
 
 const app = new Vue({
     el: '#app',
     data: {
        //  timezone: moment.tz.guess(),
         bus: new Vue(),
         url: url,
         path: path
     },
     methods: {
         getPath(path) {
             return this.url + '/' + (this.path ? this.path + '/' : '') + path
         }
     }
 })
 