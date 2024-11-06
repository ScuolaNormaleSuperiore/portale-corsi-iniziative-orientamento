<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <h5>Advanced</h5>
                <FileUpload name="demo[]" @uploader="onUpload" :multiple="true" accept="image/*" :maxFileSize="1000000" customUpload />

                <h5>Basic</h5>
                <FileUpload mode="basic" name="demo[]" accept="image/*" :maxFileSize="1000000" @uploader="onUpload" customUpload />
            </div>
        </div>
        <Toast />
    </div>
</template>

<script>
export default {
    methods: {
        onUpload() {
            this.$toast.add({ severity: 'info', summary: 'Success', detail: 'File Uploaded', life: 3000 });
        },
    },
};
</script>

<style scoped></style>
