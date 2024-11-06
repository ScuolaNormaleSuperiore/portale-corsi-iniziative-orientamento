
export default {

    async connectToServer() {
        const ws = new WebSocket(import.meta.env.VITE_WEBSOCKET_SERVER);

        return new Promise((resolve, reject) => {
            const timer = setInterval(() => {
                if(ws.readyState === 1) {
                    clearInterval(timer);
                    resolve(ws);
                }
            }, 10);
        });
    },

    formatDate(date,format,isTs) {
        //console.log('moment',moment);
        let m = null;
        if (isTs) {
            m = new moment.unix(date);
        } else {
            m = new moment(date);
        }
        if (m.isValid())
            return format?m.format(format):m.format('DD/MM/YYYY');
        return ' '
    },

    formatDateTime(date,isTs) {
        return this.formatDate(date,'DD/MM/YYYY HH:mm:ss',isTs)
    },

    toLocalTime(date) {
        return moment.utc(date).local();
    },

    getProductsSmall() {
        return fetch('demo/data/products-small.json')
            .then((res) => res.json())
            .then((d) => d.data);
    },

    getProducts() {
        return fetch('demo/data/products.json')
            .then((res) => res.json())
            .then((d) => d.data);
    },

    getProductsWithOrdersSmall() {
        return fetch('demo/data/products-orders-small.json')
            .then((res) => res.json())
            .then((d) => d.data);
    },

    getSocials() {
        return socials;
    },

    getSocialIcon(id) {
        for (let i in socials) {
            if (socials[i].code == id) {
                return socials[i].icon
            }
        }
        return 'pi pi-globe';
    },

    getAllServices() {
        return [
            {
                code : 'listening',
                name : 'Listening',
                title : 'Listening Tasks'
            }
            // {
            //     code : 'int_an',
            //     name : 'int analysis',
            //     title : 'interactions analysis'
            // },
            // {
            //     code : 'tw_list',
            //     name : 'tw listening',
            //     title : 'twitter listening'
            // },
            // {
            //     code : 'tw_ff',
            //     name : 'tw fake followers',
            //     title : 'twitter fake follewers'
            // },
            // {
            //     code : 'tw_bot_det',
            //     name : 'tw bot detector',
            //     title : 'twitter bot detector'
            // },
            // {
            //     code : 'image_an',
            //     name : 'img analysis',
            //     title : 'image analysis'
            // }
        ]
    },

    env(varname) {
        return import.meta.env[varname];
    },

    showReqError(req) {

        if (req.code == 'ECONNABORTED') {
            return ;
        }
        console.error('req error', req, typeof req);

        if (!req.response) {
            this.globalProperties.$toast.add({severity: 'error', detail: req, content: 'Error Message', group:'tr'});
            return
        }

        let message = req.message;
        try {
            message = req.response?req.response.data.response.reason:'no-msg';
        } catch (e) {
            console.error('errore nel leggere la ragione dell\'errore',e,req);
            message = req.message;
        }
        console.error('toast message','error',message);
        this.globalProperties.$toast.add({severity: 'error', detail: message, content: 'Error Message', group:'tr'});
    },

    getReqError(req) {
        let message = req.message;
        try {
            message = req.response.data.response.reason;
        } catch (e) {
            console.error('errore nel leggere la ragione dell\'errore',e,req);
            message = req.message;
        }
        return message;
    },

    showSuccess(message,time) {
        //this.$toast.add({severity:'success', summary: 'Success Message', detail:'Message Detail', life: 3000});
        this._showMessage(message,'success',time);
    },

    showInfo(message,time) {
        //this.$toast.add({severity:'info', summary: 'Info Message', detail:'Message Detail', life: 3000});
        this._showMessage(message,'info',time);
    },

    showWarn(message,time) {
        //this.$toast.add({severity:'warn', summary: 'Warn Message', detail:'Message Detail', life: 3000});
        this._showMessage(message,'warn',time);
    },

    showError(message,time) {
        //this.$toast.add({severity:'error', summary: 'Error Message', detail:'Message Detail', life: 3000});
        this._showMessage(message,'error',time);
    },

    _showMessage(message,severity,time) {
        let msg = {
            severity: severity,
            detail: message,
            content: severity + ' Message',
            group:'tr'
        }
        if (time) {
            msg.life = time;
        }

        //console.debug('toast message',severity,message,time);
        this.globalProperties.$toast.add(msg);
    },

    _showSuccess(response,msg) {
        let that = this;
        let m = msg?msg:response.data.response.reason;
        if (m) {
            that.showSuccess(m, 3000);
        }
    },

    getCache(key) {
        return window.localStorage.getItem(key);
    },

    setCache(key,value) {
        ///let val = typeof (value) === "object"?JSON.stringify(value)
        window.localStorage.setItem(key,value);
    },
    errorImage() {
        return '/images/default_target.png'
    },

    jsonToProperties(json) {
        let props = [];
        for (let k in json) {
            props.push({
                label : k,
                value :json[k]
            })
        }
        console.log('props',props,json);
        return props
    }
}
