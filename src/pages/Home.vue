<template>
<i class="fa fa-home">Hello</i>
<h1>Home Page</h1>


           <p class="h3 text-success fw-bold">Show Contact
               <router-link to="/showContact" class="btn btn-success btn-sm"> <i class="fa fa-plus-circle"></i> Show Contact</router-link> 
            </p>

<form v-on:submit.prevent="addContact">
    <input required v-model="contact.name" type="text" class="form-control" placeholder="name"> <br>

    <input required v-model="contact.photo" type="text" class="form-control" placeholder="photo"> <br>

    <input required v-model="contact.email" type="email" class="form-control" placeholder="Email"><br>

    <input required v-model="contact.mobile" type="number" class="form-control" placeholder="Mobile"><br>

    <input required v-model="contact.company" type="text" class="form-control" placeholder="Company"> <br>

    <input required v-model="contact.title" type="text" class="form-control" placeholder="Title"><br>

    <input type="submit" class="btn btn-success" value="Create">

</form>
</template>

<script>
// import axios from "axios";
import $ from 'jquery';

export default {
    name: "Home",

    data: function () {
        return {
            contact: {
                name: '',
                photo: '',
                email: '',
                mobile: '',
                company: '',
                title: '',
                data:  ''

            },
            mydata: ''

        }
    },

      methods:{
        addContact(){
          const that = this;

          console.log(ajax_url.ajaxurl);
          $.ajax({
            type: "POST",
            url: ajax_url.ajaxurl,
            dataType: 'json',
            data: {
                action: "vwp_insert_contact_table",
                name: this.contact.name,
                photo: this.contact.photo,
                email: this.contact.email,
                mobile: this.contact.mobile,
                company: this.contact.company,
                title: this.contact.title
            },
            success: function(data) {
                //that.allLists = data.data;
                that.mydata = data.data;
                console.log(data);
            }
            });
      }
    }

    }


</script>

<style>
</style>
