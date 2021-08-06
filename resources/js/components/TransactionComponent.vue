<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Wallet Transaction
                <a href="/home" class="btn btn-sm btn-outline-primary">Back to Wallet</a>
            </div>
            
            <div class="card-body">
                <a :href="`/transactioncreate/${walletId}`" class="btn btn-outline-primary">New Transaction</a>

                <transaction-list-component />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'transaction-component',
        data(){
            return{
                walletId: ''
            }
        },
        mounted() {
            this.getWalletId()
        },
        methods: {
            getWalletId() {
                let url = window.location.pathname;
                let id = url.substring(url.lastIndexOf('/') + 1);
                this.walletId = id
            },
        }
        

    }
</script>
