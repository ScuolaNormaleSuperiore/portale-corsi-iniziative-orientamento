<template>
    <div class="card icons-demo">
        <h4>Icons</h4>
        <p>Roma uses PrimeIcons v6, PrimeTek's new modern icon library.</p>

        <h5>Getting Started</h5>
        <p>PrimeIcons use the <strong>pi pi-{icon}</strong> syntax such as <strong>pi pi-check</strong>. A standalone icon can be displayed using an element like <i>i</i> or <i>span</i>.</p>
        <pre v-code><code>
&lt;i class="pi pi-check"&gt;&lt;/i&gt;
&lt;i class="pi pi-times"&gt;&lt;/i&gt;

</code></pre>

        <i class="pi pi-check" style="margin-right: 0.5rem"></i>
        <i class="pi pi-times"></i>

        <h5>Component Icons</h5>
        <p>Components that have icon properties accept PrimeIcons with the <strong>pi pi-{icon}</strong> syntax.</p>
        <pre v-code><code>
&lt;Button label="Confirm" icon="pi pi-check"&gt;&lt;/Button&gt;

</code></pre>

        <Button label="Confirm" icon="pi pi-check"></Button>

        <h5>Size</h5>
        <p>Size of the icons can easily be changed using font-size property.</p>

        <pre v-code><code>
&lt;i class="pi pi-check"&gt;&lt;/i&gt;

</code></pre>

        <i class="pi pi-check"></i>

        <pre v-code><code>
&lt;i class="pi pi-check" style="font-size: 2rem"&gt;&lt;/i&gt;

</code></pre>

        <i class="pi pi-check" style="font-size: 2rem"></i>

        <h5>Spinning Animation</h5>
        <p>Special pi-spin class applies continuous rotation to an icon.</p>
        <pre v-code><code>
&lt;i class="pi pi-spin pi-spinner" style="font-size: 2rem"&gt;&lt;/i&gt;

</code></pre>

        <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>

        <h5>List of Icons</h5>
        <p>Here is the current list of PrimeIcons, more icons are added periodically. You may also <a href="https://github.com/primefaces/primeicons/issues">request new icons</a> at the issue tracker.</p>
        <div>
            <InputText v-model="filter" type="text" class="icon-filter" placeholder="Search an icon" />
        </div>
        <div class="grid icons-list">
            <div class="col-12 md:col-2 icon" v-for="icon of filteredIcons" :key="icon.properties.name">
                <i :class="'pi pi-' + icon.properties.name"></i>
                <div>pi-{{ icon.properties.name }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            icons: null,
            filter: null,
        };
    },
    mounted() {
        fetch('demo/data/icons.json', { headers: { 'Cache-Control': 'no-cache' } })
            .then((res) => res.json())
            .then((d) => {
                let icons = d.icons;
                let data = icons.filter((value) => {
                    return value.icon.tags.indexOf('deprecate') === -1;
                });
                data.sort((icon1, icon2) => {
                    if (icon1.properties.name < icon2.properties.name) return -1;
                    else if (icon1.properties.name > icon2.properties.name) return 1;
                    else return 0;
                });
                this.icons = data;
            });
    },
    computed: {
        filteredIcons() {
            if (this.filter) return this.icons.filter((icon) => icon.properties.name.indexOf(this.filter.toLowerCase()) > -1);
            else return this.icons;
        },
    },
};
</script>

<style scoped lang="scss">
@import '@/assets/demo/styles/documentation.scss';

.icon-filter {
    width: 100%;
    padding: 1rem;
    margin: 1rem 0 1.5rem 0;
}

.icons-list {
    text-align: center;
    color: var(--text-color);

    .icon {
        padding: 1em;
    }
}

.icons-list i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--text-color-secondary);
}
</style>
