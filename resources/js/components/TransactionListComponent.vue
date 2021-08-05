<template>
    <div class="mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success">
            Wallet Successfully Deleted!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="fraudMsg">
            Transaction Successfully Mark As Fraud!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <table class="table table-bordered table-condensed" v-if="transactions.length > 0">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    
                </tr>
            </thead>
            <tbody>
                <tr v-for="transaction in transactions" :key="transaction.id">
                    <td>{{transaction.id}}</td>
                    <td>{{transaction.transaction_type}}</td>
                    <td class="text-right">{{transaction.transaction_amount}}</td>
                    <td class="text-center">{{transaction.created_at}}</td>
                    <td class="text-center text-danger">{{checkFraud(transaction.transaction_isFraud)}}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-info btn-sm" @click="markAsFraud(transaction.id)">Mark as Fraud</button> 
                        <button type="button" class="btn btn-outline-secondary btn-sm" @click="deleteTransaction(transaction.id)">Delete</button>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>


export default {
    name: 'WalletListComponent',
    data(){
        return{
            transactions: [],
            success: false,
            fraudMsg: false,
        }
    },
    mounted() {
        this.getTransactions()
    },
    methods: {
        getTransactions() {
            let url = window.location.pathname;
            let id = url.substring(url.lastIndexOf('/') + 1);
            let x = this;
            axios.get(`/wallet/transactionlist/${id}`)
            .then(function (response) {
                // handle success
                x.transactions = response.data
                console.log(response);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        markAsFraud(id) {
            let x = this;
            axios.put(`/transaction/${id}`)
            .then(function (response) {
                // handle success
                console.log(response.data.result);
                x.getTransactions();
                x.fraudMsg = true;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        deleteTransaction(id) {
            let x = this;
            axios.delete(`/transaction/${id}`)
            .then(function (response) {
                // handle success
                console.log(response.data.result);
                x.getTransactions();
                x.success = true;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        checkFraud(transaction_isFraud) {
            return transaction_isFraud ? 'Fraud' : '';
        }
    }
}
</script>

<style>

</style>