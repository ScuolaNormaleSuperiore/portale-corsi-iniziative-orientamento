<template>
    <div class="grid p-fluid">
        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>Linear Chart</h5>
                <Chart type="line" :data="lineData"></Chart>
            </div>
            <div class="card flex flex-column align-items-center">
                <h5 class="align-self-start">Pie Chart</h5>
                <Chart type="pie" :data="pieData" style="position: relative; width: 50%"></Chart>
            </div>
            <div class="card flex flex-column align-items-center">
                <h5 class="align-self-start">Polar Area Chart</h5>
                <Chart type="polarArea" :data="polarData" style="position: relative; width: 50%"></Chart>
            </div>
        </div>
        <div class="col-12 lg:col-6">
            <div class="card">
                <h5>Bar Chart</h5>
                <Chart type="bar" :data="barData"></Chart>
            </div>
            <div class="card flex flex-column align-items-center">
                <h5 class="align-self-start">Doughnut Chart</h5>
                <Chart type="doughnut" :data="pieData" style="position: relative; width: 50%"></Chart>
            </div>
            <div class="card flex flex-column align-items-center">
                <h5 class="align-self-start">Radar Chart</h5>
                <Chart type="radar" :data="radarData" style="position: relative; width: 50%"></Chart>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            lineData: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [
                    {
                        label: 'First Dataset',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false,
                        borderColor: '#b944d6',
                        tension: 0.4,
                    },
                    {
                        label: 'Second Dataset',
                        data: [28, 48, 40, 19, 86, 27, 90],
                        fill: false,
                        borderColor: '#0F97C7',
                        tension: 0.4,
                    },
                ],
            },
            pieData: {
                labels: ['A', 'B', 'C'],
                datasets: [
                    {
                        data: [540, 325, 702, 421],
                        backgroundColor: ['#0F97C7', '#b944d6', '#e2841a', '#10b163'],
                    },
                ],
            },
            polarData: {
                datasets: [
                    {
                        data: [11, 16, 7, 3],
                        backgroundColor: ['#0F97C7', '#b944d6', '#e2841a', '#10b163'],
                        label: 'My dataset',
                    },
                ],
                labels: ['Blue', 'Purple', 'Orange', 'Green'],
            },
            barData: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [
                    {
                        label: 'My First dataset',
                        backgroundColor: '#0F97C7',
                        borderColor: '#0F97C7',
                        data: [65, 59, 80, 81, 56, 55, 40],
                    },
                    {
                        label: 'My Second dataset',
                        backgroundColor: '#e2841a',
                        borderColor: '#e2841a',
                        data: [28, 48, 40, 19, 86, 27, 90],
                    },
                ],
            },
            doughnutData: {
                labels: ['A', 'B', 'C'],
                datasets: [
                    {
                        data: [300, 50, 100],
                        backgroundColor: ['#e2841a', '#0F97C7', '#10b163'],
                        hoverBackgroundColor: ['#edb575', '#6fc0dd', '#6fd0a1'],
                    },
                ],
            },
            radarData: {
                labels: ['Eating', 'Drinking', 'Sleeping', 'Designing', 'Coding', 'Cycling', 'Running'],
                datasets: [
                    {
                        label: 'My First dataset',
                        backgroundColor: 'rgba(15,151,199,0.2)',
                        borderColor: 'rgba(15,151,199,1)',
                        pointBackgroundColor: 'rgba(15,151,199,1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(15,151,199,1)',
                        data: [65, 59, 90, 81, 56, 55, 40],
                    },
                    {
                        label: 'My Second dataset',
                        backgroundColor: 'rgba(185,68,214,0.2)',
                        borderColor: 'rgba(185,68,214,1)',
                        pointBackgroundColor: 'rgba(185,68,214,1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(185,68,214,1)',
                        data: [28, 48, 40, 19, 96, 27, 100],
                    },
                ],
            },
        };
    },
};
</script>

<style scoped></style>
