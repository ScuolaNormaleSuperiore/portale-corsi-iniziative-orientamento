<template>
    <div class="grid overlay-demo">
        <Toast />
        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>Dialog</h5>
                <Dialog header="Dialog" v-model:visible="display" :breakpoints="{ '960px': '75vw' }" :style="{ width: '30vw' }" :modal="true">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <template #footer>
                        <Button label="Dismiss" @click="close" icon="pi pi-check" class="p-button-secondary" />
                    </template>
                </Dialog>
                <Button label="Show" icon="pi pi-external-link" style="width: auto" @click="open" />
            </div>
        </div>
        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>Confirmation</h5>
                <Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="del" />
                <ConfirmDialog group="dialog" />
            </div>
        </div>
        <div class="col-12 lg:col-6">
            <div class="card p-fluid">
                <h5>Overlay Panel</h5>
                <div class="grid formgrid">
                    <div class="col-6">
                        <Button type="button" label="Image" @click="toggle" class="p-button-success" />
                        <OverlayPanel ref="op" appendTo="body" :showCloseIcon="true" :breakpoints="{ '960px': '75vw', '640px': '100vw' }">
                            <img src="/demo/images/nature/nature9.jpg" alt="Nature 9" />
                        </OverlayPanel>
                    </div>
                    <div class="col-6">
                        <Button type="button" label="DataTable" @click="toggleDataTable" class="p-button-success" />
                        <OverlayPanel ref="op2" appendTo="body" :showCloseIcon="true" id="overlay_panel" style="width: 450px" :breakpoints="{ '960px': '75vw', '640px': '100vw' }">
                            <DataTable :value="products" v-model:selection="selectedProduct" selectionMode="single" :paginator="true" :rows="5" responsiveLayout="scroll" @row-select="onProductSelect">
                                <Column field="name" header="Name" :sortable="true"></Column>
                                <Column header="Image">
                                    <template #body="slotProps">
                                        <img :src="'/demo/images/product/' + slotProps.data.image" :alt="slotProps.data.image" class="product-image" />
                                    </template>
                                </Column>
                                <Column field="price" header="Price" :sortable="true">
                                    <template #body="slotProps">
                                        {{ formatCurrency(slotProps.data.price) }}
                                    </template>
                                </Column>
                            </DataTable>
                        </OverlayPanel>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>Sidebar</h5>
                <Button icon="pi pi-arrow-right" @click="visibleLeft = true" class="p-button-warning mr-2" />
                <Button icon="pi pi-arrow-left" @click="visibleRight = true" class="p-button-warning mr-2" />
                <Button icon="pi pi-arrow-down" @click="visibleTop = true" class="p-button-warning mr-2" />
                <Button icon="pi pi-arrow-up" @click="visibleBottom = true" class="p-button-warning mr-2" />
                <Button icon="pi pi-th-large" @click="visibleFull = true" class="p-button-warning" />

                <Sidebar v-model:visible="visibleLeft" :baseZIndex="1000">
                    <h3 style="font-weight: normal">Left Sidebar</h3>
                </Sidebar>

                <Sidebar v-model:visible="visibleRight" :baseZIndex="1000" position="right">
                    <h3 style="font-weight: normal">Right Sidebar</h3>
                </Sidebar>

                <Sidebar v-model:visible="visibleTop" :baseZIndex="1000" position="top">
                    <h3 style="font-weight: normal">Top Sidebar</h3>
                </Sidebar>

                <Sidebar v-model:visible="visibleBottom" :baseZIndex="1000" position="bottom">
                    <h3 style="font-weight: normal">Bottom Sidebar</h3>
                </Sidebar>

                <Sidebar v-model:visible="visibleFull" :baseZIndex="1000" position="full">
                    <h3 style="font-weight: normal">Full Screen</h3>
                </Sidebar>
            </div>
        </div>
        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>Tooltip</h5>
                <div class="formgroup-inline">
                    <div class="field">
                        <InputText type="text" placeholder="Username" v-tooltip="'Your username'" />
                    </div>
                    <div class="field">
                        <Button type="button" label="Save" icon="pi pi-check" v-tooltip="'Click to proceed'" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>ConfirmPopup</h5>
                <ConfirmPopup group="popup"></ConfirmPopup>
                <Button ref="popup" @click="confirm($event)" icon="pi pi-check" label="Confirm" class="mr-2"></Button>
            </div>
        </div>
    </div>
</template>

<script>
import ProductService from '@/service/ProductService';

export default {
    data() {
        return {
            display: false,
            position: 'center',
            visibleLeft: false,
            visibleRight: false,
            visibleTop: false,
            visibleBottom: false,
            visibleFull: false,
            products: null,
            selectedProduct: null,
        };
    },
    productService: null,
    created() {
        this.productService = new ProductService();
    },
    mounted() {
        this.productService.getProductsSmall().then((data) => (this.products = data));
    },
    methods: {
        open() {
            this.display = true;
        },
        close() {
            this.display = false;
        },
        toggle(event) {
            this.$refs.op.toggle(event);
        },
        toggleDataTable(event) {
            this.$refs.op2.toggle(event);
        },
        formatCurrency(value) {
            return value.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        },
        onProductSelect(event) {
            this.$refs.op.hide();
            this.$toast.add({ severity: 'info', summary: 'Product Selected', detail: event.data.name, life: 3000 });
        },
        confirm(event) {
            this.$confirm.require({
                target: event.currentTarget,
                group: 'popup',
                message: 'Are you sure you want to proceed?',
                icon: 'pi pi-exclamation-triangle',
                accept: () => {
                    this.$toast.add({ severity: 'info', summary: 'Confirmed', detail: 'You have accepted', life: 3000 });
                },
                reject: () => {
                    this.$toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
                },
            });
        },
        del() {
            this.$confirm.require({
                group: 'dialog',
                header: 'Confirmation',
                message: 'Are you sure you want to delete?',
                icon: 'pi pi-exclamation-triangle',
                accept: () => {
                    this.$toast.add({ severity: 'info', summary: 'Confirmed', detail: 'You have accepted', life: 3000 });
                },
                reject: () => {
                    this.$toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
                },
            });
        },
    },
};
</script>

<style scoped>
p {
    line-height: 1.5;
    margin: 0;
}
.product-image {
    width: 50px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}
</style>
