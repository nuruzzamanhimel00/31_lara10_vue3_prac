<template>
    <div>
        <div class="card">
            <DataTable :value="products" tableStyle="min-width: 50rem">
                <Column field="code" header="Code"></Column>
                <Column field="name" header="Name"></Column>
                <Column field="category" header="Category"></Column>
                <Column field="quantity" header="Quantity"></Column>
            </DataTable>
        </div>
        <h1>Datatable with pagination</h1>
        <div class="card">
            <DataTable
                :value="customers"
                paginator
                :rows="3"
                :rowsPerPageOptions="[5, 10, 20, 50]"
                tableStyle="min-width: 50rem"
            >
                <Column field="name" header="Name" style="width: 25%"></Column>
                <Column
                    field="country.name"
                    header="Country"
                    style="width: 25%"
                ></Column>
                <Column
                    field="company"
                    header="Company"
                    style="width: 25%"
                ></Column>
                <Column
                    field="representative.name"
                    header="Representative"
                    style="width: 25%"
                ></Column>
            </DataTable>
        </div>
        <h1>Dynamic user data paginate</h1>
        <div class="card">
            <DataTable
                :value="users"
                paginator
                :rows="10"
                :rowsPerPageOptions="[5, 10, 20, 50]"
                tableStyle="min-width: 50rem"
                @page="onPage($event)"
                :totalRecords="totalRecords"
            >
                <Column field="name" header="Name" style="width: 50%"></Column>
                <Column
                    field="email"
                    header="Email"
                    style="width: 50%"
                ></Column>
            </DataTable>
        </div>
    </div>
</template>

<script>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import ColumnGroup from "primevue/columngroup"; // optional
import Row from "primevue/row"; // optional
import { ProductService } from "../../service/ProductService.js";
import { CustomerService } from "../../service/CustomerService.js";

export default {
    name: "DatatablePaginate",
    data() {
        return {
            products: null,
            customers: null,
            users: null,
            totalRecords: 0,
            page: 1,
        };
    },
    components: {
        DataTable,
        Column,
    },
    mounted() {
        ProductService.getProducts().then((data) => (this.products = data));
        CustomerService.getCustomersMedium().then(
            (data) => (this.customers = data)
        );
        this.loadLazyData();
    },
    methods: {
        onPage(event) {
            this.page = event.page + 1;
            this.loadLazyData();
        },
        loadLazyData() {
            try {
                axios
                    .get("/prime-vue/get-users-paginate?page=" + this.page)
                    .then((response) => {
                        this.users = response.data.data;
                        this.totalRecords = response.data.tota;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>

<style lang="scss" scoped></style>
