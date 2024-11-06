<template>
    <div class="grid layout-dashboard">

        <div class="col-12">
            <div class="card card-w-title live-support">
                <h5>Dashboard SNS Backend</h5>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {}
    },

};
</script>

<style scoped>
::v-deep(.fc .fc-col-header-cell-cushion),
::v-deep(.fc-daygrid-dot-event .fc-event-time),
::v-deep(.fc-daygrid-dot-event .fc-event-title),
::v-deep(.fc .fc-daygrid-day-number),
::v-deep(.fc .fc-daygrid-more-link) {
    color: var(--text-color);
}

::v-deep(.fc-header-toolbar) {
    display: flex;
    flex-wrap: wrap;
}
</style>
