<template>
    <div class="col-md-12">
        <div class="alert alert-danger" v-if="errors.length > 0">
            <ul>
                <li v-for="error in errors" :key="error.id">{{ error }}</li>
            </ul>
        </div>
        <div class="alert alert-success" v-if="success">
            <p>Transaction Successfully Created!</p>
        </div>
        <form>
            <div class="card">
                <div class="card-header">Create Transaction</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Transaction Type</label>
                        <select v-model="formData.transaction_type" class="form-control">
                            <option value="incoming">Incoming</option>
                            <option value="outgoing">Outgoing</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Transaction Amount </label>
                        <input v-model="formData.transaction_amount" type="number" class="form-control" placeholder="Enter Transaction Amount">
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger" :href="`/wallet/transaction/${walletId}`">Back</a>
                    <button type="submit" class="btn btn-primary float-right" @click.prevent="createTransaction()" v-if="!isBusy">Submit</button>
                    <div class="spinner-border text-primary float-right" role="status" v-if="isBusy">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'create-transaction-component',
        props: ['walletId'],
        data(){
            return{
                formData: {
                    transaction_type: 'incoming',
                    transaction_amount: '',
                    wallet_id: this.walletId,
                },
                errors: [],
                isBusy: false,
                success: false,
                url: ''
            }
        },
        mounted() {
        },
        methods: {
            createTransaction() {
                this.isBusy = true
                axios.post('/transaction', this.formData)
                .then((response) => {
                    console.log(response)
                    this.errors = ''
                    this.isBusy = false
                    this.success = true
                    this.url = this.formData.wallet_id
                    setTimeout(function() {
                        history.back();
                    }, 1000);
                })
                .catch((errors) => {
                    // console.dir(errors)
                    this.errors = []
                    if(errors.response.status === 422) {
                        this.showErrors(errors.response.data.errors)
                    }
                    this.isBusy = false
                })
            },
            showErrors(errors) {
                for(const [key, value] of Object.entries(errors)){
                    for(let item in value) {
                        this.errors.push(value[item])
                    }
                }
            }
        }
        

    }
</script>
