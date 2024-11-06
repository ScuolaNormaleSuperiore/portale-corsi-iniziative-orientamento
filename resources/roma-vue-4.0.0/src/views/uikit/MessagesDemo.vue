<template>
    <div class="grid messages-demo">
        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>Toast</h5>

                <Toast />
                <Button @click="showSuccess()" label="Success" class="p-button-success mr-2 mb-2" />
                <Button @click="showInfo()" label="Info" class="p-button-info mr-2 mb-2" />
                <Button @click="showWarn()" label="Warn" class="p-button-warning mr-2 mb-2" />
                <Button @click="showError()" label="Error" class="p-button-danger mr-2 mb-2" />
            </div>
        </div>

        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>Messages</h5>

                <Button label="Success" @click="addMessage('success')" class="p-button-success mr-2 mb-2" />
                <Button label="Info" @click="addMessage('info')" class="p-button-info mr-2 mb-2" />
                <Button label="Warn" @click="addMessage('warn')" class="p-button-warning mr-2 mb-2" />
                <Button label="Error" @click="addMessage('error')" class="p-button-danger mr-2 mb-2" />

                <transition-group name="p-message" tag="div">
                    <Message v-for="msg of message" :severity="msg.severity" :key="msg.id"
                        ><b>{{ msg.detail }}</b> {{ msg.content }}</Message
                    >
                </transition-group>
            </div>
        </div>

        <div class="col-12 lg:col-8">
            <div class="card">
                <h5>Inline Message</h5>
                <div class="field grid align-items-start mt-4">
                    <div class="col">
                        <InputText id="username1" v-model="username" :required="true" placeholder="Username" class="p-invalid"></InputText>
                        <InlineMessage>Field is required</InlineMessage>
                    </div>
                </div>
                <div class="field grid mt-4">
                    <div class="col">
                        <InputText id="email" v-model="email" :required="true" placeholder="Email" class="p-invalid"></InputText>
                        <InlineMessage />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 lg:col-4">
            <div class="card">
                <h5>Help Text</h5>
                <div class="field p-fluid">
                    <label for="username2">Username</label>
                    <InputText id="username2" type="username" class="p-invalid" aria-describedby="username-help" />
                    <small id="username-help" class="p-error">Enter your username to reset your password.</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: [],
            username: null,
            email: null,
            count: 0,
        };
    },
    methods: {
        addMessage(type) {
            if (type === 'success') {
                this.message = [{ severity: 'success', detail: 'Success Message', content: 'Message sent', id: this.count++ }];
            } else if (type === 'info') {
                this.message = [{ severity: 'info', detail: 'Info Message', content: 'PrimeVue rocks', id: this.count++ }];
            } else if (type === 'warn') {
                this.message = [{ severity: 'warn', detail: 'Warn Message', content: 'There are unsaved changes', id: this.count++ }];
            } else if (type === 'error') {
                this.message = [{ severity: 'error', detail: 'Error Message', content: 'Validation failed', id: this.count++ }];
            }
        },
        showSuccess() {
            this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Message sent', life: 3000 });
        },
        showInfo() {
            this.$toast.add({ severity: 'info', summary: 'Info Message', detail: 'PrimeVue rocks', life: 3000 });
        },
        showWarn() {
            this.$toast.add({ severity: 'warn', summary: 'Warn Message', detail: 'There are unsaved messages', life: 3000 });
        },
        showError() {
            this.$toast.add({ severity: 'error', summary: 'Error Message', detail: 'Validation failed', life: 3000 });
        },
    },
};
</script>

<style lang="scss" scoped>
.field > label {
    width: 125px;
}
.p-inputtext {
    margin-right: 0.5rem;
}
::v-deep(.p-button) {
    min-width: 8em;
}
::v-deep(.p-message) {
    margin-left: 0.25em;
}
</style>
