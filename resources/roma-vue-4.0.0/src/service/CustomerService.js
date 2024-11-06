export default class CustomerService {
    getCustomersSmall() {
        return fetch('demo/data/customers-small.json')
            .then((res) => res.json())
            .then((d) => d.data);
    }

    getCustomersMedium() {
        return fetch('demo/data/customers-medium.json')
            .then((res) => res.json())
            .then((d) => d.data);
    }

    getCustomersLarge() {
        return fetch('demo/data/customers-large.json')
            .then((res) => res.json())
            .then((d) => d.data);
    }

    getCustomersXLarge() {
        return fetch('demo/data/customers-xlarge.json')
            .then((res) => res.json())
            .then((d) => d.data);
    }
}
