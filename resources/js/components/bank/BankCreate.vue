<template>
    <div>
        <div class="container">
            <div v-if="message" class="alert">{{ message }}</div>
            <div class="card">
                <div class="card-header">Create new Bank</div>
                <div class="card-body">
                    <form @submit.prevent="saveForm()">
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-2  required-star">Name</label>
                                    <div :class="['col-md-8', allerros.name ? 'has-error' : '']">
                                        <input type="text" v-model="bank.name" class="form-control input-sm">
                                        <span v-if="allerros.name" :class="['text-danger']">{{ allerros.name[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-2  required-star">Code</label>
                                    <div :class="['col-md-8', allerros.code ? 'has-error' : '']">
                                        <input type="number" v-model="bank.code" class="form-control input-sm">
                                        <span v-if="allerros.code" :class="['text-danger']">{{ allerros.code[0] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-2  required-star">Email</label>
                                    <div :class="['col-md-8', allerros.email ? 'has-error' : '']">
                                        <input type="email" v-model="bank.email" class="form-control input-sm">
                                        <span v-if="allerros.email" :class="['text-danger']">{{ allerros.email[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-2  required-star">Phone</label>
                                    <div :class="['col-md-8', allerros.phone ? 'has-error' : '']">
                                        <input type="number" v-model="bank.phone" class="form-control input-sm">
                                        <span v-if="allerros.phone" :class="['text-danger']">{{ allerros.phone[0] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-2 ">Website</label>
                                    <div :class="['col-md-8', allerros.website ? 'has-error' : '']">
                                        <input type="url" v-model="bank.website" class="form-control input-sm">
                                        <span v-if="allerros.website" :class="['text-danger']">{{ allerros.website[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-2  required-star">Location</label>
                                    <div :class="['col-md-8', allerros.location ? 'has-error' : '']">
                                        <input type="text" v-model="bank.location" class="form-control input-sm">
                                        <span v-if="allerros.location" :class="['text-danger']">{{ allerros.location[0] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-2  required-star ">Address</label>
                                    <div :class="['col-md-8', allerros.address ? 'has-error' : '']">
                                        <textarea class="form-control input-sm" v-model="bank.address" rows="2" cols="2"></textarea>
                                        <span v-if="allerros.address" :class="['text-danger']">{{ allerros.address[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 row">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <router-link to="/" class="btn btn-warning float-left"><< Back</router-link>
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fa fa-chevron-circle-right"></i> Save Bank
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                allerros: [],
                message: null,
                success : false,
                bank: {
                    name: '',
                    address: '',
                    website: '',
                    email: '',
                    phone: '',
                    location: '',
                    code: '',
                },
            }
        },
        methods: {
            saveForm() {
                var app = this;
                axios.post('/store-bank', this.bank)
                    .then(function (resp) {
                        app.message = 'Bank added Successfully';
                        console.log('Bank added Successfully');
                        setTimeout(() => app.$router.push({path: '/'}), 1000);
                    } ).catch((error) => {
                        this.allerros = error.response.data.errors;
                });
            }
        }
    }
</script>

<style scoped>
    .alert {
        background: lightgreen;
        color: black;
        padding: 1rem;
        margin-bottom: 1rem;
        width: 100%;
        border: 1px solid darkgreen;
        border-radius: 5px;
    }
</style>
