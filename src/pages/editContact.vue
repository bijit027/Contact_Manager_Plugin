<template>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <p class="h3 text-success fw-bold">Edit Contact</p>
            <p class="fst-italic">It is a long established fact that a reader will be
                by the readable content of a page when looking at its layout. The point
                of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it
                look like readable English. Many desktop publishing packages and web
            </p>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <form @submit.prevent="editCreate()">
                <div class="mb-2">
                    <input required v-model="contact.name" type="text" class="form-control" placeholder="name">
                </div>
                <div class="mb-2">
                    <input required v-model="contact.photo" type="text" class="form-control" placeholder="Photo URL">
                </div>
                <div class="mb-2">
                    <input required v-model="contact.email" type="email" class="form-control" placeholder="Email">
                </div>
                <div class="mb-2">
                    <input required v-model="contact.mobile" type="number" class="form-control" placeholder="Mobile">
                </div>
                <div class="mb-2">
                    <input required v-model="contact.company" type="text" class="form-control" placeholder="Company">
                </div>
                <div class="mb-2">
                    <input required v-model="contact.title" type="text" class="form-control" placeholder="Title">
                </div>
                <div class="mb-2">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>
            </form>

            <div class="col-md-4">
                <img :src="contact.photo" alt="" class="contact-img">
            </div>

        </div>
    </div>
</div>
</template>

<script>
import $ from 'jquery';
export default {
    name: 'EditContact',

    data: function () {
        return {
            contactId: this.$route.params.contactId,
            contact: {

                name: '',
                photo: '',
                email: '',
                mobile: '',
                company: '',
                title: '',
                data: ''

            },
            contacts: [],
            mydata: ''

        }
    },

    created: function () {
        const that = this;
        $.ajax({
            type: "POST",
            url: ajax_url.ajaxurl,
            dataType: 'json',
            data: {
                action: "vwp_get_single_data",
                id: that.contactId
            },
            success: function (data) {
                that.contact = data.data[0];
            }
        });
    },

    methods: {
        editCreate() {
            const that = this;
            console.log(ajax_url.ajaxurl);
            $.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "vwp_update_contact_list",
                    id: that.contactId,
                    name: that.contact.name,
                    photo: that.contact.photo,
                    email: that.contact.email,
                    mobile: that.contact.mobile,
                    company: that.contact.company,
                    title: that.contact.title
                },
                success: function (data) {
                    that.mydata = data.data;
                    that.$router.push({
                        name: "ContactManager"
                    });
                }
            });
        }
    },
}
</script>

<style>

</style>
