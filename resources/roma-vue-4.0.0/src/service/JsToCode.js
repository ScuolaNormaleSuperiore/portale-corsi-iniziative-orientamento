import prettyJs from "pretty-js";
import cupparisPrimevue from 'cupparis-primevue'

export default class JsToCode {
    constructor() {
        this.fIndex = 0;
    }

    updateCode(code) {
        try {
            this.fIndex++;
            let fName = 'getNewCode' + this.fIndex;
            console.debug('fName',fName)
            let s = 'window.' + fName  +' = function() {\n' + code + '\n return conf\n}';
            console.debug('sss',s);
            let script = document.createElement("script");
            script.innerHTML = s;
            document.body.appendChild(script);
            return fName;
        } catch (e) {
            throw e;
        }
    }

    getCodeString(code) {
        return code + '\n';
    }

    _toJs(obj) {
        var properties = [];
        for( let k in obj) {
            console.debug(k,typeof obj[k],obj[k]);
            if (typeof obj[k] === 'object') {
                //console.log('k',k,'object')
                if (Array.isArray(obj[k])) {
                    let s =  [];
                    for (let i= 0;i<obj[k].length;i++) {
                        //console.debug('arra',obj[k][i]);
                        s.push(JSON.stringify(obj[k][i]));

                        //obj[k][i] = this._toJs(obj[k][i]);
                    }

                    properties.push( JSON.stringify(k) + ':[' + s.join(',') + ']');
                } else {
                    properties.push( JSON.stringify(k) + ':' + this._toJs(obj[k]))
                }

            } else if(typeof obj[k] === 'function') {
                //console.log(obj[k].name,'k',k,'-function-',obj[k].toString());
                if (!obj[k].name) {
                    properties.push(JSON.stringify(k) + ":" + obj[k].toString())
                } else {
                    properties.push(obj[k].toString())
                }

            } else if (typeof obj[k] === 'array' ){
                //console.log('ARRAy');
            } else if (obj[k] ){
                let s = JSON.stringify(k) + ":" + JSON.stringify(obj[k]);
                properties.push(s);
            } else if (obj[k] === null) {
                let s = JSON.stringify(k) + ": null";
                properties.push(s);
            } else {
                let s = JSON.stringify(k) + ":" + JSON.stringify(obj[k]);
                properties.push(s);
            }
        }
        if (obj instanceof Array) {
            return '[' + properties.join(",\n") +']'
        }
        if (obj === null) {
            return 'null';
        }
        return '{' + properties.join(",\n") +'}'
    }

    getSourceCode(code) {
        var sourceCode =this._toJs(code);
        //console.log('code',sourceCode);
        let options = {
            indent: "  ",  // Switch to tabs for indentation
            newline: "\n",  // Windows-style newlines
            quoteProperties : true,

        }
        return prettyJs(sourceCode,options);
    }

    loadVisLib(callback) {
        // carico la libreria vis-timeline-graph2d dinamicamente perche' non puo' coesistere con graphNetwork

        let scriptsName = [
            'https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/ace.js',
            'https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/ext-beautify.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/snippets/javascript.min.js',
        ]

        var __loadScript = function(i) {
            let body = document.getElementsByTagName('body')[0];
            let script = document.createElement('script');
            script.id = 'visScript';
            script.type = 'text/javascript';
            script.src = scriptsName[i];
            script.onload = function() {
                if (i  < scriptsName.length - 1) {
                    __loadScript(i+1);
                } else {
                    callback();
                }

            };
            script.onerror = function() {
                console.error("cannot load script " + scriptsName[i]);
            }
            // fire the loading
            body.appendChild(script);
        }


        __loadScript(0);


    }

    getWidgetDefaultConf(type) {
        return cupparisPrimevue.CrudCore.defaultWidgetConf(type);
    }

    getViewDefaultConf(type) {
        return cupparisPrimevue.CrudCore.defaultViewConf(type);
    }
}
